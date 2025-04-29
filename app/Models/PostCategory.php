<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';

    protected $fillable = [
        'post_category',
        'representative_status',
        'office_id',
    ];

    public function postcategory()
    {
        return $this->hasMany(Representative::class, 'post_category_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    
}
