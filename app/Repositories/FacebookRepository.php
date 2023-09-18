<?php


namespace App\Repositories;

use Laravel\Socialite\Facades\Socialite;
use App\Models\FacebookUser;
use Exception;

class FacebookRepository
{
    public function redirectToProvider($appId, $appSecret)
    {
        $scopes = ['public_profile', 'email', 'manage_pages'];
        return Socialite::driver('facebook')->scopes($scopes)
            ->with(['app_id' => $appId, 'app_secret' => $appSecret])
            ->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Facebook.');
        }

        // Check if the Facebook user already exists in the database
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
        try {
            $response = Socialite::driver('facebook')->userFromToken($accessToken)->getHttpClient()
                ->get('/me/accounts?fields=id,name,access_token');
            $graphPages = json_decode($response->getBody(), true)['data'];
            $pages = [];

            foreach ($graphPages as $graphPage) {
                $pages[] = [
                    'provider' => 'facebook',
                    'access_token' => $graphPage['access_token'],
                    'id' => $graphPage['id'],
                    'name' => $graphPage['name'],
                    'image' => "https://graph.facebook.com/{$graphPage['id']}/picture?type=large",
                ];
            }

            return $pages;
        } catch (Exception $e) {
            return [];
        }
    }

    // Add other methods as needed...
}
