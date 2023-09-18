<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\TwitterUser;
use Illuminate\Http\Request;
use Exception;



class TwitterLoginController extends Controller
{
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

   

    public function handleTwitterCallback(Request $request)
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Twitter.');
        }
    
        
        $existingUser = TwitterUser::where('user_id', $twitterUser->id)->first();
    
        if ($existingUser) {
            
            $existingUser->access_token = $twitterUser->token;
            $existingUser->access_token_secret = $twitterUser->tokenSecret;
            $existingUser->avatar = $twitterUser->avatar;
            $existingUser->save();
        } else {
            // Create a new TwitterUser record in the database
            $newUser = TwitterUser::create([
                'user_id' => $twitterUser->id,
                'acc_name' => $twitterUser->name,
                'access_token' => $twitterUser->token,
                'access_token_secret' => $twitterUser->tokenSecret,
                'avatar' => $twitterUser->avatar,
            ]);
            //dd($newUser);
        }
    
        // Store the authenticated user's data in the session
        $request->session()->put('twitterUser', $twitterUser);
        //dd($twitterUser);
        
        return redirect()->route('dashboard');
    }
    

}