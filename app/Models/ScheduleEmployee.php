<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleEmployee extends Model
{
    protected $fillable = [
        'schedule_id',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo('\App\Models\Employee');
    }
}
