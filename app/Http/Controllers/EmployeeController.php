<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PostCategory;
use App\Models\Office;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departmentId = $request->query('department_id');

        $query = Employee::with(['department', 'postcategory', 'updatedBy']);
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
            'post_category_id' => 'required|integer|exists:post_categories,id',
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
                'employee_id' => $request->employee_id,
                'post_category_id' => $request->post_category_id,
                'employee_email' => $request->employee_email,
                'employee_address' => $request->employee_address,
                'employee_image' => $path,
                'remark' => $request->remark,
                'updated_by' => \Illuminate\Support\Facades\Auth::user()->id,
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
        $employees = Employee::findOrFail($id);

        $employees->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully!');
    }


    public function edit($id)
{
    $post_categories = PostCategory::all();
    $employees = Employee::findOrFail($id);
    $departments = Department::all(); // Add this line
    $offices = Office::all();
    return view('employee.create_employee', compact('post_categories', 'employee', 'offices', 'departments'));
}


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_phone' => 'required|string|max:10',
            'department_id' => 'required|exists:departments,id',
            'post_category_id' => 'required|integer|exists:post_categories,id',
            'employee_email' => 'nullable|email|max:255',
            'employee_address' => 'nullable|string|max:255',
            'employee_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

        $employees = Employee::findOrFail($id);

        try {
            if ($request->file('employee_image')) {
                $path = Storage::putFile('employee_image', $request->file('employee_image'));
            } else {
                $path = $employees->employee_image; // Retain the existing image if no new image is uploaded
            }

            $employees->update([
                'employee_name' => $request->employee_name,
                'employee_phone' => $request->employee_phone,
                'department_id' => $request->department_id,
                'post_category_id' => $request->post_category_id,
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
    $post_categories = PostCategory::all();
    $offices = Office::all();
    return view('employee.create_employee', compact('departments', 'post_categories', 'offices'));
    // return view('employee.create', compact('departments', 'post_categories'));
}
}
