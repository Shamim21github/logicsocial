<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Config;
use TwitterAPIExchange;



class TweetController extends Controller
{
    public function create()
    {
        return view('pages.erp.tweet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:280',
        ]);

        $tweetContent = $request->input('content');
        //dd($tweetContent);

        
        $bearerToken = env('TWITTER_BEARER_TOKEN');
        //dd($bearerToken);

        
        $response = Http::withHeaders([
            'Authorization' => "Bearer $bearerToken",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.twitter.com/2/tweets', [
            'tweet' => [
                'text' => $tweetContent
            ]
        ]);
        dd($response);

        if ($response->successful()) {
            
            return redirect('/home')->with('success', 'Tweet posted successfully.');
        } else {
           
            return redirect('/home')->with('error', 'Failed to post the tweet.');
        }
    }
}


  
 
