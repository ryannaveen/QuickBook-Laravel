<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Block extends Model
{
    protected $fillable = [
        'owner_id',
        'block_date',
        'start_time',
        'end_time',
        'is_full_day',
        'reason'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}