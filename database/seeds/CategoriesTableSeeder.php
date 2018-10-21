<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'Sight seeing',
            'Nature',
            'Wildlife',
            'Watersports',
            'Exercise / sport',
            'Relaxation',
            'Food and Drink',
            'Learn',
            'Volunteer',
            'Challenge',
            'Events /festivals',
            'Culture'
        ];

        foreach ($arr as $item) {
            factory(Category::class)->create([
                'name' => $item
            ]);
        }

    }
}
