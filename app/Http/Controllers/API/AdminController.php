<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccount;
use App\User;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class AdminController extends Controller
{
    public function index(){
        return response()->json([User::all()],200);
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
            'id_cpny' => ($request->id_cpny),
            'birth_day' => ($request->birth_day),
            'sex' => ($request->sex),
            'permission' => ($request->permission),
        ]);
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
        $user->avatar = $file["avatar"]["name"];
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'message' => 'Successfully delete user!'
        ],200);
    }
    public function update(Request $request,$id){
        $user = User::find($id);
        $user->phone = $request->phone;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->facebook = $request->facebook;
        $user->zalo =$request->zalo;
        $user->id_department = $request->id_department;
        $user->id_cpny = $request->id_cpny;
        $user->birth_day = $request->birth_day;
        $user->sex = $request->sex;
        $user->permission = $request->permission;
        if (!empty($file["avatar"]["tmp_name"])) {
            if (@is_array(getimagesize($file["avatar"]["tmp_name"]))) {
                unlink('Images/' . $id . '/avatar/' . $user->avatar);
                move_uploaded_file($file["avatar"]["tmp_name"], 'Images/' . $id . '/avatar/' . $file["avatar"]['name']);
            }
        }
        $user->save();
    }
    public function show($id){
        return response()->json([
           User::find($id)
        ],200);
    }
}
