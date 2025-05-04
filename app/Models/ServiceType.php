<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceType extends Model
{
    use HasFactory;

    protected $table = 'service_types';

    protected $fillable = [
        'name',  
        'description'      
    ]; 
}