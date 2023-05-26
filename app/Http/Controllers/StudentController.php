<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);     
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $student = new Student([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);
        $student->save();
        return response()->json('student created!');
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
        $student = Student::find($id);
        $student->update($request->all());
        return response()->json('Student updated');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json('deleted message from Controller!');
    }
}
