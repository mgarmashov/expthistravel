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

            $img = $value ? $this->getFile('examples', 'categories', $value) : null;
            factory(Category::class)->create([
                'name' => $key,
                'img' => $img,

            ]);
        }

    }

    public function getFile($source, $to, $name)
    {
        if (!Storage::disk('public')->exists($to)) {
            Storage::disk('public')->makeDirectory($to);
        }

        $filename = md5($name.time()).'.jpg';
        copy(public_path("$source/$name"), Storage::disk('public')->path("$to/$filename"));

        return 'storage/'.$to.'/'.$filename;
    }
}
