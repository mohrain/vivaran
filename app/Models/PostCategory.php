<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';

    protected $fillable = [
        'department_id',
        'post_category',
        'representative_status',
    ];

    public function representatives()
    {
        return $this->hasMany(Representative::class, 'post_category_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
