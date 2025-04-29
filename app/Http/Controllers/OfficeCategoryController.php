<?php

namespace App\Http\Controllers;

use App\Models\OfficeCategory;

use Illuminate\Http\Request;


class OfficeCategoryController extends Controller
{
    
    public function store(Request $request)
    {
        $validated =  $request->validate([

            'office_type' => 'required|string|max:255',
            'office_status' => 'nullable|string|max:255',
        ]);


        try {
            $office  =  OfficeCategory::create([
                'office_type' => $request->office_type,
                'office_status' => $request->office_status,
            ]);

            // return $office;

            return redirect()->route('office.office_type')->with('success', 'कार्यालयको विवरण सफलतापूर्वक समावेश गरियो। (Office details saved successfully.)');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'केही समस्या आयो। कृपया पुनः प्रयास गर्नुहोस्। (Something went wrong. Please try again.)');
        }
    }

 // Show the OfficeCategory 
    public function show()
    {
        $office_categories = OfficeCategory::get(); // Get all categories ordered by latest first
        return view('office.office_type', compact('office_categories'));
    }


    // Edit method
public function edit($id)
{
    $category = OfficeCategory::findOrFail($id);
    $office_categories = OfficeCategory::latest()->get();
    return view('office.office_type', compact('category', 'office_categories'));
}

// Update method
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'office_type' => 'required|string|max:255',
        'office_status' => 'nullable|string|max:255',
    ]);

    try {
        $category = OfficeCategory::findOrFail($id);
        $category->update([
            'office_type' => $request->office_type,
            'office_status' => $request->office_status,
        ]);

        return redirect()->route('office.office_type')->with('success', 'Category updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error updating category');
    }
}


public function destroy($id)
{
    try {
        $officecategory = OfficeCategory::findOrFail($id);
        $officecategory->delete();

        return redirect()->route('office.office_type')->with('success', 'कार्यालय प्रकार सफलतापूर्वक मेटाइयो। (Office Type deleted successfully.)');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'मेटाउने क्रममा त्रुटि भयो। (Error deleting Office Type.)');
    }
}

   

}
