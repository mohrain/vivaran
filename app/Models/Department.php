<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_id',
        'name',
        'description'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function postCategories()
    {
        return $this->hasMany(PostCategory::class, 'department_id');
    }
}