<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;


class PodcastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('podcasters')->insert([
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec504'),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => new UTCDateTime(now()->timestamp * 1000)
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec505'),
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => new UTCDateTime(now()->timestamp * 1000)
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec506'),
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => new UTCDateTime(now()->timestamp * 1000)
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec507'),
                'name' => 'Bob Brown',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => new UTCDateTime(now()->timestamp * 1000)
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec508'),
                'name' => 'Charlie Davis',
                'email' => 'charlie@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => new UTCDateTime(now()->timestamp * 1000)
            ],
        ]);
    }
}
