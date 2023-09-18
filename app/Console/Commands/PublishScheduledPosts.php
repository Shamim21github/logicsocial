<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScheduledPost;
use App\Jobs\PostToFacebookJob;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Publish scheduled posts to Facebook';

    public function handle()
    {
        $scheduledPosts = ScheduledPost::where('scheduled_at', '<=', now())->get();

        foreach ($scheduledPosts as $scheduledPost) {
            PostToFacebookJob::dispatch($scheduledPost);
            // Update the post status as needed
        }
    }
}
