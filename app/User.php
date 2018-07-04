<?php

namespace App;

use App\Model\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public $appends = ['profile'];


    public function getProfileAttribute()
    {
        return $this->profile();
    }

    /**
     * @return \App\Model\Profile
     */
    public function profile()
    {

        $prof = $this->hasOne('App\Model\Profile')->first();

        if ($prof == null){
            $prof = new Profile;

            $prof->user_id = $this->id;
            $prof->name = $this->name;
            $prof->email = $this->email;
            $prof->save();
        }

        return $prof;

    }

    /**
     * 自定义用Passport授权登录：用户名+密码
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        $user = self::where('email', $username)->first();

        if ($user == null){
            $user = self::where('phone', $username)->first();
        }

        return $user;
    }

}
