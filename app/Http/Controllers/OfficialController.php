<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Official as Official;
use App\User as User;
use App\SalaryGrade as SalaryGrade;
use App\Http\Controllers\SalaryGradeController as SalaryGradeController;

class OfficialController extends Controller
{
    public function updateOfficial(Request $request){
        $userId = $request->input('user_id');
        $officialId = $request->input('id');
        $user = User::findOrFail($userId);
        $official = Official::findOrFail($officialId);
        $salGrade = SalaryGrade::where('emp_id', $userId)->update([
            'value' => $request->input('salary_grade')
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->password != '') {
            $user->password = Hash::make($request->input('password'));
        }
        $official->dob = $request->input('dob');
        $official->city = $request->input('city');
        $official->phone = $request->input('phone');
        $official->location = $request->input('location');
        $official->address1 = $request->input('address1');
        $official->address2 = $request->input('address2');
        $official->date_of_joining = $request->input('date_of_joining');
        $official->date_of_leaving = $request->input('date_of_leaving');
        $official->status = $request->input('status');
        $official->position = $request->input('position');
        $rsOfficial = $official->save();
        $rsUser = $user->save();
        return response()->json([
            'rs_user' => $rsUser,
            'rs_official' => $rsOfficial
        ]);
    }
	public function fetchManagement(){
		return response()->json([
    		'positions' => \App\Position::orderBy('name','asc')->get(),
    		'officials' => Official::orderBy('id','desc')->get(),
    		'users' => User::orderBy('id','desc')->where('usertype', '<>', 'admin')->get()
    	]);
	}
    public function showPassword(Request $request){
       $decrypted = decrypt($request->input('password'));
       echo $decrypted;
    }    
    public function insert(Request $request){
    	$this->validate($request, [
            'name' => 'required|unique:users',
	        'dob' => 'required',
	        'city' => 'required',
	        'phone' => 'required|numeric|unique:employees',
            'email' => 'required|email|unique:users',
	        'address1' => 'required',
	        'address2' => 'required',
	        'date_of_joining' => 'required',
	        'status' => 'required',
	        'position' => 'required',
	        'location' => 'required'
	    ]);
	    $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        $official = $this->insertOfficial($user, $request);
        return response()->json([
            'user' => $user,
            'official' => $official
        ]);
    }
    private function insertOfficial($user, $request){
    	$official = new Official;
        $official->user_id = $user->id;
        $official->dob = $request->input('dob');
        $official->city = $request->input('city');
        $official->phone = $request->input('phone');
        $official->address1 = $request->input('address1');
        $official->address2 = $request->input('address2');
        $official->location = $request->input('location');
        $official->date_of_joining = $request->input('date_of_joining');
        $official->date_of_leaving = $request->input('date_of_leaving');
        $official->status = ($request->input('status') == 1) ? 1 : 0;
        $official->position = $request->input('position');
        $rs = $official->save();
        if ($rs) {
            $salGradeController = new SalaryGradeController();
            $salGradeController->insertSalaryGrade($user->id, $request->input('salary_grade'));
        }
        return $official;
    }
}
