<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'Thailand',
            'Sri lanka',
            'France',
            'United States',
            'Spain',
            'China',
            'Italy',
            'Turkey',
            'United Kingdom',
            'Germany',
            'Mexico'
        ];

        foreach ($arr as $item) {
            factory(Country::class)->create([
                'name' => $item
            ]);
        }

    }
}
