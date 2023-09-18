<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FacebookPost;
use App\Models\FacebookPage;
use Illuminate\Support\Facades\Storage;

class FbPostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'page_ids' => 'required|array',
            'message' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pageIds = $validatedData['page_ids'];
        $message = $validatedData['message'];
        $image = $request->file('image');

        foreach ($pageIds as $pageId) {
            $page = FacebookPage::where('page_id', $pageId)->first();

            if (!$page) {
                continue;
            }

            $accessToken = $page->access_token;

            // Include image if provided
            if ($image) {
                $imagePath = Storage::disk('public')->put('images', $image);
                $imageURL = asset('storage/' . $imagePath);

                // Upload image
                $response = Http::attach(
                    'source',
                    fopen($image->path(), 'r'),
                    $image->getClientOriginalName()
                    )->post("https://graph.facebook.com/{$pageId}/photos", [
                    'caption' => $message,
                    'access_token' => $accessToken,
                ]);

                if (!$response->successful()) {
                    // Error handling for failed image upload
                    $errorMessage = $response->json()['error']['message'];
                    // Handle the error accordingly
                }
            }

            // Post text message with the image link in the caption
            $response = Http::post("https://graph.facebook.com/{$pageId}/feed", [
                'message' => $message,
                'access_token' => $accessToken,
                'link' => $imageURL,
            ]);
            //dd($response);
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Store the posted message in the database
                $postedMessage = FacebookPost::create([
                    'page_id' => $pageId,
                    'message' => $message,
                    'post_id' => $responseData['id'],
                    'image_url' => $imageURL,
                ]); 
                // dd($postedMessage);
            } else {
                // Request failed
                $errorMessage = $response->body();
                // Handle the error accordingly
            }
           
        }

        return redirect()->back()->with('success', 'Posts created and posted successfully.');
    }
}