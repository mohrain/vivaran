<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Address;

class AddressController extends Controller
{
    // Show the form with provinces
    public function create()
    {
        $provinces = Address::all();
        return view('office.create', compact('provinces'));
    }

    // AJAX: Get districts by province_id
    public function getDistricts($province_id)
    {
        $districts = Address::where('province_id', $province_id)->get();
        return response()->json($districts);
    }

    // AJAX: Get municipalities by district_id
    public function getMunicipalities($district_id)
    {
        $municipalities = Address::where('district_id', $district_id)->get();
        return response()->json($municipalities);
    }
}