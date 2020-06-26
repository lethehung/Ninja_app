<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\History_Attdance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use CV\Face\LBPHFaceRecognizer, CV\CascadeClassifier, CV\Scalar, CV\Point;
use function CV\{imread,imwrite, cvtColor, equalizeHist, rectangleByRect, rectangle, putText};
use const CV\{COLOR_BGR2GRAY};

class AttendanceController extends Controller
{
    public function test(Request $request){
        $files = scandir("Images/".$request->id."/root");
        $src = imread($request->image);
        $gray = cvtColor($src, COLOR_BGR2GRAY);
        $this->faceClassifier->detectMultiScale($gray, $faces);
        equalizeHist($gray, $gray);
        $facemax = null;
        $Acreage = 0;
        foreach ($faces as $face) {
                if($face->height*$face->width > $Acreage){
                    $Acreage = $face->height*$face->width;
                    $facemax = $face;
                }
        }
        $faceImage = $gray->getImageROI($facemax);
        $faceLabel = $this->faceRecognizer->predict($faceImage, $faceConfidence);
        imwrite("result.jpg", $gray->getImageROI($face));
        return $faceLabel;
    }

    public function attend(Request $request){
        $device = $_SERVER['HTTP_USER_AGENT'];
        $today = Carbon::now();
        $user = Auth::user();
        $ip =  $_SERVER['REMOTE_ADDR'];
        $date =  new \DateTime($today->toDateString());
        $config_company = DB::table('configuration_cpny')->where('id_cpny',$user->id_cpny)->first();
        $list_ip = explode(' ',$config_company->ip);
        $day = $date->format('l');
        if($today->hour > 12)
            $date_crr = $today->dayOfWeek + 0.5;
        else
            $date_crr = $today->dayOfWeek;
        $check = DB::table('history_attendance')->where('date_attendance',$today->toDateString())->where('id_member',$user->id)->get('id')->first();
        if($check!=null){
            $this->update($check,$ip,$list_ip,$device);
        }
        else{
            $work_schedule = explode(' ',$config_company->work_schedule);
            if(in_array($ip,$list_ip)){
                if(in_array($date_crr,$work_schedule)) {
                    $history = new History_Attdance();
                    $history->time_start = $today->toTimeString();
                    $history->id_member = $user->id;
                    $history->device_start = $device;
                    $history->time_end = $today->toTimeString();
                    $history->ip_start = $ip;
                    $history->image = $_FILES['image']['name'];
                    $history->date_attendance = $today->toDateString();
                    $history->save();
                    return response() ->json([
                        'message'=>'Successfully attendance'
                    ],200);

                }
                else{
                    return response() ->json([
                        'message'=>'Beyond the time allowed'
                    ],401);

                }
            }
            else{
                return response() ->json([
                    'message'=>'ip not valid'
                ],401);
            }
        }
    }
    public function update($user,$ip,$list_ip,$device){
        if(in_array($ip,$list_ip)){
                $user = DB::table('history_attendance')
                    ->where('id',$user->id)
                    ->update(['time_end' => Carbon::now()->toTimeString(),'device_end'=>$device,'ip_end'=>$ip]);
                return response()->json([
                    'message'=>'Successfully attendance'
                ],200);
            }
        else{
            return response()->json([
                'message'=>'ip not valid'
            ],401);

        }
    }
    public function checkAll(Request $request){
        $history = DB::table('history_attendance')
            ->where('date_attendance',">" , $request->time_start)
            ->where('date_attendance',"<" , $request->time_end)
           ->get();
        return response()->json( $history ,200);
    }
    public function checkAl1l(Request $request){
        $history = DB::table('history_attendance')
            ->where('date_attendance',">" , $request->time_start)
            ->get();
        return response()->json( $history ,200);
    }
}
