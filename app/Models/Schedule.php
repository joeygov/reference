<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'account_id',
        'is_all',
        'is_flex',
        'shift_starts',
        'shift_ends',
        'start_date',
    ];
}
