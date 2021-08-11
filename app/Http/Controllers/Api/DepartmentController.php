<?php

namespace App\Http\Controllers\Api;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
         $department=Department::all();
        return response()->json($department);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'name' => 'required',
        ]);
        $department = new Department;
        $department->name = $request->name;
        $department->save();
    }

    public function show($id)
    {
        $department= DB::table('departments')->where('id',$id)->first();
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $data=array();
        $data['name']=$request->name;
        DB::table('departments')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('departments')->where('id',$id)->delete();
    }
}
