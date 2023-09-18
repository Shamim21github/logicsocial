<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use App\Models\FacebookUser;
use Exception;

class FacebookController extends Controller
{
    
    public function redirectToProvider()
    {
        $scopes = ['public_profile', 'email', 'manage_pages'];
        return Socialite::driver('facebook')->scopes($scopes)->redirect();
        dd($scopes);
    }


    public function handleFacebookCallback(Request $request)
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Facebook.');
        }

        // Check if the facebook user already exists in the database
        $existingUser = FacebookUser::where('user_id', $facebookUser->id)->first();

        if ($existingUser) {
            $existingUser->access_token = $facebookUser->token;
            $existingUser->acc_name = $facebookUser->name;
            $existingUser->avatar = $facebookUser->avatar;
            $existingUser->save();
        } else {
            $newUser = FacebookUser::create([
                'user_id' => $facebookUser->id,
                'acc_profile_id' => $facebookUser->id,
                'acc_name' => $facebookUser->name,          
                'access_token' => $facebookUser->token,
                'avatar' => $facebookUser->avatar,
            ]);
        }

        // Fetch pages using the user's access token
        $pages = $this->getPages($facebookUser->token);

        // Store the Facebook user object and pages in the session
        $request->session()->put('facebookUser', $facebookUser);
        $request->session()->put('facebookPages', $pages);

        return redirect()->route('dashboard');
    }

    protected function getPages($accessToken)
    {
        $this->fb->setDefaultAccessToken($accessToken);

        try {
            $response = $this->fb->get('/me/accounts');
            $graphPages = $response->getGraphEdge()->asArray();
            $pages = [];

            foreach ($graphPages as $graphPage) {
                $pages[] = [
                    'id' => $graphPage['id'],
                    'name' => $graphPage['name'],
                    'access_token' => $graphPage['access_token'],
                ];
            }

            return $pages;
        } catch (FacebookSDKException $e) {
            return [];
        }
    }

    // Add other methods as needed...

}
