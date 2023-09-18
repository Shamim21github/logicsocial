<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\models\ScheduledPost;

class PostToFacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduledPost;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\ScheduledPost $scheduledPost
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
        $this->scheduledPost->posted = true;
        $this->scheduledPost->save();
    }
}


