<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookPost extends Model
{
    use HasFactory;

    // protected $fillable = ['page_id', 'message', 'image_url', 'post_id'];

    protected $fillable = ['page_id', 'message', 'link', 'post_id'];

    public function page()
    {
        return $this->belongsTo(FacebookPage::class, 'facebook_page_id');
    }
}
