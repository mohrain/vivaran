<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeCategory extends Model
{
    protected $table = 'office_categories';

    protected $fillable = [
        'office_type',
        'office_status',
    ];
    public function offices()
    {
        return $this->hasMany(Office::class, 'category_id');
    }
}

