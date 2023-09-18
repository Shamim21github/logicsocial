<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','access_token','acc_name','access_token_secret','avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function platform()
    {
        return $this->morphOne(SocialMediaPlatform::class, 'platformable');
    }
}


