<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Country;

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

        $data = config('products');

        foreach ($data as $product) {
            $scores = [];
            foreach ($categories as $cat) {
                $categoryId = \App\Models\Category::where('name', $cat)->first()->id;
                $scores[$categoryId] = $product[$cat];

            }

            $p1 = factory(Product::class)->create([
                'name' => $product['Experience'],
//                'description_short' => 'Master the art of Muay Thai',
//                'description_long' => 'Take on the challenge of a Muay Thai training camp in Thailand. Learn a martial art, stay fit and keep active, and immerse in a Thai culture.',
                'months' => $product['When (month)'],
//                'image' => $this->getFile('examples', 'muay_thai_1.jpg'),
                'scores' => $scores
            ]);


            $country = Country::where('name', $product['Country'])->first()->id;
            $p1->countries()->attach($country);
        }
    }

    public function getFile($source, $name)
    {
        $image = base64_encode(file_get_contents(public_path("$source/$name")));

        return 'data:image/jpeg;base64,'.$image;
    }
}
