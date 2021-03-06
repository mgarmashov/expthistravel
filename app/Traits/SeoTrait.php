<?php
/**
 * Created by PhpStorm.
 * User: Mikhail Garmashov
 * Date: 21.03.2019
 * Time: 10:34
 */

namespace App\Traits;


trait SeoTrait
{

        public function initializeSeoTrait()
    {
            $this->fillable[] = 'seo_title';
            $this->fillable[] = 'seo_description';
            $this->fillable[] = 'seo_h1';
            $this->fillable[] = 'seo_keywords';
    }

    public function seo()
    {
        return $this->morphOne('App\Models\Seo', 'seo', 'model_type', 'model_id');
    }

    /* Title */
    public function getSeoTitleAttribute()
    {
        return $this->seo()->first()->title ?? '';
    }

    public function setSeoTitleAttribute($value)
    {
        $seo = $this->seo()->firstOrCreate(['model_type' => parent::getMorphClass(), 'model_id' => $this->id]);
        $seo->title = $value;
        $seo->save();
    }

    /* Description */
    public function getSeoDescriptionAttribute()
    {
        return $this->seo()->first()->description ?? '';
    }

    public function setSeoDescriptionAttribute($value)
    {
        $seo = $this->seo()->firstOrCreate(['model_type' => parent::getMorphClass(), 'model_id' => $this->id]);
        $seo->description = $value;
        $seo->save();
    }

    /* H1 */
    public function getSeoH1Attribute()
    {
        return $this->seo()->first()->h1 ?? '';
    }

    public function setSeoH1Attribute($value)
    {
        $seo = $this->seo()->firstOrCreate(['model_type' => parent::getMorphClass(), 'model_id' => $this->id]);
        $seo->h1 = $value;
        $seo->save();
    }

    /* Keywords */
    public function getSeoKeywordsAttribute()
    {
        return $this->seo()->first()->keywords ?? '';
    }

    public function setSeoKeywordsAttribute($value)
    {
        $seo = $this->seo()->firstOrCreate(['model_type' => parent::getMorphClass(), 'model_id' => $this->id]);
        $seo->keywords = $value;
        $seo->save();
    }
}