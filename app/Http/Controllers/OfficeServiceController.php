<?php

namespace App\Http\Controllers;

use App\Models\OfficeService;
use Illuminate\Http\Request;

class OfficeServiceController extends Controller
{
    public function create()
    {
        $offices = \App\Models\Office::all();
        $ServiceTypes = \App\Models\ServiceType::all();
        return view('office_service.create', compact('offices', 'ServiceTypes'));
    }

    public function show()
    {
        $user = auth()->user();

        // If super-admin, show all. If admin, show only their office's services.
        if ($user->hasRole('super-admin')) {
            $officeServices = \App\Models\OfficeService::with(['office', 'serviceType'])->get();
        } else {
            $officeServices = \App\Models\OfficeService::with(['office', 'serviceType'])
                ->where('office_id', $user->office_id)
                ->get();
        }

        // $officeServices = OfficeService::with(['office', 'serviceType'])->get();
        return view('office_service.index', compact('officeServices'));

        // return view('office_service.index');

    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'service_type_id' => 'required|exists:service_types,id',
            'office_email' => 'nullable|email',
            'contact' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'remark' => 'nullable|string|max:255',
        ]);
        OfficeService::create($validated);
        return redirect()->route('office_service.index')->with('success', 'Office service created successfully.');


        OfficeService::create($request->all());
        OfficeService::create([
            'office_id' => $request->office_id,
            'service_type_id' => $request->service_type_id,
            'email' => $request->office_email,
            'contact' => $request->contact,
            'status' => $request->status,
            'remark' => $request->remark,
        ]);

        return redirect()->route('office_service.index')->with('success', 'Office service created successfully.');
    }

    public function showSingle($id)
    {
        $officeService = \App\Models\OfficeService::with(['office', 'serviceType'])->findOrFail($id);
        return view('office_service.show', compact('officeService'));
    }

    public function destroy($id)
    {
        $officeServices = OfficeService::findOrFail($id);
        $officeServices->delete();
        return redirect()->route('office_service.index')->with('success', 'Deleted successfully.');
    }
    public function index()
    {

        $officeServices = OfficeService::with(['office', 'serviceType'])->get();
        return view('office_service.index', compact('officeServices'));
    }
    public function edit($id)
    {
        $officeService = OfficeService::findOrFail($id);
        $offices = \App\Models\Office::all();
        $serviceTypes = \App\Models\ServiceType::all();
        return view('office_service.edit', compact('officeService', 'offices', 'serviceTypes'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'service_type_id' => 'required|exists:service_types,id',
            'office_email' => 'nullable|email',
            'contact' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'remark' => 'nullable|string|max:255',
        ]);

        $officeService = OfficeService::findOrFail($id);
        $officeService->update($validated);

        return redirect()->route('office_service.index')->with('success', 'Office service updated successfully.');
    }
}
