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
        $categories = config('categories');

        $data = config('activities');

        foreach ($data as $activity) {
            $scores = [];
            foreach ($categories as $key => $category) {
                (int) $scores[$key] = (int) $activity[$category['name']];
            }

            factory(Activity::class)->create([
                'name' => $activity['name'],
//                'image' => $this->getFile('examples', $activity['image']),
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
