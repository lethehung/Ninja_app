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
    public function test(){
        $faceClassifier = new CascadeClassifier();
        $faceClassifier->load('runphpopencv/models/lbpcascades/lbpcascade_frontalface.xml');

        $faceRecognizer = LBPHFaceRecognizer::create();

        $labels = ['unknown', 'me', 'angelina'];

// me
        $src = imread("runphpopencv/me/me.png");
        $gray = cvtColor($src, COLOR_BGR2GRAY);
        $faceClassifier->detectMultiScale($gray, $faces);
        var_export($faces);

        equalizeHist($gray, $gray);
        $faceImages = $faceLabels = [];
        foreach ($faces as $k => $face) {
            $faceImages[] = $gray->getImageROI($face); // face coordinates to image
            $faceLabels[] = 1; // me
        }
        $faceRecognizer->train($faceImages, $faceLabels);
// angelina
        $src = imread("runphpopencv/images/angelina_faces.png");
        $gray = cvtColor($src, COLOR_BGR2GRAY);
        $faceClassifier->detectMultiScale($gray, $faces);
        var_export($faces);
        equalizeHist($gray, $gray);
        $faceImages = $faceLabels = [];
        foreach ($faces as $k => $face) {
            $faceImages[] = $gray->getImageROI($face); // face coordinates to image
            $faceLabels[] = 2; // Angelina
        }
        $faceRecognizer->update($faceImages, $faceLabels);


        $src = imread("runphpopencv/images/angelina_and_me.png");
        $gray = cvtColor($src, COLOR_BGR2GRAY);
        $faceClassifier->detectMultiScale($gray, $faces);
        equalizeHist($gray, $gray);
        foreach ($faces as $face) {
            $faceImage = $gray->getImageROI($face);

            //predict
            $faceLabel = $faceRecognizer->predict($faceImage, $faceConfidence);
            echo "{$faceLabel}, {$faceConfidence}\n";

            $scalar = new Scalar(0, 0, 255);
            rectangleByRect($src, $face, $scalar, 2);

            $text = $labels[$faceLabel];
            rectangle($src, $face->x, $face->y, $face->x + ($faceLabel == 1 ? 50 : 130), $face->y - 30, new Scalar(255,255,255), -2);
            putText($src, "$text", new Point($face->x, $face->y - 2), 0, 1.5, new Scalar(), 2);
        }
        imwrite("_recognize_face_by_lbph.jpg", $src);
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
