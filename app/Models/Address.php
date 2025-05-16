<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    use HasFactory;
    protected $fillable = [
        'province',
        'district',
        'municipality',
        'type',
        'total_ward_number',
    ];


    public function offices()
    {
        return $this->hasOne(Office::class, 'address_id');
    }
}
