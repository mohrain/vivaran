<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Representative;
use App\Models\PostCategory;
use App\Models\Office;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Don't forget to import Auth

class RepresentativeController extends Controller
{
    public function index(Request $request)
    {
        $departmentId = $request->query('department_id');
        $representativeWard = $request->query('representative_ward');

        $query = Representative::with(['department', 'postcategory', 'updatedBy']);
        $currentDepartmentName = null;
        $currentWard = null;
        if ($departmentId) {
            $query->where('department_id', $departmentId);
            $department = Department::find($departmentId);
            if ($department) {
                $currentDepartmentName = $department->name;
            }
        }

        if ($representativeWard) {
            $query->where('representative_ward', $representativeWard);
            $currentWard = $representativeWard;
        }

        $representatives = $query->oldest()->paginate(6);


        return view('representatives.index', compact('representatives', 'currentDepartmentName', 'currentWard'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'representative_name' => 'required|string|max:255',
            'representative_ward' => 'required|string|max:255',
            'representative_phone' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'post_category_id' => 'required|integer|exists:post_categories,id',
            'representative_email' => 'nullable|email|max:255',
            'representative_address' => 'nullable|string|max:255',
            'representative_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

        try {
            $path = null; // Initialize path as null

            if ($request->hasFile('representative_image')) {
                $path = $request->file('representative_image')->store('representatives', 'public');
            }

            Representative::create([
                'representative_name' => $request->representative_name,
                'representative_ward' => $request->representative_ward,
                'representative_phone' => $request->representative_phone,
                'department_id' => $request->department_id,
                'post_category_id' => $request->post_category_id,
                'representative_email' => $request->representative_email,
                'representative_address' => $request->representative_address,
                'representative_image' => $path,
                'remark' => $request->remark,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->route('representatives.index')->with('success', 'प्रतिनिधि सफलतापूर्वक सिर्जना गरियो!'); // Updated message
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'प्रतिनिधि सिर्जना गर्दा त्रुटि: ' . $e->getMessage()); // Updated message
        }
    }

    public function destroy($id)
    {
        $representative = Representative::findOrFail($id);


        if ($representative->representative_image) {
            Storage::disk('public')->delete($representative->representative_image);
        }

        $representative->delete();

        return redirect()->route('representatives.index')->with('success', 'प्रतिनिधि सफलतापूर्वक मेटाइयो!'); // Updated message
    }


    public function edit($id)
    {
        $departments = Department::where('type', 'representative')
            ->orWhere('type', 'both')
            ->orderBy('name')
            ->get();
        $post_categories = PostCategory::all();
        $representative = Representative::findOrFail($id);
        // $departments = Department::all();
        $offices = Office::all();
        return view('representatives.create_representatives', compact('post_categories', 'representative', 'offices', 'departments'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'representative_name' => 'required|string|max:255',
            'representative_ward' => 'required|string|max:255',
            'representative_phone' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'post_category_id' => 'required|integer|exists:post_categories,id',
            'representative_email' => 'nullable|email|max:255',
            'representative_address' => 'nullable|string|max:255',
            'representative_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

        $representative = Representative::findOrFail($id);

        try {
            $path = $representative->representative_image;

            if ($request->hasFile('representative_image')) {
                // Delete old image if it exists
                if ($representative->representative_image) {
                    Storage::disk('public')->delete($representative->representative_image);
                }
                $path = $request->file('representative_image')->store('representatives', 'public');
            }

            $representative->update([
                'representative_name' => $request->representative_name,
                'representative_ward' => $request->representative_ward,
                'representative_phone' => $request->representative_phone,
                'department_id' => $request->department_id,
                'post_category_id' => $request->post_category_id,
                'representative_email' => $request->representative_email,
                'representative_address' => $request->representative_address,
                'representative_image' => $path,
                'remark' => $request->remark,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->route('representatives.index')->with('success', 'प्रतिनिधि सफलतापूर्वक अपडेट गरियो।');
        } catch (\Exception $e) {
            return back()->with('error', 'केही समस्या आयो: ' . $e->getMessage());
        }
    }

    public function show()

    {
        $departments = Department::where('type', 'representative')
            ->orWhere('type', 'both')
            ->orderBy('name')
            ->get();
        // $departments = Department::all();
        $post_categories = PostCategory::all();
        return view('representatives.create_representatives', compact('departments', 'post_categories'));
    }
}
