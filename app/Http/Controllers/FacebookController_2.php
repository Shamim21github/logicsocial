<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use App\Models\FacebookUser;
use App\Models\SentMessage;
use Exception;

class FacebookController extends Controller
{
    protected $fb;

    public function __construct(Facebook $fb)
    {
        $this->fb = $fb;
    }

    public function redirectToProvider()
    {
        // Redirect to Facebook login URL
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = [
            'public_profile', 
            'email',          
            'pages_manage_posts',
            'pages_read_engagement', 
        ];
        $loginUrl = $helper->getLoginUrl(route('facebook.callback'), $permissions);
        return redirect()->to($loginUrl);
        dd($loginUrl);
    }

    public function handleFacebookCallback(Request $request)
    {
        $helper = $this->fb->getRedirectLoginHelper();
        
        try {
            $accessToken = $helper->getAccessToken();
        } catch (FacebookSDKException $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Facebook.');
        }

        if (!isset($accessToken)) {
            return redirect('/')->with('error', 'Access token error');
        }

        // Use the access token to get the user's public profile information
        try {
            $response = $this->fb->get('/me?fields=id,name,email,picture', $accessToken);
            $facebookUser = $response->getGraphUser();
        } catch (FacebookSDKException $e) {
            return redirect('/')->with('error', 'Failed to get user information from Facebook.');
        }

        // Check if the facebook user already exists in the database
        $existingUser = FacebookUser::where('user_id', $facebookUser->getId())->first();

        if ($existingUser) {
            // Update the existing user record in the database
            $existingUser->access_token = $accessToken->getValue();
            $existingUser->acc_name = $facebookUser->getName();
            $existingUser->avatar = $facebookUser->getPicture()->getUrl();
            $existingUser->save();
        } else {
            // Create a new facebookUser record in the database
            $newUser = FacebookUser::create([
                'user_id' => $facebookUser->getId(),
                'acc_profile_id' => $facebookUser->getId(),
                'acc_name' => $facebookUser->getName(),
                'access_token' => $accessToken->getValue(),
                'avatar' => $facebookUser->getPicture()->getUrl(),
            ]);
        }

        // Store the Facebook user object in the session
        $request->session()->put('facebookUser', $facebookUser);

        return redirect()->route('dashboard');
    }

    // Your other methods like post content, etc., can be added here
}
