<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Config;



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
      

        $twitterApiConfig = Config::get('services.twitter');
        //dd($twitterApiConfig);

        $connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET'),
            env('TWITTER_BEARER_TOKEN')
        );
        //dd($connection);
        

        $statuses = $connection->post("statuses/update", ["status" => $tweetContent]);
        //dd($statuses);
       
        // Save tweet to database
        $tweet = new Tweet();
       // $tweet->user_id = $userId;
        $tweet->content = $tweetContent;
        $tweet->save();
    
        return redirect('/dashboard')->with('success', 'Tweet posted successfully.');
    }

}




  
 
