<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FacebookPost;
use App\Models\FacebookPage;

class FbPostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'page_id' => 'required',
            'message' => 'required',
        ]);

        $pageId = $validatedData['page_id'];
        $message = $validatedData['message'];

        $page = FacebookPage::where('page_id', $pageId)->first();

        if (!$page) {
            return redirect()->back()->with('error', 'Selected page not found.');
        }

        $accessToken = $page->access_token;

        $response = Http::post("https://graph.facebook.com/{$pageId}/feed", [
            'message' => $message,
            'access_token' => $accessToken,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            // Store the posted message in the database
            $postedMessage = FacebookPost::create([
                'page_id' => $pageId,
                'message' => $message,
                'post_id' => $responseData['id'], // Assuming the API response contains the post ID
            ]);
            return redirect()->back()->with('success', 'Post created and posted successfully.');
        } else {
            // Request failed, handle the error
            $errorMessage = $response->body();
            // Handle the error as needed
            return redirect()->back()->with('error', 'Failed to post to the Facebook page.');
        }
    }
}
