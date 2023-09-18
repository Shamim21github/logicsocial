<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CrudEvents;
use App\Models\ScheduledPost;
class CalenderController extends Controller
{
    public function index()
    {
        $scheduledPosts = ScheduledPost::all();
            
        return view('pages.erp.scheduled_posts.calender', compact('scheduledPosts'));
    }
    
 
    public function getSchedulePostData()
    {

        $userId = session('sess_user_id');
        

        $scheduledPosts = ScheduledPost::where('user_id', $userId)->get();
    
        
        $events = [];

        foreach ($scheduledPosts as $post) {
            if ($post->scheduled_at !== null) {
                $events[] = [
                    'id' => $post->id,
                    'title' => $post->content,
                    'start' => $post->scheduled_at->format('Y-m-d H:i:s'),
                    'end' => $post->scheduled_at->format('Y-m-d H:i:s'),
                    'allDay' => false,
                ];
            }
        }

        return response()->json($events);
    }

    
}





