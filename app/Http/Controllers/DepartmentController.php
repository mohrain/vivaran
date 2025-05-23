<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function create()
    {

        if (Auth::user()->hasRole('super-admin')) {
            $offices = Office::all();
        } else {

            $offices = Office::where('id', Auth::user()->office_id)->get();
        }
        return view('department.create', compact('offices'));
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:employee,representative,both',
        ]);

        try {

            if (!Auth::user()->hasRole('super-admin') && $validatedData['office_id'] != Auth::user()->office_id) {
                return redirect()->back()->withInput()->with('error', 'तपाईंले आफ्नो कार्यालयमा मात्र विभाग थप्न सक्नुहुन्छ।');
            }

            Department::create([
                'office_id' => $validatedData['office_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'type' => $validatedData['type'],
            ]);


            return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक थपियो।');
        } catch (\Exception $e) {
            Log::error('Error adding department: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'केही समस्या आयो। कृपया पुनः प्रयास गर्नुहोस्।');
        }
    }

    public function index()
    {

        if (Auth::user()->hasRole('super-admin')) {
            $departments = Department::with('office')->oldest()->paginate(7);
        } else {
            $departments = Department::with('office')->where('office_id', Auth::user()->office_id)->oldest()->paginate(7);
        }
        return view('department.index', compact('departments'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);


        if (!Auth::user()->hasRole('super-admin') && $department->office_id != Auth::user()->office_id) {
            abort(403, 'Unauthorized action.');
        }


        if (Auth::user()->hasRole('super-admin')) {
            $offices = Office::all();
        } else {
            $offices = Office::where('id', Auth::user()->office_id)->get();
        }

        return view('department.create', compact('department', 'offices'));
    }

    public function update(Request $request, Department $department)
    {

        if (!Auth::user()->hasRole('super-admin') && $department->office_id != Auth::user()->office_id) {
            return redirect()->back()->with('error', 'तपाईंसँग यो विभाग अपडेट गर्ने अनुमति छैन।');
        }


        $validatedData = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:employee,representative,both',
        ]);

        try {
            $department->update([
                'office_id' => $validatedData['office_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'type' => $validatedData['type'],
            ]);

            return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक अद्यावधिक गरियो।');
        } catch (\Exception $e) {
            Log::error('Error updating department: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'विभाग अद्यावधिक गर्दा त्रुटि भयो: ' . $e->getMessage());
        }
    }

    public function destroy(Department $department)
    {

        if (!Auth::user()->hasRole('super-admin') && $department->office_id != Auth::user()->office_id) {
            return redirect()->back()->with('error', 'तपाईंसँग यो विभाग मेटाउने अनुमति छैन।');
        }

        try {
            $department->delete();
            return redirect()->route('department.index')->with('success', 'विभाग सफलतापूर्वक हटाइयो।');
        } catch (\Exception $e) {
            Log::error('Error deleting department: ' . $e->getMessage());
            return back()->with('error', 'हटाउँदा समस्या आयो: ' . $e->getMessage());
        }
    }
}
