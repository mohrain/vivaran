<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // For error logging

class DepartmentController extends Controller
{
    public function create()
    {
        // Scope offices based on user role
        if (Auth::user()->hasRole('super-admin')) {
            $offices = Office::all();
        } else {
            // Assuming 'admin' role is scoped to their office
            $offices = Office::where('id', Auth::user()->office_id)->get();
        }
        return view('department.create', compact('offices'));
    }

    public function store(Request $request)
    {
        // Validation rules matching your *existing* table columns: 'name' and 'description'

        $validatedData = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'name' => 'required|string|max:255',               // Validation key is 'name'
            'description' => 'nullable|string',                 // Validation key is 'description'
            'type' => 'required|in:employee,representative,both', // New 'type' validation
        ]);

        try {
            // Add office scoping logic here if it's not handled by a policy
            if (!Auth::user()->hasRole('super-admin') && $validatedData['office_id'] != Auth::user()->office_id) {
                return redirect()->back()->withInput()->with('error', 'तपाईंले आफ्नो कार्यालयमा मात्र विभाग थप्न सक्नुहुन्छ।'); // You can only add departments to your own office.
            }

            Department::create([
                'office_id' => $validatedData['office_id'],
                'name' => $validatedData['name'],           // Assign to 'name' column
                'description' => $validatedData['description'], // Assign to 'description' column
                'type' => $validatedData['type'],           // Assign to 'type' column
            ]);


            return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक थपियो।'); // Department successfully added.
        } catch (\Exception $e) {
            Log::error('Error adding department: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'केही समस्या आयो। कृपया पुनः प्रयास गर्नुहोस्।'); // Something went wrong. Please try again.
        }
    }

    public function index()
    {
        // Scope departments based on user role
        if (Auth::user()->hasRole('super-admin')) {
            $departments = Department::with('office')->oldest()->paginate(7);
        } else {
            $departments = Department::with('office')
                                     ->where('office_id', Auth::user()->office_id)
                                     ->oldest()
                                     ->paginate(7);
        }
        return view('department.index', compact('departments'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);

        // Ensure user can only edit departments within their office, unless super-admin
        if (!Auth::user()->hasRole('super-admin') && $department->office_id != Auth::user()->office_id) {
            abort(403, 'Unauthorized action.'); // Or redirect with an error message
        }

        // Scope offices based on user role, similar to create method
        if (Auth::user()->hasRole('super-admin')) {
            $offices = Office::all();
        } else {
            $offices = Office::where('id', Auth::user()->office_id)->get();
        }

        return view('department.create', compact('department', 'offices'));
    }

    public function update(Request $request, Department $department)
    {
        // Ensure user can only update departments within their office, unless super-admin
        if (!Auth::user()->hasRole('super-admin') && $department->office_id != Auth::user()->office_id) {
            return redirect()->back()->with('error', 'तपाईंसँग यो विभाग अपडेट गर्ने अनुमति छैन।'); // You do not have permission to update this department.
        }

        // Validation rules matching your *existing* table columns: 'name' and 'description'
        $validatedData = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'name' => 'required|string|max:255',               // Validation key is 'name'
            'description' => 'nullable|string',                 // Validation key is 'description'
            'type' => 'required|in:employee,representative,both', // New 'type' validation
        ]);

        try {
            $department->update([
                'office_id' => $validatedData['office_id'],
                'name' => $validatedData['name'],           // Assign to 'name' column
                'description' => $validatedData['description'], // Assign to 'description' column
                'type' => $validatedData['type'],           // Assign to 'type' column
            ]);

            return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक अद्यावधिक गरियो।'); // Department updated successfully.
        } catch (\Exception $e) {
            Log::error('Error updating department: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'विभाग अद्यावधिक गर्दा त्रुटि भयो: ' . $e->getMessage()); // Error updating department.
        }
    }

    public function destroy(Department $department)
    {
        // Ensure user can only delete departments within their office, unless super-admin
        if (!Auth::user()->hasRole('super-admin') && $department->office_id != Auth::user()->office_id) {
            return redirect()->back()->with('error', 'तपाईंसँग यो विभाग मेटाउने अनुमति छैन।'); // You do not have permission to delete this department.
        }

        try {
            $department->delete();
            return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक हटाइयो।'); // Department successfully deleted.
        } catch (\Exception $e) {
            Log::error('Error deleting department: ' . $e->getMessage());
            return back()->with('error', 'हटाउँदा समस्या आयो: ' . $e->getMessage()); // Problem deleting.
        }
    }
}
