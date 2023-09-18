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
        $scopes = ['public_profile','email','pages_manage_posts', 'pages_read_engagement'];
        return Socialite::driver('facebook')->scopes($scopes)->redirect();
      
        
    }

    public function handleFacebookCallback(Request $request, Facebook $fb)
    {
    try {
        $facebookUser = Socialite::driver('facebook')->user();
       //dd($facebookUser);
    } catch (Exception $e) {
        return redirect('/')->with('error', 'Failed to authenticate with facebook.');
    }

    // Check if the facebook user already exists in the database
    $existingUser = FacebookUser::where('user_id', $facebookUser->id)->first();

    //dd($existingUser);
    
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
    $pages = $this->getPages($facebookUser->token);
    //dd($pages);


    $request->session()->put('facebookUser', $facebookUser);
    $request->session()->put('facebookPages', $pages);
    //dd($pages);
    

    return redirect()->route('dashboard');
    
    }

    protected function getPages($accessToken)
    {
        try {
            $response = Socialite::driver('facebook')->userFromToken($accessToken);
            $pages = $response->offsetGet('accounts')->asArray();

            return array_map(function ($item) {
                return [
                    'provider' => 'facebook',
                    'access_token' => $item['access_token'],
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'image' => "https://graph.facebook.com/{$item['id']}/picture?type=large"
                ];
            }, $pages);
        } catch (Exception $e) {
            return [];
        }
    }



    


}


 