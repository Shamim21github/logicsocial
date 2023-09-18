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

              
                $requestData['attached_media[0]'] = [
                    'media_fbid' => $imageURL,
                ];
            }

        
            $response = Http::post("https://graph.facebook.com/{$pageId}/feed", [
                'message' => $message,
                'access_token' => $accessToken,
                'image_url' => $requestData,
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                // Store the posted message in the database
                $postedMessage = FacebookPost::create([
                    'page_id' => $pageId,
                    'message' => $message,
                    'post_id' => $responseData['id'],
                    'image_url' => $imageURL,
                ]);
            } else {
                // Request failed
                $errorMessage = $response->body();
               
            }
        }

        return redirect()->back()->with('success', 'Posts created and posted successfully.');
    }
}
