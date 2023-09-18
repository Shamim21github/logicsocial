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
            'message' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                $imagePath = $image->store('img', 'public');
                $imageURL = asset($imagePath);

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
                    // Handle the error
                }
            }

            $postedMessage = FacebookPost::create([
                'page_id' => $pageId,
                'message' => $message,
                'link' => $imageURL,
            ]);

            if (!$postedMessage) {
                // Handle the error
            }
        }

        return redirect()->back()->with('success', 'Posts created and posted successfully.');
    }
}