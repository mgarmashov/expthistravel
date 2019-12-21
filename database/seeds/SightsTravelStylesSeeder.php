<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SightsTravelStylesSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $travelStyles='["full","steady","chilled"]';
    protected $sights='["main","main-hidden","hidden"]';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->where('sights', null)->update(['sights' =>  $this->sights, 'travel_styles' =>  $this->travelStyles]);
        DB::table('itineraries')->where('sights', null)->update(['sights' =>  $this->sights]);
        DB::table('itineraries')->where('travel_styles', null)->update(['travel_styles' =>  $this->travelStyles]);
    }
}
