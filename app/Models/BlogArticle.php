<?php

namespace App\Models;

use App\Scopes\EnabledScope;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class BlogArticle extends Model
{
    use CrudTrait;
    use SeoTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'blog_articles';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'description_short',
        'description_long',
        'image',
        'index',
        'enabled'
    ];
    // protected $hidden = [];
    // protected $dates = [];

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
    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'images_blog_articles');
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
        $destination_path = "blog/articles";

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
