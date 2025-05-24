<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use App\Models\Department;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());


        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_category' => 'required|string|max:255',
            'representative_status' => 'nullable|string|max:255',
        ]);

        try {
            PostCategory::create([

                'department_id' => $request->department_id,
                'post_category' => $request->post_category,
                'representative_status' => $request->representative_status,
                'office_id' => $request->office_id,
            ]);
            return redirect()->route('representatives.post_category')->with('success', 'Post category saved successfully.');
        } catch (\Exception $e) {
                dd($e->getMessage()); // This will help you know the exact problem.
                return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }
        }


    public function show()
    {

                $departments = Department::where('type', 'representative')
                                ->orWhere('type', 'both') // Include 'both' if departments can apply to both
                                ->orderBy('name')
                                ->get();

        $post_categories = PostCategory::with('department')->get();

        return view('representatives.post_category', compact('post_categories', 'departments'));
    }

    public function edit($id)
    {
                $departments = Department::where('type', 'representative')
                                ->orWhere('type', 'both')
                                ->orderBy('name')
                                ->get();
        $category = PostCategory::findOrFail($id);
        $post_categories = PostCategory::latest()->get();
        // $departments = Department::all();
        return view('representatives.post_category', compact('category', 'post_categories', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'post_category' => 'required|string|max:255',
            'representative_status' => 'nullable|string|max:255',
            'office_id' => 'nullable|exists:offices,id',
        ]);

        try {
            $category = PostCategory::findOrFail($id);
            $category->update([
                'department_id' => $request->department_id,
                'post_category' => $request->post_category,
                'representative_status' => $request->representative_status,
                'office_id' => $request->office_id,
            ]);

            return redirect()->route('representatives.post_category')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating category');
        }
    }

    public function destroy($id)
    {
        try {
            $postcategory = PostCategory::findOrFail($id);
            $postcategory->delete();
            return redirect()->route('representatives.post_category')->with('success', 'Deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting post category.');
        }
    }

    public function getPostCategoriesByDepartmentId($departmentId)
    {
        $postCategories = PostCategory::where('department_id', $departmentId)->get();
        return response()->json($postCategories);
    }
}
