<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $brand = [
            [
                'id' => '1',
                'name' => 'AVER',
                'category_id' => '1'
            ],
            [
                'id' => '2',
                'name' => 'DAKTRONICS',
                'category_id' => '2'
            ],
            [
                'id' => '3',
                'name' => 'LINSO',
                'category_id' => '3'
            ],
            [
                'id' => '4',
                'name' => 'ABSEN',
                'category_id' => '3'
            ],
            [
                'id' => '5',
                'name' => 'SHENZHEN',
                'category_id' => '3'
            ],
            [
                'id' => '6',
                'name' => 'TRT',
                'category_id' => '3'
            ],
            [
                'id' => '7',
                'name' => 'SHANGHAI',
                'category_id' => '3'
            ],
            [
                'id' => '8',
                'name' => 'SHANGHAI ELEC',
                'category_id' => '3'
            ],
            [
                'id' => '9',
                'name' => 'LIGHT KING',
                'category_id' => '3'
            ],
            [
                'id' => '10',
                'name' => 'LEYARD',
                'category_id' => '3'
            ],
            [
                'id' => '11',
                'name' => 'FABULUX',
                'category_id' => '3'
            ],
            [
                'id' => '12',
                'name' => 'UNILUMIN',
                'category_id' => '3'
            ],
            [
                'id' => '13',
                'name' => 'LEDTOP',
                'category_id' => '3'
            ],
            [
                'id' => '14',
                'name' => 'UNIVIEW',
                'category_id' => '3'
            ],
            [
                'id' => '15',
                'name' => 'APCUS',
                'category_id' => '3'
            ],
            [
                'id' => '16',
                'name' => 'YAHAM',
                'category_id' => '3'
            ],
            [
                'id' => '17',
                'name' => 'LIGHT HOUSE',
                'category_id' => '3'
            ],
            [
                'id' => '18',
                'name' => 'NOVA STAR',
                'category_id' => '4'
            ],
            [
                'id' => '19',
                'name' => 'NOVA STAR',
                'category_id' => '5'
            ],
            [
                'id' => '20',
                'name' => 'NOVA STAR',
                'category_id' => '7'
            ],
            [
                'id' => '21',
                'name' => 'NOVA STAR',
                'category_id' => '8'
            ],
            [
                'id' => '22',
                'name' => 'NOVA STAR',
                'category_id' => '10'
            ],
            [
                'id' => '23',
                'name' => 'PHILIPS',
                'category_id' => '6'
            ],
            [
                'id' => '24',
                'name' => 'ADPOD',
                'category_id' => '6'
            ],
            [
                'id' => '25',
                'name' => 'VOGELS',
                'category_id' => '11'
            ],
            [
                'id' => '26',
                'name' => 'KIOSK',
                'category_id' => '12'
            ],

        ];
        Brand::insert($brand);
    }
}
