<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;

use Illuminate\Http\Request;


class PostCategoryController extends Controller
{
    public function store(Request $request)
    {
        
        $validated =  $request->validate([

            'post_category' => 'required|string|max:255',
            'representative_status' => 'nullable|string|max:255',
        ]);


        try {
            $office  = PostCategory::create([
                'post_category' => $request->post_category,
                'representative_status' => $request->representative_status,
            ]);
            return redirect()->route('representatives.post_category')->with('success', 'कार्यालयको विवरण सफलतापूर्वक समावेश गरियो। (Office details saved successfully.)');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'केही समस्या आयो। कृपया पुनः प्रयास गर्नुहोस्। (Something went wrong. Please try again.)');
        }
    }

    public function show()
    {
        $post_categories = PostCategory::get(); // Get all categories ordered by latest first
        return view('representatives.post_category', compact('post_categories'));
    }


    // Edit method
    public function edit($id)
    {

        $category = PostCategory::findOrFail($id);
        $post_categories = PostCategory::latest()->get();

        return view('representatives.post_category', compact('category', 'post_categories'));
    
    }
    

// Update method
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'post_category' => 'required|string|max:255',
        'representative_status' => 'nullable|string|max:255',
    ]);

    try {
        $category = PostCategory::findOrFail($id);
        $category->update([
            'post_category' => $request->post_category,
            'representative_status' => $request->representative_status,
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

        return redirect()->route('representative.post_category')->with('success', 'कार्यालय प्रकार सफलतापूर्वक मेटाइयो। (Office Type deleted successfully.)');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'मेटाउने क्रममा त्रुटि भयो। (Error deleting Office Type.)');
    }
}

   

}
