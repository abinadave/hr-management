<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\MissionVision as MV;
class MissionVisionController extends Controller
{
    public function edit(Request $request){
    	DB::table('mission_visions')->truncate();
    	$mv = new MV;
    	$mv->mission = $request->input('mission');
    	$mv->vision = $request->input('vision');
    	$mv->save();
    	return response()->json($mv);
    }
    public function fetch(){
    	$data = MV::all();
    	return response()->json($data);
    }
}
