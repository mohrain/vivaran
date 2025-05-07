<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PostEmployee;
use App\Models\Department;
use App\Models\User;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;




class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'post_employee_id',
        'employee_name',
        'employee_phone',
        'employee_email',
        'employee_address',
        'employee_image',
        'remark',
        'updated_by',
        'employee_id',
    ];

    public function postemployee()
    {
        return $this->belongsTo(PostEmployee::class, 'post_employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
