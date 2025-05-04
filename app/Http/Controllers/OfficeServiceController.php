<?php

namespace App\Http\Controllers;

use App\Models\OfficeService;
use Illuminate\Http\Request;

class OfficeServiceController extends Controller
{
    public function create(){
        return view('office_service.create');
    }

    public function show(){
       
        return view('office_service.index');
       
    }

    

}
