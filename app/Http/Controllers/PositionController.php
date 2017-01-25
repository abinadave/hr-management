<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position as Position;

class PositionController extends Controller
{
    public function insert(Request $request){
    	$this->validate($request, [
    		'name' => 'required|unique:positions'
    	]);
    	$position = new Position;
    	$position->name = $request->input('name');
    	$position->save();
    	return $position;
    }
    
}
