<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseController;
use App\Model\Profile;
use App\Tools\Tools;
use App\User;
use Dingo\Api\Auth\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
//        return User::paginate(20);
        return $this->show($this->auth_user()->id);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $prof = $user->profile();

        if ($prof == null){
            $prof = new Profile;

            $prof->user_id = $user->id;
            $prof->name = $user->name;
            $prof->email = $user->email;
            $prof->save();
        }

        $user->profile = $prof;

        if ($this->auth_user() != null && $this->auth_user()->id == $user->id){

        }else{
            $user->email = Tools::maskCode($user->email);
            $user->phone = Tools::maskCode($user->phone);
            $user->profile->phone = Tools::maskCode($user->profile->phone);
        }

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
//        dd($data);
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->response->errorBadRequest();
        }

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);

        $prof = new Profile;

        $prof->user_id = $user->id;
        $prof->name = $user->name;
        $prof->contact = $user->phone;

        $prof->saveOrFail();

        $user->profile = $user->profile();

        return $this->response->created(null,$user);
    }
}
