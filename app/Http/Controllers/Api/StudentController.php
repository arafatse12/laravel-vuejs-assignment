<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{


    public function index()
    {
         $student=DB::table('students')
                ->join('departments','departments.id','students.department_id')
                ->leftjoin('results','results.student_id','students.id')
                ->select('departments.name as department_name','results.gpa as gpa','students.*')
                ->orderBy('students.id','DESC')
                ->get();
        return response()->json($student);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'name' => 'required|max:255',
         'department_id' => 'required',
         'batch_name' => 'required',
        ]);
        $student = new Student;
        $student->name = $request->name;
        $student->department_id = $request->department_id;
        $student->batch_name = $request->batch_name;
        $student->save();
    }

    public function show($id)
    {
        $student=DB::table('students')->where('id',$id)->first();
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['department_id']=$request->department_id;
        $data['batch_name']=$request->batch_name;
        DB::table('students')->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        DB::table('students')->where('id',$id)->delete();
    }
}
