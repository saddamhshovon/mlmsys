<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Fund extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'user_name', 'user_name');
    }
}
