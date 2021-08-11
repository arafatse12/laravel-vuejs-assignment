<?php

namespace App\Http\Controllers\Api;

use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function index()
    {
        $result=DB::table('results')
        ->join('students','students.id','results.student_id')
        ->join('departments','departments.id','students.department_id')
        ->select('departments.name as department_name','students.name as student_name','results.*')
        ->orderBy('results.id','DESC')
        ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'student_id' => 'required',
         'gpa' => 'required',
         'date' => 'required',
        ]);
        $result = new Result;
        $result->student_id = $request->student_id;
        $result->gpa = $request->gpa;
        $result->date = $request->date;
        $result->save();
    }

    public function show($id)
    {
        $result=DB::table('results')->where('id',$id)->first();
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $data=array();
        $data['student_id']=$request->student_id;
        $data['gpa']=$request->gpa;
        $data['date']=$request->date;
        DB::table('results')->where('id',$id)->update($data);

    }

    public function destroy($id)
    {
        DB::table('results')->where('id',$id)->delete();
    }
}
