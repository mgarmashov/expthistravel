<?php

namespace App\Models;

use App\Scopes\EnabledScope;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Page extends Model
{
    use CrudTrait;
    use SeoTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'content',
        'slug',
        'type',
        'image',
        'enabled'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function getPage($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
        $destination_path = "pages";

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
