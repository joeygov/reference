<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Models\Overbreak;

class Attendance extends Model
{
    const STATUS = [
        'FLEX' => 1,
        'LATE' => 2,
        'ON_TIME' => 3,
    ];
    protected $dates = [
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
    ];
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

    protected $appends = [
        'statuses',
        'total_over_break',
        'break_total'
    ];

    public function employee()
    {
        return $this->belongsTo('\App\Models\Employee');
    }

    public function getStatusesAttribute()
    {
        foreach(self::STATUS as $key => $status) {
            if ($this->status == $status) {
               return $key;
            }
        }

    }

    public function getBreakTotalAttribute()
    {
        $break1_start = Carbon::parse($this->break1_start)->timestamp;
        $break1_end = Carbon::parse($this->break1_end)->timestamp;

        $break2_start = Carbon::parse($this->break2_start)->timestamp;
        $break2_end = Carbon::parse($this->break2_end)->timestamp;

        $break3_start = Carbon::parse($this->break3_start)->timestamp;
        $break3_end = Carbon::parse($this->break3_end)->timestamp;

        $break4_start = Carbon::parse($this->break4_start)->timestamp;
        $break4_end = Carbon::parse($this->break4_end)->timestamp;

        $different = ($break1_end - $break1_start) + ($break2_end - $break2_start) + ($break3_end - $break3_start) + ($break4_end - $break4_start);

        $different = $this->formatBreak($different);

        return $different;

    }

    public static function formatBreak($second)
    {
        $copy = $second;
        $str = '';
        $hr = 0;
        $min = 0;
        $sec = 0;

        $str = '';
        $hr = floor($copy / 60 / 60);
        $copy -= $hr * 60 * 60;
        $min = floor($copy / 60);
        $copy -= $min * 60;
        $sec = $copy;

        $hr = str_pad($hr, 2, '0', STR_PAD_LEFT);
        $min = str_pad($min, 2, '0', STR_PAD_LEFT);
        $sec = str_pad($sec, 2, '0', STR_PAD_LEFT);

        $str = $hr . ':' . $min . ':' . $sec;

        return $str;
    }

    // public function getTotalOverBreakAttribute()
    // {
    //     $overbreak = Overbreak::getOverBreakDate($this->employee_id, $this->time_in);

    //     $total = '';
    //     foreach ($overbreak as $value) {
    //         $break1 = Carbon::parse($value->break1)->timestamp;
    //         $break2 = Carbon::parse($value->break2)->timestamp;

    //         $break3 = Carbon::parse($value->break3)->timestamp;
    //         $break4 = Carbon::parse($value->break4)->timestamp;

    //         $total = ($break2 - $break1) + ($break4 - $break3);

    //         $total = Attendance::formatBreak($total);
    //     }

    //     return $total;
    // }

    // public function getConnect()
    // {

    // }
}
