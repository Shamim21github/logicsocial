<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FacebookUser;


class DashboardController extends Controller
{
    
    public function show()
    {
        $userId = session('sess_user_id'); 
        $user = User::find($userId); 

        $facebookUser = session('facebookUser'); 
        $twitterUser = session('twitterUser'); 

        return view('pages.erp.dashboard.dashboard', compact('user', 'facebookUser', 'twitterUser'));

        //return view('pages.erp.dashboard.dashboard', compact('user'));
    }

}


