<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representative extends Model
{
    use HasFactory;

    protected $table = 'representatives';

    protected $fillable = [
        'office_id',
        'post_category_id',
        'representative_name',
        'representative_post',
        'representative_phone',
        'representative_email',
        'representative_address',
        'representative_image',
        'remark',
    ]; 
    public function postcategory()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
   
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    
}
