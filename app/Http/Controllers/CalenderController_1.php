<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CrudEvents;
use App\Models\ScheduledPost;
use Illuminate\Support\Facades\Auth;
class CalenderController extends Controller
{
    public function index()
    {
        $userId = Auth::check() ? Auth::user()->id : session('sess_user_id');
        $authenticationMethod = session('facebookUser')
        ? 'Facebook'
        : (session('twitterUser') ? 'Twitter' : 'Custom');
        
        return view('pages.erp.scheduled_posts.calender', compact('userId'));
    }
    
 
    public function getSchedulePostData()
    {
    
        $authenticationMethod = session('facebookUser')
        ? 'Facebook'
        : (session('twitterUser') ? 'Twitter' : 'Custom');
        // dd($authenticationMethod);
    
        
        $userId = auth()->check() ? auth()->user()->id : session('sess_user_id');

      
        $scheduledPosts = ScheduledPost::where('user_id', $userId)->get();

        $filteredEvents = [];

        foreach ($scheduledPosts as $post) {
        if ($post->platform_type === $authenticationMethod && $post->scheduled_at !== null) {
            $filteredEvents[] = [
                'id' => $post->id,
                'title' => $post->content,
                'start' => $post->scheduled_at->format('Y-m-d H:i:s'),
                'end' => $post->scheduled_at->format('Y-m-d H:i:s'),
                'allDay' => false,
            ];
        }
    }

    return response()->json($filteredEvents);

}


    
}





