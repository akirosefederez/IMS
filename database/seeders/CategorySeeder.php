<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = [
            [
                'id' => '1',
                'name' => 'AVER'
            ],
            [
                'id' => '2',
                'name' => 'DAKTRONICS'
            ],
            [
                'id' => '3',
                'name' => 'LED'
            ],
            [
                'id' => '4',
                'name' => 'LED CONTROLLER'
            ],
            [
                'id' => '5',
                'name' => 'MEDIA PLAYER'
            ],
            [
                'id' => '6',
                'name' => 'PHILIPS'
            ],
            [
                'id' => '7',
                'name' => 'SENDING BOX'
            ],
            [
                'id' => '8',
                'name' => 'SENDING CARD'
            ],
            [
                'id' => '9',
                'name' => 'SHUTTLE'
            ],
            [
                'id' => '10',
                'name' => 'VIDEO PROCESSOR'
            ],
            [
                'id' => '11',
                'name' => 'VOGELS'
            ],
            [
                'id' => '12',
                'name' => 'WINALL'
            ],
        ];
        Category::insert($category);
    }
}
