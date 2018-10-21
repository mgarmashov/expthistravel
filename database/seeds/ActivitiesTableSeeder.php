<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
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

        $categoriesId = [];
        foreach ($categories as $cat) {
            $categoriesId[$cat] = \App\Models\Category::where('name', $cat)->first()->id;
        }

        factory(Activity::class)->create([
            'name' => 'Activity 1',
            'description' => 'lorem',
            'image' => $this->getFile('examples', 'Muay Thai 4.jpg'),
            'scores' => [
                $categoriesId['Sight seeing'] => 0,
                $categoriesId['Nature'] => 1,
                $categoriesId['Wildlife'] => 0,
                $categoriesId['Watersports'] => 1,
                $categoriesId['Exercise / sport'] => 1,
                $categoriesId['Relaxation'] => 0,
                $categoriesId['Food and Drink'] => 0,
                $categoriesId['Learn'] => 0,
                $categoriesId['Volunteer'] => 1,
                $categoriesId['Challenge'] => 0,
                $categoriesId['Events /festivals'] => 1,
                $categoriesId['Culture'] => 0,

            ]
        ]);

        factory(Activity::class)->create([
            'name' => 'Activity 2',
            'description' => 'lorem',
            'image' => $this->getFile('examples', 'Surf 4.jpg'),
            'scores' => [
                $categoriesId['Sight seeing'] => 0,
                $categoriesId['Nature'] => 0,
                $categoriesId['Wildlife'] => 1,
                $categoriesId['Watersports'] => 1,
                $categoriesId['Exercise / sport'] => 1,
                $categoriesId['Relaxation'] => 1,
                $categoriesId['Food and Drink'] => 0,
                $categoriesId['Learn'] => 1,
                $categoriesId['Volunteer'] => 1,
                $categoriesId['Challenge'] => 1,
                $categoriesId['Events /festivals'] => 1,
                $categoriesId['Culture'] => 1,

            ]
        ]);

        factory(Activity::class)->create([
            'name' => 'Activity 3',
            'description' => 'lorem',
            'image' => $this->getFile('examples', 'Cooking class 1.jpg'),
            'scores' => [
                $categoriesId['Sight seeing'] => 1,
                $categoriesId['Nature'] => 1,
                $categoriesId['Wildlife'] => 1,
                $categoriesId['Watersports'] => 1,
                $categoriesId['Exercise / sport'] => 1,
                $categoriesId['Relaxation'] => 0,
                $categoriesId['Food and Drink'] => 00,
                $categoriesId['Learn'] => 00,
                $categoriesId['Volunteer'] => 1,
                $categoriesId['Challenge'] => 1,
                $categoriesId['Events /festivals'] => 1,
                $categoriesId['Culture'] => 0,

            ]
        ]);


    }


    public function getFile($source, $name)
    {
        $image = base64_encode(file_get_contents(public_path("$source/$name")));

        return 'data:image/jpeg;base64,'.$image;
    }
}
