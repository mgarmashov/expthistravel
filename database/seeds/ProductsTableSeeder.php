<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
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

        factory(Product::class)->create([
            'name' => 'Thai Boxing Training Camp',
            'description_short' => 'Master the art of Muay Thai',
            'description_long' => 'Take on the challenge of a Muay Thai training camp in Thailand. Learn a martial art, stay fit and keep active, and immerse in a Thai culture.',
            'months' => [0],
//            'country' => 'Thailand',
            'image' => $this->getFile('examples', 'muay_thai_1.jpg'),
            'scores' => [
                $categoriesId['Sight seeing'] => 1,
                $categoriesId['Nature'] => 1,
                $categoriesId['Wildlife'] => 1,
                $categoriesId['Watersports'] => 1,
                $categoriesId['Exercise / sport'] => 10,
                $categoriesId['Relaxation'] => 1,
                $categoriesId['Food and Drink'] => 5,
                $categoriesId['Learn'] => 10,
                $categoriesId['Volunteer'] => 1,
                $categoriesId['Challenge'] => 10,
                $categoriesId['Events /festivals'] => 1,
                $categoriesId['Culture'] => 10,

            ]
        ]);

        factory(Product::class)->create([
            'name' => 'Surf Sri Lanka',
            'description_short' => 'Learn to Surf in Stunning Sri Lanka',
            'description_long' => 'Surf’s up! This is the ideal introduction to surfing. Book a surf camp to catch some waves and enjoy blissful beaches of Sri Lanka.',
            'months' => [11,12,1,2,3],
//            'country' => 'Sri Lanka',
            'image' => $this->getFile('examples', 'Surf 3.jpg'),
            'scores' => [
                $categoriesId['Sight seeing'] => 5,
                $categoriesId['Nature'] => 5,
                $categoriesId['Wildlife'] => 1,
                $categoriesId['Watersports'] => 10,
                $categoriesId['Exercise / sport'] => 10,
                $categoriesId['Relaxation'] => 5,
                $categoriesId['Food and Drink'] => 5,
                $categoriesId['Learn'] => 10,
                $categoriesId['Volunteer'] => 1,
                $categoriesId['Challenge'] => 10,
                $categoriesId['Events /festivals'] => 1,
                $categoriesId['Culture'] => 1,

            ]
        ]);

        factory(Product::class)->create([
            'name' => 'Thai Cooking Class',
            'description_short' => 'Learn to Cook Authentic Thai Food',
            'description_long' => 'Famous for its delicious food, discover the art of Thai cuisine and create renowned dishes in a hands-on cooking class.',
            'months' => [0],
//            'country' => 'Thailand',
            'image' => $this->getFile('examples', 'Cooking class 3.jpg'),
            'scores' => [
                $categoriesId['Sight seeing'] => 1,
                $categoriesId['Nature'] => 1,
                $categoriesId['Wildlife'] => 1,
                $categoriesId['Watersports'] => 1,
                $categoriesId['Exercise / sport'] => 1,
                $categoriesId['Relaxation'] => 5,
                $categoriesId['Food and Drink'] => 10,
                $categoriesId['Learn'] => 10,
                $categoriesId['Volunteer'] => 1,
                $categoriesId['Challenge'] => 1,
                $categoriesId['Events /festivals'] => 1,
                $categoriesId['Culture'] => 10,

            ]
        ]);


    }


    public function getFile($source, $name)
    {
        $image = base64_encode(file_get_contents(public_path("$source/$name")));

        return 'data:image/jpeg;base64,'.$image;
    }
}
