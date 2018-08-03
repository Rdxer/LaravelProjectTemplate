<?php

namespace App;

use App\Model\Profile;
use App\Tra\UserLetterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 * @version July 5, 2018, 1:27 pm CST
 *
 * @property string name
 * @property string phone
 * @property string email
 * @property string password
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable,HasRoles,UserLetterTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];


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


    public function roleDesc(){
        return $this->getRoleNames()->implode(",");
    }


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:1|unique:users',
        'phone' => 'nullable|size:11|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'nullable|min:6'
    ];
}
