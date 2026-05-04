<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}