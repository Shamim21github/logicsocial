<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMediaPlatform;

class SocialMediaPlatformSeeder extends Seeder
{
    public function run()
    {
        SocialMediaPlatform::create([
            'name' => 'Facebook',
            'platform_id' => 1,
        ]);

        SocialMediaPlatform::create([
            'name' => 'Twitter',
            'platform_id' => 2,
        ]);

        // Add more platforms as needed
    }
}
