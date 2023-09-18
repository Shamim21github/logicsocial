<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
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

        
        $connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET'),
            env('TWITTER_BEARER_TOKEN')
        );
        //dd($connection);

        // Post tweet using TwitterOAuth
        $tweet = $connection->post('statuses/update', [
            'status' => $tweetContent,
        ]);
        dd($tweet);

        $tweet = new Tweet();
     
        $tweet->content = $tweetContent;
        $tweet->save();
    
        return redirect('/tweet')->with('success', 'Tweet posted successfully.');
    }
}
