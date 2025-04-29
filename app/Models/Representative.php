<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representative extends Model
{
    use HasFactory;

    protected $table = 'representatives';

    protected $fillable = [
        'representative_name',
        'representative_post',
        'representative_phone',
        'post_category_id',
        'remark',
    ]; 
    public function postcategory()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
   
}
