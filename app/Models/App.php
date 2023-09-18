<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'identifier',
        'app_id',
        'app_secret',
    ];

}
