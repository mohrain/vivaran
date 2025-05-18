<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
{
    $userCount = \App\Models\User::count();
    $officeCount = \App\Models\Office::count();
    $departmentCount = \App\Models\Department::count();
    $employeeCount = \App\Models\Employee::count();
    $employee_serviceCount = \App\Models\OfficeService::count();

    return view('dashboard', compact('userCount', 'officeCount', 'departmentCount', 'employeeCount', 'employee_serviceCount'));
}
}
