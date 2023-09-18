<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\TwitterService;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function create()
    {
        return view('pages.erp.tweet.create');
    }


    public function store(Request $request)
    {
        $tweetText = $request->input('text');
        $bearerToken = env('TWITTER_BEARER_TOKEN');
        //dd($bearerToken);

        $response = Http::withHeaders([
            'Authorization' => "Bearer $bearerToken",
        ])->post('https://api.twitter.com/2/tweets', [
            'text' => $tweetText,
        ]);
        echo '<pre>';
        print_r($response);
         echo '</pre>';
        die();

        if ($response->successful()) {
            // Tweet posted successfully
            return response()->json(['message' => 'Tweet posted successfully']);
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to post the tweet'], 500);
        }
    }
}

