<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentControlle extends Controller
{
    public function index(){
        return view('students');
    }
    
    public function fetch(){
        
        $students = Students::all();
        return response() -> json([
            'students'=> $students
        ]);
    }

    public function edit($id){
        
        $students = Students::find($id);
        return response() -> json([
            'students'=> $students
        ]);
    }

    public function Delete($id){
        
        $student = Students::find($id);
        $student->delete();
        return response() -> json([
            'message'=> "Student deleted successfully...!"
        ]);
    }

    public function insert(Request $request){
        
        $student = new Students();
        $student->name = $request->input('name');
        $student->course = $request->input('course');
        $student->phone = $request->input('phone');
        $student->email = $request->input('email');
        $student->save();

        return response()->json([
            'data'=> $student,
            'message'=> 'Student Added Successfully...!' 
        ]);
    }

    public function update(Request $request){
        
        $id= $request->input('id');
        $student = Students::find($id);
        $student->name = $request->input('name');
        $student->course = $request->input('course');
        $student->phone = $request->input('phone');
        $student->email = $request->input('email');
        $student->update();

        return response()->json([
            'data'=> $student,
            'message'=> 'Student Updated Successfully...!' 
        ]);
    }

    
}
