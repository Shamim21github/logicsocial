<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookPage extends Model
{
    protected $table = 'facebook_pages';

    protected $fillable = [
        'facebook_user_id',
        'page_id',
        'page_name',
        'page_avatar',
        'access_token',
    ];

    // Define the relationship to the user (FacebookUser)
    public function facebookUser()
    {
        return $this->belongsTo(FacebookUser::class);
    }
}