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

    const USER_STATUS = [
        'ACTIVE' => 1,
        'LOCK' => 2,
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

    protected $appends = [
        'user_roles',
        'emp_statuses',
        'user_statuses'
    ];

    const STATUS = [
        1 => 'Active',
        2 => 'Block',
    ];

    const TYPE = [
        1 => 'Regular',
        2 => 'Probation',
    ];

    public function getUserRolesAttribute()
    {
        foreach(self::ROLE as $key => $role) {
            if ($this->user_role == $key) {
                return $role;
            }
        }
    }

    public function getEmpStatusesAttribute()
    {
        foreach(self::TYPE as $indx => $user_type) {
            if ($this->emp_status == $indx) {
                return $user_type;
            }
        }
    }

    public function getUserStatusesAttribute()
    {
        foreach (self::STATUS as $key => $status) {
            if ($this->user_status == $key) {
                return $status;
            }
        }
    }


    public function account()
    {
        return $this->belongsTo('\App\Models\Account');
    }

}
