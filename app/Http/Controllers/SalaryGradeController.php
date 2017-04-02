<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalaryGrade as SalaryGrade;

class SalaryGradeController extends Controller
{
    public function getSalary($empId){
        $count = SalaryGrade::where('emp_id', $empId)->count();
        echo $count;
    }
    public function insertSalaryGrade($empId, $sal){
    	$salGrade = new SalaryGrade;
    	$salGrade->emp_id = $empId;
    	$salGrade->value = $sal;
    	$salGrade->save();
    }
    public function fetch(){
    	return response()->json([
    		'salary_grades' => SalaryGrade::all()
    	]);
    }
}
