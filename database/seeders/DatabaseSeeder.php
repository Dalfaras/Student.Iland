<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $interests = [
            'Technology',
            'Design',
            'Marketing',
            'Entrepreneurship',
            'Sports',
            'Arts',
            'Volunteering',
            'Science',
            'Travel',
            'Music',
        ];

        foreach ($interests as $interest) {
            Interest::firstOrCreate(
                ['slug' => Str::slug($interest)],
                ['name' => $interest]
            );
        }
    }
}
