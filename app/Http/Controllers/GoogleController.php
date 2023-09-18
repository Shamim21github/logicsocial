<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\GoogleUser;
use Exception;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();

    }


    public function handleProviderCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
           // dd($googleUser);
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Failed to authenticate with Google.');
        }

        // Check if the Google user already exists in the database
        $existingUser = GoogleUser::where('user_id', $googleUser->id)->first();

        if ($existingUser) {
            $existingUser->email = $googleUser->email;
            $existingUser->name = $googleUser->name;
            $existingUser->access_token = $googleUser->token;
            $existingUser->avatar = $googleUser->avatar;
            $existingUser->save();
        } else {
            // Create a new GoogleUser record in the database
            GoogleUser::create([
                'user_id' => $googleUser->id,
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'access_token' => $googleUser->token,
                'avatar' => $googleUser->avatar,
            ]);
        }

        $request->session()->put('googleUser', $googleUser);

        return redirect()->route('dashboard');
    }
}
