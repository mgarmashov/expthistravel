<?php

namespace App\Models;

use App\Scopes\EnabledScope;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Product extends Model
{
    use CrudTrait;
    use SeoTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'description_short',
        'description_long',
        'months',
        'country',
        'city',
        'image',
        'index',
        'scores',
        'minDuration',
        'maxDuration',
        'enabled'
        ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'months' => 'array',
        'scores' => 'array'
//        'img' =>
    ];

    public static $filteredProductsList;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function duration()
    {
        if ($this->minDuration == 0 && $this->maxDuration == 0) return '1+ days';
        if ($this->minDuration == 1 && $this->maxDuration == 30) return '1+ days';
        if ($this->minDuration == 1 && $this->maxDuration == 1) return '1 day';
        if ($this->minDuration == $this->maxDuration) return $this->maxDuration.' days';
        if ($this->maxDuration == 30) return $this->minDuration.' days and more';

        return $this->minDuration.' - '.$this->maxDuration.' days';

    }

    public function place()
    {
        $countries = [];
        foreach($this->countries as $country) {
            $countries[] = $country->name;
        }
        $place = implode(', ', $countries);
        if ($this->city) {
            $place .= ', '.$this->city;
        }

        return $place;
    }

    public function months()
    {
        $input = $this->months;

        if (is_null($input) || in_array(0, $input)) { return 'Any month';}
        if (count($input) == 1 ) {return monthsList()[$input[0]];}

        sort($input);
        $output = collect($input)->map(function($month) {
            return monthsList()[$month];
        })
        ->implode(', ')
        ;

        return $output;
    }

    public function scores()
    {
        $outputScores = [];
        foreach ($this->scores as $categoryId => $score) {
            if ($score == 0) continue;
            $outputScores[config('categories')[$categoryId]['name']] = $score;
        }

        arsort($outputScores);
        $outputScores = array_slice($outputScores,0,6);

        return $outputScores;
    }

    public static function findBestProducts($scoresOfUser)
    {
        if (!self::$filteredProductsList) {self::$filteredProductsList = self::with('countries')->get();}

        $categoriesIds = array_divide($scoresOfUser->toArray())[0];

        $filteredProducts = [];
        foreach (self::$filteredProductsList as $product) {
            $filteredProducts[$product->id] = [
                'name' => $product->name
            ];
            $filteredProducts[$product->id]['sumScores'] = 0;
            foreach($categoriesIds as $categoryId) {
                $filteredProducts[$product->id]['scores'][$categoryId] = $product->scores[$categoryId];
                $filteredProducts[$product->id]['sumScores'] += ($product->scores[$categoryId] * $scoresOfUser[$categoryId]['score']);
            }
        }
        $filteredProducts = collect($filteredProducts)->sortBy('sumScores')->reverse()->slice(0,18);

        $output = self::$filteredProductsList->filter(function ($product, $key) use ($filteredProducts) {
            return array_has($filteredProducts, $product->id);
        });

        $output = $output->sortBy(function ($product, $key) use ($filteredProducts) {
            $sortedProductsIds = $filteredProducts->keys()->toArray();
            return array_search($product->id, $sortedProductsIds);
        });

        return $output;
    }

    public static function filterByCountry($countriesIdsArray)
    {
        if (!self::$filteredProductsList) {self::$filteredProductsList = self::with('countries')->get();}

        self::$filteredProductsList = self::$filteredProductsList->filter(function($product) use ($countriesIdsArray) {
            $productCountriesIds = $product->countries->pluck('id')->toArray();
            foreach ($productCountriesIds as $countryId) {
                if (in_array($countryId, $countriesIdsArray)) {
                    return true;
                }
            }
            return false;
        });

        return self::$filteredProductsList;
    }

    public static function filterByMonth($monthIdsArray)
    {
        if (!self::$filteredProductsList) {self::$filteredProductsList = self::with('countries')->get();}

        self::$filteredProductsList = self::$filteredProductsList->filter(function($product) use ($monthIdsArray) {
            if (in_array(0, $product->months)) {
                return true;
            }
            foreach ($product->months as $monthId) {
                if (in_array($monthId, $monthIdsArray)) {
                    return true;
                }
            }
            return false;
        });

        return self::$filteredProductsList;
    }

    public static function filterByDuration($periodsArray)
    {
        if (!self::$filteredProductsList) {self::$filteredProductsList = self::with('countries')->get();}

        $userDurationMin = intval($periodsArray[0]) ?? 1;
        $userDurationMax = intval($periodsArray[1]) ?? 29;

        self::$filteredProductsList = self::$filteredProductsList->filter(function ($product, $key) use ($userDurationMin, $userDurationMax) {
            return (($userDurationMin >= $product->minDuration && $userDurationMin <= $product->maxDuration) || ($userDurationMax <= $product->maxDuration && $userDurationMax >= $product->maxDuration));
        });

        return self::$filteredProductsList;
    }

    public static function filterByExperience($experiencesIds)
    {
        if (!self::$filteredProductsList) {
            self::$filteredProductsList = self::with('countries')->get();
        }

        self::$filteredProductsList = self::$filteredProductsList->filter(function($product) use ($experiencesIds) {
            foreach ($product->experiences as $exp) {
                if (in_array($exp->id, $experiencesIds)) {
                    return true;
                }
            }
            return false;
        });

        return self::$filteredProductsList;
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

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'images_products');
    }

    public function experiences()
    {
        return $this->belongsToMany('App\Models\Experience', 'experiences_products');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EnabledScope);
    }

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

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = $value ?? str_slug(request()->input('name'));
        $products = Product::where('slug', $this->attributes['slug'])->where('id','!=',request()->id ?? 0)->get();

        if (count($products)>0) {
            $this->attributes['slug'] = $this->attributes['slug'].'-2';
        }
    }
}
