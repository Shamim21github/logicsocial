<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookUser extends Model
{
    protected $fillable = ['user_id', 'acc_profile_id', 'acc_name', 'access_token','avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platform()
    {
        return $this->morphOne(SocialMediaPlatform::class, 'platformable');
    }


    public function facebookPages()
    {
        return $this->hasMany(FacebookPage::class, 'facebook_user_id');
    }
}


