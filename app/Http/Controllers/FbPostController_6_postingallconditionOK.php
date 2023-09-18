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
            'message' => 'required_without:image',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pageIds = $validatedData['page_ids'];
        $message = $validatedData['message'];

        foreach ($pageIds as $pageId) {
            $page = FacebookPage::where('page_id', $pageId)->first();

            if (!$page) {
                continue;
            }

            $accessToken = $page->access_token;
            $image = $request->file('image');
            $imageURL = null;

            if ($image) {
                $imagePath = Storage::disk('public')->put('images', $image);
                $imageURL = asset('storage/' . $imagePath);

                $response = Http::attach(
                    'source',
                    fopen($image->path(), 'r'),
                    $image->getClientOriginalName()
                )->post("https://graph.facebook.com/{$pageId}/photos", [
                    'caption' => $message,
                    'access_token' => $accessToken,
                ]);

                if (!$response->successful()) {
                    $errorMessage = $response->json()['error']['message'];
                    // Handle the error accordingly
                }
            }

            $postParams = [
                'message' => $message,
                'access_token' => $accessToken,
            ];

            if ($imageURL) {
                $postParams['link'] = $imageURL;
            }

            $response = Http::post("https://graph.facebook.com/{$pageId}/feed", $postParams);

            if ($response->successful()) {
                $responseData = $response->json();

                $postedMessage = FacebookPost::create([
                    'page_id' => $pageId,
                    'message' => $message,
                    'post_id' => $responseData['id'],
                    'link' => $imageURL,
                ]);
            } else {
                $errorMessage = $response->body();
                // Handle the error accordingly
            }
        }

        return redirect()->back()->with('success', 'Posts created and posted successfully.');
    }
}