<?php

namespace App\Http\Controllers;

use App\Models\PostEmployee; // Assuming your model for employee posts is PostEmployee
use App\Models\Department; // Assuming your Department model
use Illuminate\Http\Request;

class PostEmployeeController extends Controller
{
    public function show()
    {
        // Fetch departments relevant to employees (adjust 'type' as per your Department model logic)
        $departments = Department::where('type', 'employee')
                                ->orWhere('type', 'both') // Include 'both' if departments can apply to both
                                ->orderBy('name')
                                ->get();

        $post_employees = PostEmployee::with('department')->get(); // Eager load department for display
        return view('employee.post_employee', compact('post_employees', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_employee' => 'required|string|max:255',
            'employee_status' => 'nullable|string|max:255',
        ]);

        try {
            PostEmployee::create([
                'department_id' => $request->department_id,
                'post_employee' => $request->post_employee,
                'employee_status' => $request->employee_status,
            ]);
            return redirect()->route('employee.post_employee')->with('success', 'Employee post saved successfully.');
        } catch (\Exception $e) {
            // dd($e->getMessage()); // Uncomment for debugging
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit($id)
    {
        // Find the specific employee post by ID
        $category = PostEmployee::findOrFail($id); // Using $category variable name as in your Blade

        // Fetch departments relevant to employees for the dropdown
        $departments = Department::where('type', 'employee')
                                ->orWhere('type', 'both')
                                ->orderBy('name')
                                ->get();

        // Also fetch all employee posts to display the table on the right side
        $post_employees = PostEmployee::with('department')->get();

        // Pass both the specific $category and the $post_employees list to the view
        return view('employee.post_employee', compact('category', 'post_employees', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_employee' => 'required|string|max:255',
            'employee_status' => 'nullable|string|max:255',
        ]);

        try {
            $category = PostEmployee::findOrFail($id); // Using $category variable name as in your Blade
            $category->update([
                'department_id' => $request->department_id,
                'post_employee' => $request->post_employee,
                'employee_status' => $request->employee_status,
            ]);

            return redirect()->route('employee.post_employee')->with('success', 'Employee post updated successfully.');
        } catch (\Exception $e) {
            // dd($e->getMessage()); // Uncomment for debugging
            return redirect()->back()->with('error', 'Error updating employee post.');
        }
    }

    public function destroy($id)
    {
        try {
            $postEmployee = PostEmployee::findOrFail($id);
            $postEmployee->delete();
            return redirect()->route('employee.post_employee')->with('success', 'Employee post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting employee post.');
        }
    }

    public function getPostEmployeesByDepartmentId($departmentId)
    {
        $postEmployees = PostEmployee::where('department_id', $departmentId)->get();
        return response()->json($postEmployees);
    }
}
