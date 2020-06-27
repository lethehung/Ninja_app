<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use http\Client\Response;
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
    public function getCountImage($id){
        $file = $_FILES;
        $listpic =array();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unlockv3.ninjateam.vn/api/NinjaUnlock/CountPicture",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"name": "'.$id.'"}',
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }
        if($response->count <= 5) {
           return false;
        }
        else return true;
    }
    public function checkIdentification($image,$id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unlockv3.ninjateam.vn/api/NinjaUnlock/DetechPicture",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"name": "'.$id.'","list_pic": '.json_encode($image).' }',
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }
        if($response->count != 5) {
            return response()->json([
                "message" => "Not identified enough"
            ], 401);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unlockv3.ninjateam.vn/api/NinjaUnlock/SeachPicture",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"name": "test","pic":"'.$image[0].'" }',
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }
        if($response->status == false)
           return false;

        else
            return true;
    }
    public function deleteFolder($id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unlockv3.ninjateam.vn/api/NinjaUnlock/DeleteFolder",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"name": "'.$id.'"}',
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }
        if($response->status == false)
            return false;

        else
            return true;

    }
    public function createFolder(Request $request){
        $image= array();
        if(!file_exists('Images/'.$request->id.'/train'))
        mkdir('Images/'.$request->id.'/train', 0777, true);
        foreach ($_FILES as $k => $val){
           if(!empty($val["tmp_name"])){
               move_uploaded_file($val["tmp_name"],'Images/'.$request->id.'/train/'.$val["name"]);
               $image[] = "http://34.80.218.62/".'Images/'.$request->id.'/train/'.$val["name"];
           }
        }
        if($this->checkIdentification($image,$request->id)){
            return response()->json(['message'=>'Successfully Identification'],200);
        }
        else{
            $this->deleteFolder($request->id);
        }
    }

    public function test(Request $request){
        $checkcout = $this->getCountImage($request->id);
        if(!$checkcout)
            return Response()->json(['message' => "Image not enough"],401);
        $file_dic ="";
        if(!empty($_FILES["image"]["tmp_name"])){
            $file_dic = "Images/Test/".$_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"],$file_dic);
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unlockv3.ninjateam.vn/api/NinjaUnlock/SeachPicture",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"name": "test","pic":"'.$file_dic.'" }',
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }
        if($response->message != "Đã tìm thấy"){
            return response()->json([
                "message" => "Failure identification"
            ],200);
            die();
        }
        dd($response);
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
