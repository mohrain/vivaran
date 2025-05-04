<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Office;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function create()
    {
        $offices = Office::all();
        return view('department.create', compact('offices'));
    }

    public function store(Request $request)
    {
        
        // return $request;
        // $validated = $request->validate([
        //     'office_id' => 'required|exists:offices,id',
        //     'name' => 'required|string|max:255',
        //     'email' => 'nullable|email|max:255',
        //     'phone' => 'nullable|string|max:10',
        //     'address' => 'nullable|string|max:255',
        //     'code' => 'nullable|string|max:50',
        //     'description' => 'nullable|string',
        // ]);

        try {
        $department  =  Department::create([
            'office_id' => $request->office_id,
            'name' => $request->department_name,
            'description' => $request->department_description,
            
        ]);

        return redirect()->route('department.index')->with('success', 'कार्यालयको विवरण सफलतापूर्वक समावेश गरियो। (Office details saved successfully.)');
    } catch (\Exception $e) {
        // return redirect()->back()->withInput()->with('error', 'केही समस्या आयो। कृपया पुनः प्रयास गर्नुहोस्। (Something went wrong. Please try again.)');
        echo $e->getMessage();
    }
 }

    public function index()
    {
        $departments = Department::with('office')->oldest()->paginate(7);
        return view('department.index', compact('departments'));
    }

    public function edit($id)
    {
        $offices = Office::all(); 
        $department = Department::findOrFail($id);
        return view('department.create', compact('department', 'offices'));
    }
    
    
public function update(Request $request, Department $department)
{
    // $validated = $request->validate([
    //     'office_id' => 'required|exists:offices,id',
    //     'department_name' => 'required|string|max:255',
    //     'department_email' => 'nullable|email|max:255',
    //     'department_phone' => 'nullable|string|max:20',
    //     'department_address' => 'nullable|string|max:255',
    //     'department_code' => 'nullable|string|max:50',
    //     'department_description' => 'nullable|string',
    // ]);

    try {
        $department->update([
            'office_id' => $request->office_id,
            'name' => $request->department_name,
            'description' => $request->department_description,
        ]);

        return redirect()->route('department.index')->with('success', 'Department updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Error updating department: ' . $e->getMessage());
    }
}


public function destroy(Department $department)
{
    try {
        $department->delete();
        return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक हटाइयो।');
    } catch (\Exception $e) {
        return back()->with('error', 'हटाउँदा समस्या आयो: ' . $e->getMessage());
    }
}


}