<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ServiceTypeController extends Controller
{

    public function index()
    {
        // $serviceTypes = ServiceType::all();
        if (Auth::user()->hasrole('super-admin')) {
            $serviceTypes = ServiceType::all();
        } else {
            $serviceTypes = ServiceType::where('id', Auth::user()->service_type_id)->get();
        }


        return view('office_service.service_type', compact('serviceTypes'));
    }

    public function officetype()
    {
        // $serviceTypes = ServiceType::all();
        if (Auth::user()->hasrole('super-admin')) {
            $serviceTypes = ServiceType::all();
        } else {
            $serviceTypes = ServiceType::where('id', Auth::user()->service_type_id)->get();
        }
        $editServiceType = null; // Initialize edit variable

        // Check if we're editing (from edit link)
        if (request()->has('edit')) {
            $editServiceType = ServiceType::find(request('edit'));
        }

        return view('office_service.service_type', compact('serviceTypes', 'editServiceType'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'service_description' => 'nullable|string|max:255',
        ]);

        try {
            ServiceType::create([
                'name' => $request->service_name,
                'description' => $request->service_description,
            ]);

            return redirect()->route('office_service.office_type.index')
                ->with('success', 'Service type created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating service type: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'service_description' => 'nullable|string|max:255',
        ]);

        try {
            $serviceType = ServiceType::findOrFail($id);
            $serviceType->update([
                'name' => $request->service_name,
                'description' => $request->service_description,
            ]);

            return redirect()->route('office_service.office_type.index')
                ->with('success', 'Service type updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating service type: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $serviceType = ServiceType::findOrFail($id);
            $serviceType->delete();

            return redirect()->route('office_service.office_type.index')
                ->with('success', 'Service type deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting service type: ' . $e->getMessage());
        }
    }
}
