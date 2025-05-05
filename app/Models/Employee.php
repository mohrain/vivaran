<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'post_category_id',
        'employee_name',
        'employee_phone',
        'employee_email',
        'employee_address',
        'employee_image',
        'remark',
        'updated_by',
        'employee_id',
    ];

    public function postcategory()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
