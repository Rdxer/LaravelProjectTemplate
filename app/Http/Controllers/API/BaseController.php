<?php

namespace App\Http\Controllers\API;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    use Helpers;

    /**
     * @return \App\User
     */
    function auth_user()
    {
        return Auth::user();
    }
}
