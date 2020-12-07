<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'time_in',
        'time_out',
        'break1_start',
        'break1_end',
        'break2_start',
        'break2_end',
        'break3_start',
        'break3_end',
        'break4_start',
        'break4_end',
        'status',
        'time_in_image',
        'time_out_image',
        'updated_by',
    ];
}
