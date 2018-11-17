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
            'Sight seeing' => null,
            'Nature' => 'nature.jpeg',
            'Wildlife' => null,
            'Watersports' => null,
            'Exercise / sport' => null,
            'Relaxation' => 'relaxjpg.jpg',
            'Food and Drink' => null,
            'Learn' => null,
            'Volunteer' => null,
            'Challenge' => null,
            'Events /festivals' => 'festivals.jpg',
            'Culture' => null
        ];

        foreach ($arr as $key => $value) {

//            $img = $value ? $this->getFile('examples', $value) : null;
            factory(Category::class)->create([
                'name' => $key,
//                'image' => $img,

            ]);
        }

    }

    public function getFile($source, $name)
    {
        $image = base64_encode(file_get_contents(public_path("$source/$name")));

        return 'data:image/jpeg;base64,'.$image;
    }
}
