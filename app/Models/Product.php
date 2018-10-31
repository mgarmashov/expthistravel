<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Product extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'description_short',
        'description_long',
        'months',
        'country',
        'city',
        'image',
        'index',
        'scores',
        'minDuration',
        'maxDuration'
        ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'months' => 'array',
        'scores' => 'array'
//        'img' =>
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function filterByPeriod($periodsArray)
    {
        $userDurationMin = 30;
        $userDurationMax = 7;

        if (empty($periodsArray) ) {
            return Product::all();
        }

        if(in_array('8-13',$periodsArray)) {
            $userDurationMin = 8;
            $userDurationMax = 14;
        }

        if(in_array('up7', $periodsArray)) {
            $userDurationMin = 0;
        }
        if(in_array('14more', $periodsArray)) {
            $userDurationMax = 30;
        }
        if(in_array('all', $periodsArray)) {
            $userDurationMin = 0;
            $userDurationMax = 30;
        }

        $products = Product::all()->filter(function ($product, $key) use ($userDurationMin, $userDurationMax) {
            return ($product->minDuration >= $userDurationMin && $product->maxDuration <= $userDurationMax);
        });

        return $products;
    }


    public static function findBestProducts($inputProducts, $scoresForView)
    {
        $products = $inputProducts;

        $categoriesIds = array_divide($scoresForView->toArray())[0];

        $filteredProducts = [];
        foreach ($products as $product) {
            $filteredProducts[$product->id] = [
                'name' => $product->name
            ];
            $filteredProducts[$product->id]['sumScores'] = 0;
            foreach($categoriesIds as $categoryId) {
                $filteredProducts[$product->id]['scores'][$categoryId] = $product->scores[$categoryId];
                $filteredProducts[$product->id]['sumScores'] += ($product->scores[$categoryId] * $scoresForView[$categoryId]['score']);
            }
        }
        $filteredProducts = collect($filteredProducts)->sortBy('sumScores')->reverse()->slice(0,18);

        $output = $products->filter(function ($product, $key) use ($filteredProducts) {
            return array_has($filteredProducts, $product->id);
        });

        $output->sortBy(function ($product, $key) use ($filteredProducts) {
            return array_search($product->id, $filteredProducts->toArray());
        });

        return $output;


    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function countries()
    {
        return $this->belongsToMany('App\Models\Country', 'countries_products');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = "products";

        // if the image was erased
        if ($value==null) {
            \Storage::disk("public")->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            $image = \Image::make($value);
            $filename = md5($value.time()).'.jpg';
            \Storage::disk("public")->put($destination_path.'/'.$filename, $image->stream());
            $this->attributes[$attribute_name] = 'storage/'.$destination_path.'/'.$filename;
        }
    }
}
