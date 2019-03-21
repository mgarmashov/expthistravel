<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    protected $fillable = [
        'h1',
        'title',
        'keywords',
        'description',
        'model_id',
        'model_type'
    ];


    public function seo()
    {
        return $this->morphTo('seo', 'model_type', 'model_id', 'id');
    }

}
