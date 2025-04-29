<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Representative;
use App\Models\PostCategory;

class RepresentativeController extends Controller
{
    public function index()
    {
        $representatives = Representative::with('postcategory')->latest()->get();
        return view('representatives.index', compact('representatives'));
    }
    public function create()
    {
        $post_categories = PostCategory::all(); // Fetch all post categories
        return view('representatives.create_representatives', compact('post_categories'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'representative_name' => 'required|string|max:255',
            'post_category_id' => 'required|integer|exists:post_categories,id',
            'representative_phone' => 'required|string|max:10',
            'remark' => 'nullable|string|max:500',
        ]);
    
        try {
            Representative::create([
                'representative_name' => $request->representative_name,
                'post_category_id' => $request->post_category_id,
                'representative_phone' => $request->representative_phone,
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

    return view('representatives.create_representatives', compact('post_categories', 'representative'));
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
