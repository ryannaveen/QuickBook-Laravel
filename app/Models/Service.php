<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Favourite;

class Service extends Model
{
    protected $fillable = [
        'owner_id',
        'service_name',
        'description',
        'price'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
}