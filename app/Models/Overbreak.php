<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Overbreak extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'overbreak_date',
        'break1',
        'break2',
        'break3',
        'break4',
        'created_by',
        'updated_by',
    ];

    public function setBreak1Attribute($time)
    {
        $this->attributes['break1'] = $time ? date("h:i:s", strtotime( $time )) : null;
    }

    public function setBreak2Attribute($time)
    {
        $this->attributes['break2'] = $time ? date("h:i:s", strtotime( $time )) : null;
    }

    public function setBreak3Attribute($time)
    {
        $this->attributes['break3'] = $time ? date("h:i:s", strtotime( $time )) : null;
    }

    public function setBreak4Attribute($time)
    {
        $this->attributes['break4'] = $time ? date("h:i:s", strtotime( $time )) : null;
    }

    public function employee()
    {
        return $this->belongsTo('\App\Models\Employee');
    }
}
