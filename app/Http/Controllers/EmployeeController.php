<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PostEmployee;
use App\Models\Office;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Don't forget to import Auth

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departmentId = $request->query('department_id');

        $query = Employee::with(['department', 'postemployee', 'updatedBy']);
        $currentDepartmentName = null; // Initialize to null

        if ($departmentId) {
            $query->where('department_id', $departmentId);
            $department = Department::find($departmentId); // Fetch the department
            if ($department) {
                $currentDepartmentName = $department->name; // Get its name
            }
        }

        $employees = $query->oldest()->paginate(6);


        return view('employee.index', compact('employees', 'currentDepartmentName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_phone' => 'required|string',
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
                'updated_by' => Auth::user()->id, // Use the imported Auth facade
            ]);

            return redirect()->route('employee.index')->with('success', 'Employee created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating employee: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id); // Use $employee for consistency

        // Optional: Delete the associated image from storage
        if ($employee->employee_image) {
            Storage::disk('public')->delete($employee->employee_image);
        }

        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully!');
    }


    public function edit($id)
    {
        $departments = Department::where('type', 'employee')
            ->orWhere('type', 'both')
            ->orderBy('name')
            ->get();
        $post_employees = PostEmployee::all();
        $employee = Employee::findOrFail($id);
        // $departments = Department::all();
        $offices = Office::all();
        return view('employee.create_employee', compact('post_employees', 'employee', 'offices', 'departments'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_phone' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'post_employee_id' => 'required|integer|exists:post_employees,id',
            'employee_email' => 'nullable|email|max:255',
            'employee_address' => 'nullable|string|max:255',
            'employee_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

        $employee = Employee::findOrFail($id);

        try {
            $path = $employee->employee_image; // Start with the existing image path

            if ($request->hasFile('employee_image')) {
                // Delete old image if it exists
                if ($employee->employee_image) {
                    Storage::disk('public')->delete($employee->employee_image);
                }
                $path = $request->file('employee_image')->store('employees', 'public'); // Store in 'employees' directory
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
                'updated_by' => Auth::user()->id, // Use the imported Auth facade
            ]);

            return redirect()->route('employee.index')->with('success', 'कर्मचारी सफलतापूर्वक अपडेट गरियो।');
        } catch (\Exception $e) {
            return back()->with('error', 'केही समस्या आयो: ' . $e->getMessage());
        }
    }

    public function show()
    {
        $departments = Department::where('type', 'employee')
            ->orWhere('type', 'both')
            ->orderBy('name')
            ->get();
        // $departments = Department::all();
        $post_employees = PostEmployee::all();
        $offices = Office::all();
        return view('employee.create_employee', compact('departments', 'post_employees', 'offices'));
    }

    public function postEmployees($departmentId)
    {
        return PostEmployee::where('department_id', $departmentId)->get();
    }
}
