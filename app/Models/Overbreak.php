<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overbreak extends Model
{
    protected $fillable = [
        'employee_id',
        'break1',
        'break2',
        'break3',
        'break4',
        'created_by',
        'updated_by',
    ];
}
