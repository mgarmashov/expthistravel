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
