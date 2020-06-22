<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuration;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{

    public function show($id)
    {
        if(Auth::user()->id_cpny == $id){
            return response()->json(
                Configuration::find($id),200
            );
        }
        else{
            return response()->json([
               'message' => 'permission denied'],401
            );
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->id_cpny == $id){
            $conf = \DB::table('configuration_cpny')
                ->where('id_cpny', $id)
                ->update([
                    'time_start'=>$request->time_start,
                    'time_end'=>$request->time_end,
                    'work_schedule'=>$request->work_schedule,
                    'ip'=>$request->ip,
                    'location'=>$request->location,
                    ]);
            return response()->json(
                ['message'=>'Successfully update Configuration'],200
            );
        }
        else{
            return response()->json([
                'message' => 'permission denied'
            ],401
            );
        }
    }

}
