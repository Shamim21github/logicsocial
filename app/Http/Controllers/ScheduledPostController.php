<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledPost;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use App\Jobs\PostToFacebookJob;
use Illuminate\Support\Facades\Log;


class ScheduledPostController extends Controller
{
    public function index()
    {
        $userId = auth()->check() ? auth()->user()->id : session('sess_user_id');

        $scheduledPosts = ScheduledPost::where('user_id', $userId)->paginate(4);

        return view('pages.erp.scheduled_posts.index', compact('scheduledPosts'));
    }
     
    public function create()
    {
        return view('pages.erp.scheduled_posts.create');
    }

    public function store(Request $request)
    {
        $userId = session('sess_user_id');
        $facebookUser = session('facebookUser');
        $twitterUser = session('twitterUser');
        //dd($facebookUser);

        $data = $request->validate([
            'content' => 'required|max:255',
            'scheduled_at' => 'required|date',
            'platform' => 'required|in:Facebook,Twitter',
        ]);

        $platformType = ($data['platform'] === 'Facebook') ? 'Facebook' : 'Twitter';
        $platformId = ($data['platform'] === 'Facebook') ? 1 : 2;

        $scheduledPost = ScheduledPost::create([
            'user_id' => $userId,
            'content' => $data['content'],
            'platform' => $data['platform'], 
            'platform_id' => $platformId, 
            'platform_type' => $platformType,
            'posted' => false,
        ]);

        if ($data['scheduled_at']) {
            $scheduledPost->scheduled_at = Carbon::parse($data['scheduled_at']);
        }

        PostToFacebookJob::dispatch($scheduledPost, $facebookUser)->delay($scheduledPost->scheduled_at);

        $scheduledPost->save();

        return redirect()->route('calendar')->with('success', 'Scheduled post created successfully.');
    }

    
}