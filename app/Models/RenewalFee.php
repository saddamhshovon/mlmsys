<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalFee extends Model
{
    use HasFactory;

    protected $table = 'renewal_fee';

    protected $guarded = [];
}
