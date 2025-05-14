<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\OfficeCategory;
use Illuminate\Support\Facades\Storage;
use App\Models\PostCategory;
use App\Models\Representative;
use App\Models\Address;


class OfficeController extends Controller
{

    public function index()
    {
        // Fetch all categories from the OfficeCategory model
        $categories = OfficeCategory::all();
        $provinces = Address::select('province')->distinct()->get();

        // Pass categories to the view
        return view('office.index', compact('categories','provinces'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validated =  $request->validate([
            'office_name' => 'required|string|max:255',
            'office_email' => 'required|email|max:255',
            'office_category_id' => 'required|exists:office_categories,id',
            'office_phone' => 'required|string|max:10',
            'office_type' => 'nullable|string|max:255',
            'office_address' => 'required|string|max:255',
            'office_code' => 'nullable|string',
            'office_logo' => 'nullable',
            'office_description' => 'nullable|string',
            'address_id' => 'required|exists:addresses,id',
        ]);


        if ($request->file('office_logo')) {

            // $path = Storage::putFile('logo', $request->file('office_logo'));
            $path = $request->file('office_logo')->store('logo', 'public');
        }


        try {
            $office  =  Office::create([
                'office_name' => $request->office_name,
                'office_email' => $request->office_email,
                'office_category_id' => $request->office_category_id,
                'office_phone' => $request->office_phone,
                'office_address' => $request->office_address,
                'office_code' => $request->office_code,
                'office_logo' => $path,
                'office_description' => $request->office_description,
                'address_id' => $request->address_id,

            ]);

            // return $office;

            return redirect()->route('office.index')->with('success', 'कार्यालयको विवरण सफलतापूर्वक समावेश गरियो। (Office details saved successfully.)');
        } catch (\Exception $e) {
            // return redirect()->back()->withInput()->with('error', 'केही समस्या आयो। कृपया पुनः प्रयास गर्नुहोस्। (Something went wrong. Please try again.)');
            echo $e->getMessage();
        }
    }

    public function list()
    {
        $offices = Office::paginate(10);
        return view('office.ui.office_list', [
            'offices' => $offices,
        ]);
    }



    // ---------------------------------Edit Office-----------------------------------

    public function edit($id)
    {
        $categories = OfficeCategory::all(); // Get categories for select input
        $office = Office::findOrFail($id); // Find the office by ID
        $provinces = Address::select('province')->distinct()->get();

        return view('office.index', compact('categories', 'office'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'office_name' => 'required|string|max:255',
            'office_email' => 'required|email|max:255',
            'office_category_id' => 'required|exists:office_categories,id',
            'office_phone' => 'required|string|max:10',
            'office_address' => 'required|string|max:255',
            'office_code' => 'nullable|string',
            'office_logo' => 'nullable|image',
            'office_description' => 'nullable|string',
            'address_id' => 'required|exists:addresses,id',
        ]);

            $office = Office::findOrFail($id);

            if ($request->hasFile('office_logo')) {
                // Delete old logo if exists
                if ($office->office_logo) {
                    Storage::delete($office->office_logo);
                }
                // Upload new logo
                $path = $request->file('office_logo')->store('logo', 'public');
                $office->office_logo = $path;
            }
            try {
            $office->update([
                'office_name' => $request->office_name,
                'office_email' => $request->office_email,
                'office_category_id' => $request->office_category_id,
                'office_phone' => $request->office_phone,
                'office_address' => $request->office_address,
                'office_code' => $request->office_code,
                'office_description' => $request->office_description,
            ]);

            return redirect()->route('office.ui.office_list')->with('success', 'Office updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    // ---------------------------------Delete Office-----------------------------------
    public function destroy($id)
{
    $office = Office::findOrFail($id);

    // If there is an office logo, delete it too
    if ($office->office_logo) {
        Storage::disk('public')->delete($office->office_logo);
    }

    $office->delete();

    return redirect()->route('office.ui.office_list')->with('success', 'Office deleted successfully!');
}


public function show($id)
{
    $office = Office::with(['representatives.postcategory'])->findOrFail($id);
    return view('representatives.index', [
        'representatives' => $office->representatives,
        'office' => $office,
        'postcategories' => PostCategory::all(),
        'office_id' => $id,
        'representative' => Representative::all(),
        'office_category' => OfficeCategory::all(),
        'office_name' => $office->office_name,
        'office_email' => $office->office_email,
        'office_phone' => $office->office_phone,
        'office_address' => $office->office_address,
        'office_code' => $office->office_code,
        'office_description' => $office->office_description,
        'office_logo' => $office->office_logo,
        'office_category_id' => $office->office_category_id,
    ]);
}
public function create()
{
    $categories = OfficeCategory::all();
    $provinces = Address::select('province')->distinct()->get();
    return view('office.index', compact('categories', 'provinces'));
}
}