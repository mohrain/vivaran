<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PostEmployee;
use App\Models\Office;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departmentId = $request->query('department_id');

        $query = Employee::with(['department', 'postemployee', 'updatedBy']);
        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }

        $employees = $query->oldest()->paginate(6); // Show 10 items per page

        return view('employee.index', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_phone' => 'required|string|max:10',
            'department_id' => 'required|exists:departments,id',
            'post_employee_id' => 'required|integer|exists:post_employees,id',
            'employee_email' => 'nullable|email|max:255',
            'employee_address' => 'nullable|string|max:255',
            'employee_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

        try {
            $path = null; // Initialize path as null

            if ($request->hasFile('employee_image')) {
                $path = $request->file('employee_image')->store('employees', 'public');
            }

            Employee::create([
                'employee_name' => $request->employee_name,
                'employee_phone' => $request->employee_phone,
                'department_id' => $request->department_id,
                'post_employee_id' => $request->post_employee_id,
                'employee_email' => $request->employee_email,
                'employee_address' => $request->employee_address,
                'employee_image' => $path,
                'remark' => $request->remark,
                'updated_by' => \Illuminate\Support\Facades\Auth::user()->id,
            ]);

            return redirect()->route('employee.index')->with('success', 'Employee created successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // return redirect()->back()
            //     ->withInput()
            //     ->with('error', 'Error creating employee: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $employees = Employee::findOrFail($id);

        $employees->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully!');
    }


    public function edit($id)
{
    $post_employees = PostEmployee::all();
    $employee = Employee::findOrFail($id);
    $departments = Department::all(); // Add this line
    $offices = Office::all();
    return view('employee.create_employee', compact('post_employees', 'employee', 'offices', 'departments'));
}


    public function update(Request $request, $id)
    {
        $validated = $request->validate([

            'employee_name' => 'required|string|max:255',
            'employee_phone' => 'required|string|max:10',
            'department_id' => 'required|exists:departments,id',
            'post_employee_id' => 'required|integer|exists:post_employees,id',
            'employee_email' => 'nullable|email|max:255',
            'employee_address' => 'nullable|string|max:255',
            'employee_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

        $employee = Employee::findOrFail($id);

        try {
            if ($request->file('employee_image')) {
                $path = Storage::putFile('employee_image', $request->file('employee_image'));
            } else {
                $path = $employee->employee_image; // Retain the existing image if no new image is uploaded
            }

            $employee->update([
                'employee_name' => $request->employee_name,
                'employee_phone' => $request->employee_phone,
                'department_id' => $request->department_id,
                'post_employee_id' => $request->post_employee_id,
                'employee_email' => $request->employee_email,
                'employee_address' => $request->employee_address,
                'employee_image' => $path,
                'remark' => $request->remark,
                'updated_by' => \Illuminate\Support\Facades\Auth::user()->id,
            ]);

            return redirect()->route('employee.index')->with('success', 'कर्मचारी सफलतापूर्वक अपडेट गरियो।');
        } catch (\Exception $e) {
            return back()->with('error', 'केही समस्या आयो: ' . $e->getMessage());
        }
    }
    public function show()
{
    $departments = Department::all();
    $post_employees = PostEmployee::all();
    $offices = Office::all();
    return view('employee.create_employee', compact('departments', 'post_employees', 'offices'));
    // return view('employee.create', compact('departments', 'post_categories'));
}

public function postEmployees($departmentId)
{
    return PostEmployee::where('department_id', $departmentId)->get();
}
}
