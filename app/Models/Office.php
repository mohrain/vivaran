<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';

    protected $fillable = [
        'office_name',
        'office_email',
        'office_phone',
        'office_address',
        'office_code',
        'office_logo',
        'office_description',
        'office_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(OfficeCategory::class, 'office_category_id');
    }

    // public function postCategories()
    // {
    //     return $this->hasMany(PostCategory::class, 'office_id');
    // }

    public function representatives()
{
    return $this->hasMany(Representative::class, 'office_id');
}
}
