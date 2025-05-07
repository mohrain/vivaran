<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;


class PostEmployee extends Model
{
    protected $table = 'post_employees';

    use HasFactory;

    protected $fillable = [
        'department_id',
        'post_employee',
        'employee_status',
    ];


    public function employees()
    {
        return $this->hasMany(Employee::class, 'post_employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
