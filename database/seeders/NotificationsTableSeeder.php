<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\UTCDateTime;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            [
                'sender_id' => '6755cba57dd3691c230ec504',
                'receiver_id' => '6755cba57dd3691c230ec505',
                'podcast_id' => '6755cba57dd3691c230ec509',
                'content' => 'John Doe just posted a new podcast!',
                'is_seen' => false,
                'created_at' => new UTCDateTime(now()->timestamp * 1000),
                'updated_at' => new UTCDateTime(now()->timestamp * 1000),
            ],
        ]);
    }
}
