<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\TwitterUser;
use App\Models\FacebookUser;


class HomeController extends Controller
{
  
    public function index(Request $request)
    {
        $sess_id = session('sess_id');
        if (!isset($sess_id)) {
            return redirect('/');
        }

        $googleUser = $request->session()->get('googleUser');
        if ($googleUser) {
        
            $request->session()->forget('googleUser');
        }


        $facebookUser = $request->session()->get('FacebookUser');
        if ($facebookUser) {
            // Clear the Facebook user data from the session
            $request->session()->forget('FacebookUser');

        }


        return view("layout.erp.app");
    }


   public function show()
    {
        $user = auth()->user();
       // $googleUser = GoogleUser::where('user_id', $user->id)->first();
        $twitterUser = TwitterUser::where('user_id', $user->id)->first();

        return view('home')->with('twitterUser', $twitterUser);

    }

}
