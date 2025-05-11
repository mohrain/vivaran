<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeService extends Model
{

        protected $fillable = [
        'office_id', 'service_type_id', 'email', 'contact', 'status', 'remark'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
}
