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
            //dd($facebookUser);
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Facebook.');
        }
        //dd($facebookUser);

         // Store Facebook user data in the session
         session(['facebookUser' => $facebookUser]);
         $request->session()->put('facebookUser', $facebookUser);
         
        $existingUser = FacebookUser::where('user_id', $facebookUser->id)->first();
        //dd($existingUser);

        if ($existingUser) {
            $existingUser->access_token = $facebookUser->token;
            $existingUser->acc_name = $facebookUser->name;
            $existingUser->avatar = $facebookUser->avatar;
            $existingUser->save();
            //dd($existingUser->access_token);

            $this->storeUserPages($existingUser, $facebookUser->token);
            //dd($facebookUser->token);
        } else {
            $newUser = FacebookUser::create([
                'user_id' => $facebookUser->id,
                'acc_profile_id' => $facebookUser->id,
                'acc_name' => $facebookUser->name,
                'access_token' => $facebookUser->token,
                'avatar' => $facebookUser->avatar,
            ]);
             //dd($newUser);              
            $this->storeUserPages($newUser, $facebookUser->token);
        }
      
        $request->session()->put('facebookUser', $facebookUser);
        $pages = $existingUser ? $existingUser->facebookPages : $newUser->facebookPages;
        //dd($pages);
        $request->session()->put('facebookPages', $pages);
        

        return redirect()->route('dashboard', ['pages' => $pages]);
        //dd($pages);
    }

    protected function storeUserPages($facebookUser, $accessToken)
    {
        try {
        $client = new \GuzzleHttp\Client();

        $response = $client->get('https://graph.facebook.com/v12.0/me/accounts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $pagesData = json_decode($response->getBody()->getContents(), true);

        if (isset($pagesData['data'])) {
            foreach ($pagesData['data'] as $page) {
                $pageModel = FacebookPage::updateOrCreate(
                    ['page_id' => $page['id']],
                    [
                        'facebook_user_id' => $facebookUser->id,
                        'page_name' => $page['name'],
                        'page_avatar' => "https://graph.facebook.com/{$page['id']}/picture?type=large",
                        'access_token' => $page['access_token'],
                    ]
                );
            }
        }
        } catch (\Exception $e) {
    
        }
    }

}