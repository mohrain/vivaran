<?php

namespace App\Http\Controllers;

use App\Models\Department;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
{
    $user= auth()->user();

    $userCount = \App\Models\User::count();
    $officeCount = \App\Models\Office::count();
    $departmentCount = \App\Models\Department::count();
    $employeeCount = \App\Models\Employee::count();
    $employee_serviceCount = \App\Models\OfficeService::count();
    $representativeCount = \App\Models\Representative::count();


    $officeName = $user->office->office_name ?? 'N/A';
    $officeUserCount = \App\Models\User::where('office_id', $user->office_id)->count();
    $officeDepartmentCount = \App\Models\Department::where('office_id', $user->office_id)->count();
    // $officeEmployeeCount = \App\Models\Employee::where('office_id', $user->office_id)->count();
    $officeServiceCount = \App\Models\OfficeService::where('office_id', $user->office_id)->count();
    $officeRepresentativeCount = \App\Models\Representative::where('office_id', $user->office_id)->count();

    return view('dashboard', compact(
        'userCount',
        'officeCount',
        'departmentCount',
        'employeeCount',
        'employee_serviceCount',
        'representativeCount',
        'officeName',
        'officeUserCount',
        'officeDepartmentCount',

        'officeServiceCount',
        'officeRepresentativeCount'
    ));


    // return view('dashboard', compact('userCount', 'officeCount', 'departmentCount', 'employeeCount', 'employee_serviceCount', 'representativeCount'));
}
}
