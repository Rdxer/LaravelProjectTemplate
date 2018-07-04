<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';
    const GENDER_UNDEFINED = 'UNDEFINED';

    public static $paymentStatusMap = [
        self::GENDER_UNDEFINED => '未知',
        self::GENDER_MALE => '男',
        self::GENDER_FEMALE => '女',
    ];

    protected $fillable = [
        'name',
        'nickname',
        'contact',
        'gender',
        'email',
        'address',
        'avatar',
        'marker'
    ];
}
