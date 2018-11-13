<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page::class)->create([
            'name' => 'About us',
            'slug' => 'about',
            'content' => view('frontend.layouts._about-seed')->render(),
            'type' => 'infoPage'
            ]);

    }
}
