<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class Employee extends User
{
    const ROLE = [
        1 => 'USER',
        2 => 'WFM',
        3 => 'ADMIN',
        4 => 'REPORT_MANAGER',
    ];

    protected $fillable = [
        'emp_id',
        'user_role',
        'email',
        'password',
        'remember_token',
        'user_status',
        'is_wfh',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'civil_status',
        'address',
        'contact_num',
        'account_id',
        'emp_status',
        'is_flex',
        'shift_starts',
        'shift_ends',
        'hdmf_num',
        'emp_image',
        'fingerprint',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
