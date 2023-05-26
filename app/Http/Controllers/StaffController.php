<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
   
    public function index()
    {
        $staffs = Staff::all();
        return response()->json($staffs); 
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $staff = new Staff([
            'name' => $request->input('name'),
            'image' => $request->input('image'),
        ]);
        dd($staff );
        $staff->save();
        return response()->json('staff created!');
    }

   
    public function show(Staff $staff)
    {
        //
    }

    public function edit(Staff $staff)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->update($request->all());
        return response()->json('staff updated');
    }

    
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();
        return response()->json('staff message from Controller!');
    }
}
