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
        $now = Carbon::now();
        $scheduledTime = Carbon::parse($this->scheduledPost->scheduled_at);
    
        if ($now >= $scheduledTime) {
            $response = Http::post("https://graph.facebook.com/your-page-id/feed", [
                'message' => $this->scheduledPost->content,
                'access_token' => 'EAALr1e5WgiQBOZCGWbcS9wEoll3KooIyQQJx7Ffmp7sxhVgZBuUIsEh1F9EeYGcHZCXmO0ay1JilRnhsXEg7cUF7WoaJQ9S8fpNWhJlOwZBzlTFeqNZBHlSPPrZC1AZCLOP61UoMl43FCQwPscPkAv3EoD5cXL1gc9VKQa5FaIorsy7bUP6ko5KAo0PyNj9jEHdiEGU4Q9IysfmmJSRDcoZD', 
            ]);
    
            if ($response->successful()) {
                $this->markPostAsPosted();
                Log::info('Post to Facebook successful.');
            } else {
                $this->handleFailedPost();
            }
        } else {
            // Release the job to the queue and delay it appropriately
            $this->release($scheduledTime->diffInSeconds($now));
        }
    }
    
    protected function markPostAsPosted()
    {
        $this->scheduledPost->update(['posted' => true]);
    }
    
    protected function handleFailedPost()
    {
        // Handle the case where the post to Facebook failed
        // You can choose to retry the job or take other actions
        Log::error('Failed to post to Facebook.');
    }

}