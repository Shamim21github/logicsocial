<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwitterService;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function create()
    {
        return view('pages.erp.tweet.create');
    }

    public function store(Request $request, TwitterService $twitterService)
    {
        $request->validate([
            'content' => 'required|max:280',
        ]);
        //dd($twitterService);
        //dd($request);

        $tweetContent = $request->input('content');
        //dd($tweetContent);
        $response = $twitterService->tweet($tweetContent);
        dd($response);

        $tweet = new Tweet();
        
         $tweet->content = $tweetContent;
         $tweet->save();

         return redirect('/dashboard')->with('success', 'Tweet posted successfully.');
    }
}
