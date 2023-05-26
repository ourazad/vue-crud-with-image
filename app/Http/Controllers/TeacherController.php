<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);     
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $teacher = new Teacher([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);
        $teacher->save();
        return response()->json('teacher created!');
    }

    public function show(Student $student)
    {
        //
    }

    public function edit(Student $student)
    {
        
    }

    public function update(Request $request,  $id)
    {
        $teacher = Teacher::find($id);
        $teacher->update($request->all());
        return response()->json('teacher updated');
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return response()->json('deleted message from Controller!');
    }
}
