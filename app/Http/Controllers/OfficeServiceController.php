<?php

namespace App\Http\Controllers;

use App\Models\OfficeService;
use Illuminate\Http\Request;

class OfficeServiceController extends Controller
{
    public function create(){
    $offices = \App\Models\Office::all();
    $ServiceTypes = \App\Models\ServiceType::all();
    return view('office_service.create', compact('offices', 'ServiceTypes'));
    }

    public function show(){
            $officeServices = \App\Models\OfficeService::with(['office', 'serviceType'])->get();
    return view('office_service.index', compact('officeServices'));

        // return view('office_service.index');

    }
    public function store(Request $request)
    {
        $request->validate([
            'office_id' => 'required|exists:offices,id',
            'service_id' => 'required|exists:services,id',
        ]);

        OfficeService::create($request->all());

        return redirect()->route('office_service.index')->with('success', 'Office service created successfully.');
    }



}
