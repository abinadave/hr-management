<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User as User;
use App\Employee as Employee;

class EmployeeController extends Controller
{
    public function fetchbyActiveANdNOne($type){
        if($type == '2'){
            return response()->json([
                'employees' => Employee::orderBy('id','desc')->get()
            ]);
        }else {
             return response()->json([
                'employees' => Employee::where('status', $type)->orderBy('id','desc')->get()
            ]);     
        }
       
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
	        'role' => 'required'
	    ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        $emp = $this->insertEmployee($user, $request);
        return response()->json([
            'user' => $user,
            'employee' => $emp
        ]);
    }

    public function insertEmployee($user, $request){
        $emp = new Employee;
        $emp->user_id = $user->id;
        $emp->dob = $request->input('dob');
        $emp->city = $request->input('city');
        $emp->phone = $request->input('phone');
        $emp->address1 = $request->input('address1');
        $emp->address2 = $request->input('address2');
        $emp->date_of_joining = $request->input('date_of_joining');
        $emp->date_of_leaving = $request->input('date_of_leaving');
        $emp->status = ($request->input('status') == 'Active') ? 1 : 0;
        $emp->role = $request->input('role');
        $rs = $emp->save();
        if ($rs) {
            $salGrade = new \App\SalaryGrade;
            $salGrade->value = $request->input('salary_grade');
            $salGrade->emp_id = $emp->id;
            $salGrade->save();
        }
        return $emp;
    }

    public function emloyeeManagement(){
    	return response()->json([
    		'roles' => \App\Role::orderBy('name','asc')->get(),
    		'employees' => Employee::orderBy('id','desc')->get(),
    		'users' => User::orderBy('id','desc')->where('usertype', '<>', 'admin')->get()
    	]);
    }
}
