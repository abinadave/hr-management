<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role as Role;
use DB;
class RoleController extends Controller
{
    public function insert(Request $request){
    	 $this->validate($request, [
	        'name' => 'required|unique:roles|max:50|min:3'
	    ]);
    	$role = new Role;
    	$role->name = $request->input('name');
    	$role->save();
    	return $role;
    }
    public function delete($id){
    	$role = Role::where('id', $id)->first();
    	$count = DB::table('employees')->where('role', $role->name)->count();
    	$rs = false;
    	if (!$count) {
			$rs = $role->delete();
    	}
    	return response()->json([
			'employee_with_role' => $count,
			'deleted' => $rs
		]);
    }
}
