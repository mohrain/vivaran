<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representative extends Model
{
    use HasFactory;

    protected $table = 'representatives';

    protected $fillable = [
        'department_id', 
        'post_category_id',
        'representative_name',
        'representative_ward',
        'representative_phone',
        'representative_email',
        'representative_address',
        'representative_image',
        'remark',
        'updated_by',
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