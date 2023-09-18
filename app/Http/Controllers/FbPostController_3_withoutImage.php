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
            'page_ids' => 'required|array',
            'message' => 'required',
        ]);

        $pageIds = $validatedData['page_ids'];
        $message = $validatedData['message'];

        foreach ($pageIds as $pageId) {
            $page = FacebookPage::where('page_id', $pageId)->first();

            if (!$page) {
                continue; 
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
                    'post_id' => $responseData['id'],
                ]);
            } else {
                // Request failed
                $errorMessage = $response->body();
               
            }
        }

        return redirect()->back()->with('success', 'Posts created and posted successfully.');
    }
}
