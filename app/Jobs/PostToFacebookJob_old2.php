<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\ScheduledPost;
use Illuminate\Support\Facades\Http;
use App\Models\FacebookPost;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PostToFacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduledPost;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\ScheduledPost  $scheduledPost
     * @return void
     */
    public function __construct(ScheduledPost $scheduledPost)
    {
        $this->scheduledPost = $scheduledPost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::post("https://graph.facebook.com/114826811649882/feed", [
            'message' => $this->scheduledPost->content,
            'access_token' => 'EAALr1e5WgiQBOz1LoYBcrO0WE1SSXuTUsNKc0KqGCAwD3ZBcCVxdQz7E2qJGyut7BUZAau7qEEqnwckypsUckAdQw9ThdZC3LrOurndCzhXXm013xxRUxKDJhUmMgEgcidFQd3izxxL7AHZAUezbQuPohf1oFTda43qVoYD1NvEyo1DTfcZCH01sbMPY6PwVpkgmslrAIhjgdKZC4o4J2DnzKW',
        ]);
        
        if ($response->successful()) {
            $this->scheduledPost->posted = true;
            $this->scheduledPost->save();
            Log::info('Post to Facebook successful.');
        } else {
            // Handle the error as needed
            Log::error('Failed to post to Facebook.');
        }
    }
}


