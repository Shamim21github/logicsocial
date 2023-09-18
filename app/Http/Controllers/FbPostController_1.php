<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FacebookPost;

class FbPostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required',
            //'page_id' => 'required',
        ]);

        $message = $validatedData['message'];
        $accessToken = 'EAALr1e5WgiQBO5aEQxtD4RO0OHBWtiQ0pDJcqUZBUOti9SPeRpbklxJSlbgTddbeqxZCt9dXYw7X6ClB8y3shBP5bRe4y50aefvF1SqV80ZBJkpYDa4oUpZB65Dd1WtLqiZBGGgmqEYt9dkeE5Xwr8fEIJyNUjGxrIBOEC1mWR4ngFIueJcaZCRYuRCjNS0VoIWyqqxCpgQZB76OUV674TEBZBS7';
 
         
         
        // Store the message in the database
        $storedMessage = FacebookPost::create([
            'message' => $message,
        ]);

        $response = Http::post("https://graph.facebook.com/114826811649882/feed", [
            'message' => $message,
            'access_token' => $accessToken
        ]);
        //dd($response);

        // Handle the response
        if ($response->successful()) {
            // Request was successful, handle the response data
            $responseData = $response->json();
            return redirect()->back()->with('success', 'Post created and posted successfully.');
        } else {
            // Request failed, handle the error
            $errorMessage = $response->body();
            // Handle the error as needed
            return redirect()->back()->with('error', 'Failed to post to the Facebook page.');
        }
    }
}
