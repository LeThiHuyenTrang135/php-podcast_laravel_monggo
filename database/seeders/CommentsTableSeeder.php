<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\UTCDateTime;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'content' => 'Great episode!',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
                'podcast_id' => '6755cba57dd3691c230ec509',
                'podcaster_id' => '6755cba57dd3691c230ec504',
            ],
            [
                'content' => 'Very informative.',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
                'podcast_id' => '6755cba57dd3691c230ec50a',
                'podcaster_id' => '6755cba57dd3691c230ec505',
            ],
            [
                'content' => 'Loved the guest speaker.',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
                'podcast_id' => '6755cba57dd3691c230ec50b',
                'podcaster_id' => '6755cba57dd3691c230ec506',
            ],
            [
                'content' => 'Looking forward to the next episode.',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
                'podcast_id' => '6755cba57dd3691c230ec50c',
                'podcaster_id' => '6755cba57dd3691c230ec507',
            ],
            [
                'content' => 'This was really helpful, thanks!',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
                'podcast_id' => '6755cba57dd3691c230ec50d',
                'podcaster_id' => '6755cba57dd3691c230ec508',
            ],
        ]);
    }
}
