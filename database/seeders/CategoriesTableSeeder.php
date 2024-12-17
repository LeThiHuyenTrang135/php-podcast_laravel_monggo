<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec4ff'),
                'name' => 'Technology'
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec500'),
                'name' => 'Health'
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec501'),
                'name' => 'Business'
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec502'),
                'name' => 'Entertainment'
            ],
            [
                '_id' => new ObjectId('6755cba57dd3691c230ec503'),
                'name' => 'Education'
            ],
        ]);
    }
}
