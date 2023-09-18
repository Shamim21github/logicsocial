<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\FacebookUser;
use Exception;

class FacebookController extends Controller
{
    public function redirectToProvider()

    
    {
        $scopes = ['pages_manage_posts', 'pages_read_engagement'];
        
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
        dd($facebookUser);

        
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

        
        $pages = $this->getPages($facebookUser->token);

      
        $request->session()->put('facebookUser', $facebookUser);
        $request->session()->put('facebookPages', $pages);

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