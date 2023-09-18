<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

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
        
        $tweetEndpoint = 'https://api.twitter.com/2/tweets';
        //dd($tweetEndpoint);
    
        $bearerToken = env('TWITTER_BEARER_TOKEN');
        //dd( $bearerToken);
       
        $headers = [
            "Authorization: Bearer $bearerToken",
            "Content-Type: application/json",
        ];
        //dd($headers);

       
        $data = [
            'text' => $tweetContent,
        ];
        //dd($data);

        $response = Http::withHeaders($headers)->post($tweetEndpoint, $data);
        //dd($response);

       
        $connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
           
        );
        //dd($connection);

        // Post tweet using API v2
        $statuses = $connection->post($tweetEndpoint, $data);
        //dd($statuses);
    

        
       $tweet = new Tweet();
     
        $tweet->content = $tweetContent;
        $tweet->save();
    
        return redirect('/home')->with('success', 'Tweet posted successfully.');
    }

}
