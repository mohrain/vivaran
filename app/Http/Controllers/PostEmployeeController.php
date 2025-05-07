<?php

namespace App\Http\Controllers;

use App\Models\PostEmployee;
use App\Models\Department;
use Illuminate\Http\Request;

class PostEmployeeController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request->all());


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
                'office_id' => $request->office_id,
            ]);
            return redirect()->route('employee.post_employee')->with('success', 'Post employee saved successfully.');
        } catch (\Exception $e) {
                dd($e->getMessage()); // This will help you know the exact problem.
                return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }
        }


    public function show()
    {
        $post_employees = PostEmployee::with('department')->get();
        $departments = Department::all();
        return view('employee.post_employee', compact('post_employees', 'departments'));
    }

    public function edit($id)
    {
        $category = PostEmployee::findOrFail($id);
        $post_employees = PostEmployee::latest()->get();
        $departments = Department::all();
        return view('employee.post_category', compact('category', 'post_employees', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_employee' => 'required|string|max:255',
            'employee_status' => 'nullable|string|max:255',
            'office_id' => 'nullable|exists:offices,id',
        ]);

        try {
            $category = PostEmployee::findOrFail($id);
            $category->update([
                'department_id' => $request->department_id,
                'post_employee' => $request->post_employee,
                'employee_status' => $request->employee_status,
                'office_id' => $request->office_id,
            ]);

            return redirect()->route('employee.post_employee')->with('success', ' updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating category');
        }
    }

    public function destroy($id)
    {
        try {
            $postemployee = PostEmployee::findOrFail($id);
            $postemployee->delete();
            return redirect()->route('employee.post_employee')->with('success', 'Deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting post category.');
        }
    }

    public function getPostEmployeesByDepartmentId($departmentId)
    {
        $postemployees = PostEmployee::where('department_id', $departmentId)->get();
        return response()->json($postemployees);
    }
}
