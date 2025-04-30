<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Representative;
use App\Models\PostCategory;
use App\Models\Office;
use Illuminate\Support\Facades\Storage;

class RepresentativeController extends Controller
{
    public function index()
    {
        $representatives = Representative::with('postcategory')->latest()->get();
        return view('representatives.index', compact('representatives'));
    }
    public function show()
{
    $post_categories = PostCategory::all();
    $offices = Office::all(); // Get all offices
    return view('representatives.create_representatives', compact('post_categories', 'offices'));
}

    

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'representative_name' => 'required|string|max:255',
            'representative_phone' => 'required|string|max:10',
            'office_id' => 'required|integer|exists:offices,id', 
            'post_category_id' => 'required|integer|exists:post_categories,id',
            'representative_email' => 'nullable|email|max:255',
            'representative_address' => 'nullable|string|max:255',
            'representative_image' => 'nullable|image',
            'remark' => 'nullable|string|max:500',
        ]);

       

    
        try {
            if ($request->file('representative_image')) {
                $path = Storage::putFile('representative_image', $request->file('representative_image'));
                
            }
            Representative::create([
                'representative_name' => $request->representative_name,
                'representative_phone' => $request->representative_phone,
                'office_id' => $request->office_id, 
                'post_category_id' => $request->post_category_id,
                'representative_email' => $request->representative_email,
                'representative_address' => $request->representative_address,
                'representative_image' => $path,
                'remark' => $request->remark,
            ]);
    
            return redirect()->route('representatives.index')->with('success', 'कार्यालयको विवरण सफलतापूर्वक समावेश गरियो। (Office details saved successfully.)');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

public function destroy($id)
{
    $representative = Representative::findOrFail($id);

    $representative->delete();

    return redirect()->route('representatives.index')->with('success', 'Office deleted successfully!');
}


public function edit($id)
{
    $post_categories = PostCategory::all();
    $representative = Representative::findOrFail($id);
    $offices = Office::all(); // Get all offices
    return view('representatives.create_representatives', compact('post_categories', 'representative', 'offices'));
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'representative_name' => 'required|string|max:255',
        'post_category_id' => 'required|exists:post_categories,id',
        'representative_phone' => 'required|string|size:10',
        'remark' => 'nullable|string',
    ]);

    $representative = Representative::findOrFail($id);

    try {
        $representative->update([
            'representative_name' => $request->representative_name,
            'post_category_id' => $request->post_category_id,
            'representative_phone' => $request->representative_phone,
            'remark' => $request->remark,
        ]);

        return redirect()->route('representatives.index')->with('success', 'प्रतिनिधि सफलतापूर्वक अपडेट गरियो।');
    } catch (\Exception $e) {
        return back()->with('error', 'केही समस्या आयो: ' . $e->getMessage());
    }
}


}
