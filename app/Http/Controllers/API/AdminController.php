<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccount;
use App\User;

class AdminController extends Controller
{
    public function createuser(StoreAccount $request){
        dd(($request->image));
        $user = new User();
        $user->name = $request->name;
        $user->permission = $request->permission;
        $user->id_department = $request->department;
        $user->facebook = $request->facebook;
        $user->name = $request->name;
        $user->name = $request->name;
        $user->name = $request->name;
        $user->name = $request->name;
        $user->name = $request->name;
    }

}
