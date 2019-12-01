<?php

namespace App\Models;

use App\Scopes\CountriesScope;
use App\Scopes\EnabledScope;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Itinerary extends Model
{
    use CrudTrait;
    use SeoTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'itineraries';
    // protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = [
        'enabled',
        'index',
        'name',
        'slug',
        'price',
        'description_short',
        'description_long',
        'map_url',
        'image_main',
        'image_map',
        'image_background',
        'gallery',
        'months',
        'country',
        'city',
        'highlights',
        'transport',
        'travel_styles',
        'sights',
        'minDuration',
        'maxDuration',
        'scores'
        ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'months' => 'array',
        'scores' => 'array',
        'gallery' => 'array',
        'travel_styles' => 'array',
        'sights' => 'array',
    ];

    public static $filteredItinerariesList;

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

    public static function findBestItineraries($scoresOfUser)
    {
        if (!self::$filteredItinerariesList) {self::$filteredItinerariesList = self::with('countries')->get();}

        $categoriesIds = array_divide($scoresOfUser->toArray())[0];

        $filteredItineraries = [];
        foreach (self::$filteredItinerariesList as $itinerary) {
            $filteredItineraries[$itinerary->id] = [
                'name' => $itinerary->name
            ];
            $filteredItineraries[$itinerary->id]['sumScores'] = 0;
            foreach($categoriesIds as $categoryId) {
                $filteredItineraries[$itinerary->id]['scores'][$categoryId] = $itinerary->scores[$categoryId];
                $filteredItineraries[$itinerary->id]['sumScores'] += ($itinerary->scores[$categoryId] * $scoresOfUser[$categoryId]['score']);
            }
        }
        $filteredItineraries = collect($filteredItineraries)->sortBy('sumScores')->reverse()->slice(0,18);

        $output = self::$filteredItinerariesList->filter(function ($itinerary, $key) use ($filteredItineraries) {
            return array_has($filteredItineraries, $itinerary->id);
        });

        $output = $output->sortBy(function ($itinerary, $key) use ($filteredItineraries) {
            $sortedItinerariesIds = $filteredItineraries->keys()->toArray();
            return array_search($itinerary->id, $sortedItinerariesIds);
        });

        return $output;
    }

    public static function filterByCountry($countriesIdsArray)
    {
        if (!self::$filteredItinerariesList) {self::$filteredItinerariesList = self::with('countries')->get();}

        if (empty($countriesIdsArray) || in_array(0, $countriesIdsArray)) {
            return true;
        }
        self::$filteredItinerariesList = self::$filteredItinerariesList->filter(function($itinerary) use ($countriesIdsArray) {
            $itineraryCountriesIds = $itinerary->countries->pluck('id')->toArray();
            if(empty($itineraryCountriesIds)) {
                return true;
            }
            foreach ($itineraryCountriesIds as $countryId) {
                if (in_array($countryId, $countriesIdsArray)) {
                    return true;
                }
            }
            return false;
        });

        return self::$filteredItinerariesList;
    }

    public static function filterByMonth($monthIdsArray)
    {
        if (!self::$filteredItinerariesList) {self::$filteredItinerariesList = self::with('countries')->get();}

        if (empty($monthIdsArray) || in_array(0, $monthIdsArray)) {
            return self::$filteredItinerariesList;
        }

        self::$filteredItinerariesList = self::$filteredItinerariesList->filter(function($itinerary) use ($monthIdsArray) {
            if(!$itinerary->months) {
                return true;
            }
            if (in_array(0, $itinerary->months)) {
                return true;
            }
            foreach ($itinerary->months as $monthId) {
                if (in_array($monthId, $monthIdsArray)) {
                    return true;
                }
            }
            return false;
        });

        return self::$filteredItinerariesList;
    }

    public static function filterByDuration($periodsArray)
    {
        if (!self::$filteredItinerariesList) {self::$filteredItinerariesList = self::with('countries')->get();}

        $userDurationMin = intval($periodsArray[0]) ?? 1;
        $userDurationMax = intval($periodsArray[1]) ?? 29;

        self::$filteredItinerariesList = self::$filteredItinerariesList->filter(function ($itinerary, $key) use ($userDurationMin, $userDurationMax) {
            return (($userDurationMin >= $itinerary->minDuration && $userDurationMin <= $itinerary->maxDuration) || ($userDurationMax <= $itinerary->maxDuration && $userDurationMax >= $itinerary->maxDuration));
        });

        return self::$filteredItinerariesList;
    }

    public static function filterByExperience($experiencesIds)
    {
        if (!self::$filteredItinerariesList) {
            self::$filteredItinerariesList = self::with('countries')->get();
        }

        self::$filteredItinerariesList = self::$filteredItinerariesList->filter(function($itinerary) use ($experiencesIds) {
            foreach ($itinerary->experiences as $exp) {
                if (in_array($exp->id, $experiencesIds)) {
                    return true;
                }
            }
            return false;
        });

        return self::$filteredItinerariesList;
    }


        /*
        |--------------------------------------------------------------------------
        | RELATIONS
        |--------------------------------------------------------------------------
        */
    public function countries()
    {
        return $this->belongsToMany('App\Models\Country', 'countries_itineraries');
    }

    public function experiences()
    {
        return $this->belongsToMany('App\Models\Experience', 'experiences_itineraries');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'itineraries_products');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'itineraries_orders');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CountriesScope);
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
    public function setImageMainAttribute($value)
    {
        $attribute_name = "image_main";
        $this->saveImageNormally($attribute_name, $value);        
    }
    
    public function setImageMapAttribute($value)
    {
        $attribute_name = "image_map";
        $this->saveImageNormally($attribute_name, $value);
    }
    
    public function setImageBackgroundAttribute($value)
    {
        $attribute_name = "image_background";
        $this->saveImageNormally($attribute_name, $value);
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = $value ?? str_slug(request()->input('name'));
        $itineraries = Itinerary::where('slug', $this->attributes['slug'])->where('id','!=',request()->id ?? 0)->get();

        if (count($itineraries)>0) {
            $this->attributes['slug'] = $this->attributes['slug'].'-2';
        }
    }
    
    protected function saveImageNormally($attribute_name, $value) {
        // if the image was erased
        if ($value==null) {
            \Storage::disk("public")->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            $path = uploadImage("itineraries", $value);
            $this->attributes[$attribute_name] = $path;
        }
    }
}
