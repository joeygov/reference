<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreakButton extends Model
{
    protected $attributes = [
        'break_1_start' => true,
        'break_1_end' => false,
        'break_2_start' => true,
        'break_2_end' => false,
        'break_3_start' => true,
        'break_3_end' => false,
        'break_4_start' => true,
        'break_4_end' => false,
    ];

    public function setB1Start()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => true,
            'break_2_start' => false,
            'break_2_end' => false,
            'break_3_start' => false,
            'break_3_end' => false,
            'break_4_start' => false,
            'break_4_end' => false,
        ];
    }

    public function setB1End()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => true,
            'break_2_end' => false,
            'break_3_start' => true,
            'break_3_end' => false,
            'break_4_start' => true,
            'break_4_end' => false,
        ];
    }

    public function setB2Start()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => false,
            'break_2_end' => true,
            'break_3_start' => false,
            'break_3_end' => false,
            'break_4_start' => false,
            'break_4_end' => false,
        ];
    }

    public function setB2End()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => false,
            'break_2_end' => false,
            'break_3_start' => true,
            'break_3_end' => false,
            'break_4_start' => true,
            'break_4_end' => false,
        ];
    }

    public function setB3Start()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => false,
            'break_2_end' => false,
            'break_3_start' => false,
            'break_3_end' => true,
            'break_4_start' => false,
            'break_4_end' => false,
        ];
    }

    public function setB3End()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => false,
            'break_2_end' => false,
            'break_3_start' => false,
            'break_3_end' => false,
            'break_4_start' => true,
            'break_4_end' => false,
        ];
    }

    public function setB4Start()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => false,
            'break_2_end' => false,
            'break_3_start' => false,
            'break_3_end' => false,
            'break_4_start' => false,
            'break_4_end' => true,
        ];
    }

    public function setB4End()
    {
        return [
            'break_1_start' => false,
            'break_1_end' => false,
            'break_2_start' => false,
            'break_2_end' => false,
            'break_3_start' => false,
            'break_3_end' => false,
            'break_4_start' => false,
            'break_4_end' => false,
        ];
    }
}
