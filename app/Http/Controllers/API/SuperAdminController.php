<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\StoreCompany_Edit;
use App\Company;
use App\Configuration;


class SuperAdminController extends Controller
{

    public function index()
    {
        return response()->json(
            Company::all(),200);
    }

    public function store(StoreCompany $request)
    {
        $company = new Company([
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'facebook' => $request->facebook,
            'zalo' => $request->zalo,
            'address' => $request->address,
            'type' => $request->type,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'date_sell' => $request->date_sell,
        ]);
        $company->save();
        $id = $company->id;
        $configuration = new Configuration([
            'time_start' => '08:00:00',
            'time_end' => '17:00:00',
            'work_schedule' => '2|7',
            'ip'=>'0.0.0.0',
            'location'=>'Hanoi',
            'id_cpny'=>$id
        ]);
        $configuration->save();
        if (!empty($file["avatar"]["tmp_name"])) {
            if (@is_array(getimagesize($file["avatar"]["tmp_name"]))) {
                move_uploaded_file($file["avatar"]["tmp_name"], 'Images/Company/' .$file["avatar"]["name"]);
                $company->avatar = $file["avatar"]["name"] ;
            }
        }
        $company->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function destroy($id){
        $user = Company::find($id);
            if(!empty($user))
                $user->delete();
            return response()->json([
                'message' => 'Successfully delete user!'
            ],200);
    }


    public function show($id)
    {
        return response()->json(
            Company::find($id),200);

    }
    public function update($id)
    {

    }

    public function edit(StoreCompany_Edit $request, $id)
    {
        $file = $_FILES;
        $company = Company::find($id);
        if(!empty($company)) {
            $company = Company([
                'email' => $request->email,
                'phone' => $request->phone,
                'name' => $request->name,
                'facebook' => $request->facebook,
                'zalo' => $request->zalo,
                'address' => $request->address,
                'type' => $request->type,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'date_sell' => $request->date_sell,
            ]);
            if (!empty($file["avatar"]["tmp_name"])) {
                if (@is_array(getimagesize($file["avatar"]["tmp_name"]))) {
                    move_uploaded_file($file["avatar"]["tmp_name"], 'Images/Company/'.$file["avatar"]["name"]);
                    $company->avatar = $file["avatar"]["name"];
                }
            }
            $company->save();
            return response()->json([
                'message' => 'Successfully Update Company!'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Not Found Company!'
            ], 401);
        }
    }
}
