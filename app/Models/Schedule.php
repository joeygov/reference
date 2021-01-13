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

    protected $appends = [
        'is_flexs'
    ];

    public function setShiftStartsAttribute($time)
    {
        $this->attributes['shift_starts'] = $time ? date("h:i", strtotime( $time )) : null;
    }

    public function setShiftEndsAttribute($time)
    {
        $this->attributes['shift_ends'] = $time ? date("h:i", strtotime( $time )) : null;
    }

    public function schedule_employee()
    {
        return $this->hasMany('\App\Models\ScheduleEmployee');
    }

    public function getIsFlexsAttribute()
    {
        if ($this->is_flex == 1) {
            return 'Flex';
        }else {
            return 'Fix';
        }
    }
}
