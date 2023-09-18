<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\FacebookUser;
use App\Models\FacebookPage;
use Exception;

class FacebookController extends Controller
{
    public function redirectToProvider()

    
    {
        $scopes = ['pages_manage_posts', 'pages_read_engagement', 'pages_manage_engagement', 'pages_show_list'];
        
        $clientId = config('services.facebook.client_id');
        $clientSecret = config('services.facebook.client_secret');
        
        return Socialite::driver('facebook')
            ->scopes($scopes)
            ->with(['client_id' => $clientId, 'client_secret' => $clientSecret])
            ->redirect();
            
    }
    
    public function handleFacebookCallback(Request $request)
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Facebook.');
        }
        //dd($facebookUser);

        
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

        
        $this->storeUserPages($newUser, $facebookUser->token);
        //dd($newUser);
      
        $request->session()->put('facebookUser', $facebookUser);
        $request->session()->put('facebookPages', $newUser->facebookPages);
        //dd($newUser);

        return redirect()->route('dashboard');
    }

    protected function storeUserPages($facebookUser, $accessToken)
    {
        try {
            $response = Socialite::driver('facebook')->userFromToken($accessToken);
            $pages = $response->offsetGet('accounts')->asArray();

            foreach ($pages as $page) {
                $facebookUser->facebookPages()->create([
                    'page_id' => $page['id'],
                    'page_name' => $page['name'],
                    'page_avatar' => "https://graph.facebook.com/{$page['id']}/picture?type=large",
                    'access_token' => $page['access_token'],
                ]);
            }
        } catch (Exception $e) {
            // Handle error if needed
        }
    }

    
}