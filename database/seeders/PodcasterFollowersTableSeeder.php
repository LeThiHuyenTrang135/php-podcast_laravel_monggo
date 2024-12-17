<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\UTCDateTime;

class PodcasterFollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('podcaster_followers')->insert([
            [
                'podcaster_id' => '6755cba57dd3691c230ec504',
                'follower_id' => '6755cba57dd3691c230ec505',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
            ],
            [
                'podcaster_id' => '6755cba57dd3691c230ec504',
                'follower_id' => '6755cba57dd3691c230ec506',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
            ],
            [
                'podcaster_id' => '6755cba57dd3691c230ec505',
                'follower_id' => '6755cba57dd3691c230ec504',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
            ],
            [
                'podcaster_id' => '6755cba57dd3691c230ec506',
                'follower_id' => '6755cba57dd3691c230ec504',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
            ],
            [
                'podcaster_id' => '6755cba57dd3691c230ec506',
                'follower_id' => '6755cba57dd3691c230ec505',
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
            ],
        ]);
    }
}
