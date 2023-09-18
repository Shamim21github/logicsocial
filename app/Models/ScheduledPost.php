<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledPost extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // Add the $dates property to the model
    protected $dates = ['scheduled_at'];

    protected $fillable = [
        'user_id',
        'content',
        'posted',
        'platform_id',
        'platform_type',
        
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platform()
    {
        return $this->morphTo('platform');
    }

}
