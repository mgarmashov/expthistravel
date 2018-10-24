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

        $data = config('activities');

        foreach ($data as $activity) {
            $scores = [];
            foreach ($categories as $cat) {
                $categoryId = \App\Models\Category::where('name', $cat)->first()->id;
                $scores[$categoryId] = $activity[$cat];

            }

            $p1 = factory(Activity::class)->create([
                'name' => $activity['name'],
                'image' => $this->getFile('examples', $activity['image']),
                'scores' => $scores
            ]);

        }
    }


    public function getFile($source, $name)
    {
        $image = base64_encode(file_get_contents(public_path("$source/$name")));

        return 'data:image/jpeg;base64,'.$image;
    }
}
