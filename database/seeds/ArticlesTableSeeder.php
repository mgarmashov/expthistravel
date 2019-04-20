<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Country;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $faker = Faker\Factory::create();
            factory(\App\Models\BlogArticle::class)->create([
                'name' => $faker->realText('255'),
                'slug' => $faker->slug(),
                'datetime' => \Carbon\Carbon::parse($faker->datetime->format('Y-m-d H:i:s')),
                'description_short' => $faker->realText('500'),
                'description_long' => $faker->realText('1000'),
                'image' => $this->getFile($faker),
            ]);
        }
    }

    public function getFile($faker)
    {
//        $image = base64_encode(file_get_contents(public_path("$source/$name")));
        $image = base64_encode(file_get_contents($faker->imageUrl));

        return 'data:image/jpeg;base64,'.$image;
    }
}
