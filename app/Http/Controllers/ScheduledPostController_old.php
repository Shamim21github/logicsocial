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
        
        if (session()->has('sess_user_id')) {
            $userId = session('sess_user_id');
            $scheduledPosts = ScheduledPost::where('user_id', $userId)->paginate(4);

            return view('pages.erp.scheduled_posts.index', compact('scheduledPosts'));
        } else {
    
            return redirect('/dashboard');
        }
    }

    public function create()
    {
        
        if (session()->has('sess_user_id')) {
            return view('pages.erp.scheduled_posts.create');
        } else {
           
            return redirect('/dashboard');
        }
    }

    public function store(Request $request)
    {
   
        if (session()->has('sess_user_id')) {
           
            $userId = session('sess_user_id');

            $data = $request->validate([
                'content' => 'required|max:255',
                'scheduled_at' => 'required|date',
                'platform' => 'required|in:Facebook,Twitter',
            ]);

            
            $platformType = ($data['platform'] === 'Facebook') ? 'Facebook' : 'Twitter';
            $platformId = ($data['platform'] === 'Facebook') ? 1 : 2;

            //dd($platformType);
            
            $scheduledPost = ScheduledPost::create([
                'user_id' => $userId,
                'content' => $data['content'],
                'platform' => $data['platform'],
                'platform_id' =>  $platformId, 
                'platform_type' => $platformType,
                'posted' => false,
               
            ]);
            //dd($scheduledPost);
            if ($data['scheduled_at']) {
                $scheduledPost->scheduled_at = Carbon::parse($data['scheduled_at']);
            }

            // Dispatch the job to post to Facebook at the scheduled time
            PostToFacebookJob::dispatch($scheduledPost)->delay($scheduledPost->scheduled_at);
            
    
            // Save the ScheduledPost model
            $scheduledPost->save();
        
            return redirect()->route('calendar')
                ->with('success', 'Scheduled post created successfully.');
        } else {
            
            return redirect('/dashboard');
        }
    }

    
}
