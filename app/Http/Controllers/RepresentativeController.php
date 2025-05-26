<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Representative;
use App\Models\PostCategory;
use App\Models\Office;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Import DB for raw queries if needed

class RepresentativeController extends Controller
{

    // public function index(Request $request)
    // {
    //     $departmentId = $request->query('department_id');
    //     $search = $request->query('search');
    //     $representativeWard = $request->query('representative_ward');

    //     $query = Representative::with(['department', 'postcategory', 'updatedBy']);
    //     $currentDepartmentName = null;
    //     $currentWard = null;
    //     if ($departmentId) {
    //         $query->where('department_id', $departmentId);
    //         $department = Department::find($departmentId);
    //         if ($department) {
    //             $currentDepartmentName = $department->name;
    //         }
    //     }

    //     if ($search) {
    //         $query->where(function($q) use ($search) {
    //             $q->where('representative_name', 'like', '%' . $search . '%')
    //               ->orWhere('representative_phone', 'like', '%' . $search . '%')
    //               ->orWhere('representative_email', 'like', '%' . $search . '%')
    //               ->orWhere('representative_address', 'like', '%' . $search . '%')
    //               ->orWhere('representative_ward', 'like', '%' . $search . '%')
    //               ->orWhere('remark', 'like', '%' . $search . '%');


    //             $q->orWhereHas('department', function ($dq) use ($search) {
    //                 $dq->where('name', 'like', '%' . $search . '%');
    //             });


    //             $q->orWhereHas('postcategory', function ($pq) use ($search) {
    //                 $pq->where('post_category', 'like', '%' . $search . '%');
    //             });
    //         });


    //     }


    //     $representatives = $query->oldest()->paginate(6);


    //     return view('representatives.index', compact('representatives', 'currentDepartmentName', 'currentWard'));
    // }


    public function index(Request $request)
    {
        $query = Representative::with(['department', 'postcategory', 'updatedBy']);

        // Basic search filter (if present)
        $search = $request->input('search');
        if ($search) {
            $searchTerm = '%' . $search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('representative_name', 'like', $searchTerm)
                    ->orWhere('representative_phone', 'like', $searchTerm)
                    ->orWhere('representative_email', 'like', $searchTerm)
                    ->orWhere('representative_address', 'like', $searchTerm)
                    ->orWhere('representative_ward', 'like', $searchTerm)
                    ->orWhere('remark', 'like', $searchTerm)
                    ->orWhereHas('department', function ($dq) use ($searchTerm) {
                        $dq->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('postcategory', function ($pq) use ($searchTerm) {
                        $pq->where('post_category', 'like', $searchTerm);
                    });
            });
        }


        if ($request->filled('representative_name')) {
            $query->where('representative_name', 'like', '%' . $request->input('representative_name') . '%');
        }
        if ($request->filled('representative_ward')) {
            $query->where('representative_ward', 'like', '%' . $request->input('representative_ward') . '%');
        }
        if ($request->filled('representative_phone')) {
            $query->where('representative_phone', 'like', '%' . $request->input('representative_phone') . '%');
        }
        if ($request->filled('representative_email')) {
            $query->where('representative_email', 'like', '%' . $request->input('representative_email') . '%');
        }
        if ($request->filled('representative_address')) {
            $query->where('representative_address', 'like', '%' . $request->input('representative_address') . '%');
        }
        if ($request->filled('remark')) {
            $query->where('remark', 'like', '%' . $request->input('remark') . '%');
        }
        if ($request->filled('post_category_id')) {
            $query->where('post_category_id', $request->input('post_category_id'));
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }


        if ($request->filled('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }

        $showAdvancedFilters = $request->filled('representative_name') ||
            $request->filled('representative_ward') ||
            $request->filled('representative_phone') ||
            $request->filled('representative_email') ||
            $request->filled('representative_address') ||
            $request->filled('remark') ||
            $request->filled('post_category_id') ||
            $request->filled('department_id');


        $representatives = $query->oldest()->paginate(6);

        // Fetch options for dropdowns

        $departments = Department::where('type', 'representative')
            ->orWhere('type', 'both')
            ->orderBy('name')
            ->get();
        // $departments = Department::orderBy('name')->get();
        $postCategories = PostCategory::orderBy('post_category')->get();



        return view('representatives.index', compact(
            'representatives',
            'departments',
            'postCategories',

            'showAdvancedFilters'
        ));
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
