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
        // $provinces = Address::all();
        $provinces = Address::select('province')->distinct()->get();
        return view('office.create', compact('provinces'));
    }

    public function apply()
    {
        $provinces = Address::select('province')->distinct()->get();
    }
    public function getDistrict($province){
        $districts = Address::where('province',$province)->select('district')->distinct()->get();
        return response()->json($districts);
    }

    public function getMunicipality($districtId){
        $municipalities = Address::where('district',$districtId)->select('id','municipality')->distinct()->get();
        return response()->json($municipalities);
    }
}