<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\FacebookUser;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use App\Models\SentMessage;
use Exception;

class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
       // dd('Socialite');
        
    }

    public function handleFacebookCallback(Request $request, Facebook $fb)
    {
    try {
        $facebookUser = Socialite::driver('facebook')->user();
       // dd($facebookUser);
    } catch (Exception $e) {
        return redirect('/')->with('error', 'Failed to authenticate with facebook.');
    }

    // Check if the facebook user already exists in the database
    $existingUser = FacebookUser::where('user_id', $facebookUser->id)->first();
    dd($existingUser);
    
    if ($existingUser) {
       
        $existingUser->access_token = $facebookUser->token;
        $existingUser->acc_name = $facebookUser->name;
        $existingUser->avatar = $facebookUser->avatar;
        $existingUser->save();
    } else {
        // Create a new facebookUser record in the database
        //id	user_id	acc_profile_id	acc_name	avatar	access_token	
        $newUser = facebookUser::create([
            'user_id' => $facebookUser->id,
            'acc_profile_id' => $facebookUser->id,
            'acc_name' => $facebookUser->name,          
            'access_token' => $facebookUser->token,
            'avatar' => $facebookUser->avatar,
        ]);
        //dd($newUser);
    }
    $request->session()->put('facebookUser', $facebookUser);
    

    return redirect()->route('dashboard');
    
    }



    // public function getSentMessages()
    // {
    // $sentMessages = SentMessage::all();

    // return view('pages.sent_messages', compact('sentMessages'));
    // }


}


 // public function postToFacebook(Request $request)
    // {
    //     // Use Facebook Graph API to post on Facebook

    //     // Handle the response or perform other actions
    // }