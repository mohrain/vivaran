<?php

namespace App\Http\Controllers;

use App\Models\OfficeService;
use Illuminate\Http\Request;

class OfficeServiceController extends Controller
{
    public function create(){
        $offices = \App\Models\Office::all();
        return view('office_service.create', compact('offices'));
    }

    public function show(){

        return view('office_service.index');

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
