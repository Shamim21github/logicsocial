<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Laravel\Socialite\Contracts\Factory as Socialite;

class LinkedinController extends Controller
{

    protected $socialite;

    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    function provider(){
        return $this->socialite->driver('linkedin')->redirect();
    //    return "Hello";
    //    die();
    }

    function providercallback(){
        $user = $this->socialite->driver('linkedin')->user();
        var_dump($user);
    }
}