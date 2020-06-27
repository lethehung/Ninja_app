<?php

namespace App\Http\Controllers\API;

use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccount;
use App\User;

use CV\Face\LBPHFaceRecognizer, CV\CascadeClassifier, CV\Scalar, CV\Point;
use function CV\{imread,imwrite, cvtColor, equalizeHist, rectangleByRect, rectangle, putText};
use const CV\{COLOR_BGR2GRAY};


class AdminController extends Controller
{
    public function index(){
        return response()->json([User::all()],200);
    }
    public function createTestAPI(Request $request){
        $file = $_FILES;
        $listpic =array();

        $folder = 'Images/Test';
        $files = glob($folder . '/*');
        foreach($files as $file1){
            if(is_file($file1)){
                unlink($file1);
            }
        }

        foreach ($file as $k => $value){
            if(!empty($value["tmp_name"])){
                move_uploaded_file($value["tmp_name"], 'Images/Test/' . $value['name']);
                $listpic[] = "http://34.80.218.62/Images/Test/" . $value['name'];
            }
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://unlockv3.ninjateam.vn/api/NinjaUnlock/DetechPicture",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"name": "test","list_pic":'.json_encode($listpic).' }',
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
            echo $response;
            $response = json_decode($response);
        }

dd($response);





        $file = $_FILES;
        $user = new User([
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'facebook' => ($request->facebook),
            'zalo' => ($request->zalo),
            'id_department' => ($request->id_department),
            'id_cpny' => Auth::User()->id_cpny,
            'birth_day' => ($request->birth_day),
            'sex' => ($request->sex),
            'permission' => ($request->permission),
        ]);

        $faceClassifier = new CascadeClassifier();
        $faceClassifier->load('runphpopencv/models/lbpcascades/lbpcascade_frontalface.xml');
        $faceRecognizer = LBPHFaceRecognizer::create();
        $faceImages = $faceLabels = [];
        $facetest=null;
        for ($i=1 ;$i <6; $i++){
            $image = "images".$i;
            $src = imread($request->$image);
            $gray = cvtColor($src, COLOR_BGR2GRAY);
            $faceClassifier->detectMultiScale($gray, $faces);
            equalizeHist($gray, $gray);
            $facemax = null;
            $Acreage = 0;
            foreach ($faces as $k => $face) {
                if($face->height*$face->width > $Acreage){
                    $Acreage = $face->height*$face->width;
                    $facemax = $face;
                }
            }
            if($i == 1){
                $facetest = $gray->getImageROI($facemax);
            }
            $faceImages[] = $gray->getImageROI($facemax);
            $faceLabels[] = 3;
        }
        $faceRecognizer->read('name.txt');
        $faceRecognizer->update($faceImages,$faceLabels);

        $faceLabel = $faceRecognizer->predict($facetest, $faceConfidence);
        if($faceLabel != 3) {
            return response()->json([
                'message' => 'Try again'
            ],200);
        }
        $user->save();
        $id = $user->id;


        mkdir('Images/' . $id . '/avatar', 0777, true);
        mkdir('Images/' . $id . '/train', 0777, true);
        mkdir('Images/' . $id . '/root', 0777, true);
        if (!empty($file["avatar"]["tmp_name"])) {
            if (@is_array(getimagesize($file["avatar"]["tmp_name"]))) {
                move_uploaded_file($file["avatar"]["tmp_name"], 'Images/' . $id . '/avatar/' . $file["avatar"]['name']);
            }
        }
        for ($i=1 ;$i <6; $i++){
            $image = "images".$i;
            $src = imread($request->$image);
            $gray = cvtColor($src, COLOR_BGR2GRAY);
            $faceClassifier->detectMultiScale($gray, $faces);
            equalizeHist($gray, $gray);
            $facemax = null;
            $Acreage = 0;
            foreach ($faces as $k => $face) {
                if($face->height*$face->width > $Acreage){
                    $Acreage = $face->height*$face->width;
                    $facemax = $face;
                }
            }
            $faceLabels1[] = $id;
            imwrite('Images/' . $id . '/train/image'.$i.'.jpg',$gray->getImageROI($facemax));
            move_uploaded_file($request->$image, 'Images/' . $id . '/root/image'.$i .'.jpg');
        }
        $faceRecognizer = LBPHFaceRecognizer::create();
        $faceRecognizer->read('faceRecogziner.txt');
        $faceRecognizer->update($faceImages,$faceLabels1);
        $faceRecognizer->write('faceRecogziner.txt');
        $user->avatar = $file["avatar"]["name"];
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }


    public function store(StoreAccount $request)
    {
        $file = $_FILES;
        $user = new User([
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'facebook' => ($request->facebook),
            'zalo' => ($request->zalo),
            'id_department' => ($request->id_department),
            'id_cpny' => Auth::User()->id_cpny,
            'birth_day' => ($request->birth_day),
            'sex' => ($request->sex),
            'permission' => ($request->permission),
        ]);

        $faceClassifier = new CascadeClassifier();
        $faceClassifier->load('runphpopencv/models/lbpcascades/lbpcascade_frontalface.xml');
        $faceRecognizer = LBPHFaceRecognizer::create();
        $faceImages = $faceLabels = [];
        $facetest=null;
        for ($i=1 ;$i <6; $i++){
                $image = "images".$i;
                $src = imread($request->$image);
                $gray = cvtColor($src, COLOR_BGR2GRAY);
                $faceClassifier->detectMultiScale($gray, $faces);
                equalizeHist($gray, $gray);
                $facemax = null;
                $Acreage = 0;
                foreach ($faces as $k => $face) {
                    if($face->height*$face->width > $Acreage){
                        $Acreage = $face->height*$face->width;
                        $facemax = $face;
                    }
                }
                if($i == 1){
                    $facetest = $gray->getImageROI($facemax);
                }
                $faceImages[] = $gray->getImageROI($facemax);
                $faceLabels[] = 3;
        }
        $faceRecognizer->read('name.txt');
        $faceRecognizer->update($faceImages,$faceLabels);

        $faceLabel = $faceRecognizer->predict($facetest, $faceConfidence);
        if($faceLabel != 3) {
            return response()->json([
                'message' => 'Try again'
            ],200);
        }
        $user->save();
        $id = $user->id;


        mkdir('Images/' . $id . '/avatar', 0777, true);
        mkdir('Images/' . $id . '/train', 0777, true);
        mkdir('Images/' . $id . '/root', 0777, true);
        if (!empty($file["avatar"]["tmp_name"])) {
            if (@is_array(getimagesize($file["avatar"]["tmp_name"]))) {
                move_uploaded_file($file["avatar"]["tmp_name"], 'Images/' . $id . '/avatar/' . $file["avatar"]['name']);
            }
        }
        for ($i=1 ;$i <6; $i++){
            $image = "images".$i;
            $src = imread($request->$image);
            $gray = cvtColor($src, COLOR_BGR2GRAY);
            $faceClassifier->detectMultiScale($gray, $faces);
            equalizeHist($gray, $gray);
            $facemax = null;
            $Acreage = 0;
            foreach ($faces as $k => $face) {
                if($face->height*$face->width > $Acreage){
                    $Acreage = $face->height*$face->width;
                    $facemax = $face;
                }
            }
            $faceLabels1[] = $id;
            imwrite('Images/' . $id . '/train/image'.$i.'.jpg',$gray->getImageROI($facemax));
            move_uploaded_file($request->$image, 'Images/' . $id . '/root/image'.$i .'.jpg');
        }
        $faceRecognizer = LBPHFaceRecognizer::create();
        $faceRecognizer->read('faceRecogziner.txt');
        $faceRecognizer->update($faceImages,$faceLabels1);
        $faceRecognizer->write('faceRecogziner.txt');
        $user->avatar = $file["avatar"]["name"];
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function destroy($id){
        $user = User::find($id);
        if($user->id_cpny == Auth::user()->id_cpny){
            if(!empty($user))
                $user->delete();
            return response()->json([
                'message' => 'Successfully delete user!'
            ],200);
        }
        else{
            return response()->json([
                'message' => 'Permission Denied!'
            ],400);

        }
    }
    public function edit(Request $request,$id){
        $user = User::find($id);
        $file= $_FILES;
        if($user->id_cpny == Auth::user()->id_cpny) {
            $user->phone = $request->phone;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->facebook = $request->facebook;
            $user->zalo = $request->zalo;
            $user->id_department = $request->id_department;
            $user->id_cpny = $request->id_cpny;
            $user->birth_day = $request->birth_day;
            $user->sex = $request->sex;
            $user->permission = $request->permission;
            if (!empty($file["avatar"]["tmp_name"])) {
                if (@is_array(getimagesize($file["avatar"]["tmp_name"]))) {
                    if (file_exists('Images/' . $id . '/avatar/' . $user->avatar))
                        unlink('Images/' . $id . '/avatar/' . $user->avatar);
                    move_uploaded_file($file["avatar"]["tmp_name"], 'Images/' . $id . '/avatar/' . $file["avatar"]['name']);
                    $user->avatar = $file["avatar"]['name'];
                }
            }
            $user->save();
            return response()->json([
                'message' => 'Successfully update user!'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Permission Denied!'
            ],400);

        }
    }
    public function show($id)
    {
        $user = User::find($id);
        if ($user->id_cpny == Auth::user()->id_cpny) {
            return response()->json([
                User::find($id)
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Permission Denied!'
            ],400);

        }
    }
}
