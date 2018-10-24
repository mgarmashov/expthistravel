<?php

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Region;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            'Asia'
        ];

        $countries = [
            'Thailand',
            'Sri lanka',
            'Malaysia',
            'Vietnam'
        ];

        foreach ($regions as $item) {
            factory(Region::class)->create([
                'name' => $item
            ]);
        }

        foreach ($countries as $item) {
            factory(Country::class)->create([
                'name' => $item,
                'region' => Region::where('name', 'Asia')->first()->id
            ]);
        }

    }
}
