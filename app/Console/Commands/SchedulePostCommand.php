<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScheduledPost;
use Carbon\Carbon;
use App\Jobs\PostToFacebookJob;

class SchedulePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:postcontent';
    //protected $signature = 'schedule:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post scheduled content to social media platforms';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all scheduled posts that are due for posting
        $scheduledPosts = ScheduledPost::where('posted', false)
            ->where('scheduled_at', '<=', Carbon::now())
            ->get();

        // Dispatch the job to post the content for each scheduled post
        foreach ($scheduledPosts as $post) {
            PostToFacebookJob::dispatch($post);
            
            // Mark the post as posted (i.e., update the 'posted' column to true)
            $post->update(['posted' => true]);
        }
    }
}