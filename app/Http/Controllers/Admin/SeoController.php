<?php
/**
 * Created by PhpStorm.
 * User: Mikhail Garmashov
 * Date: 21.03.2019
 * Time: 10:34
 */

namespace App\Http\Controllers\Admin;

use App\Models\Seo;

class SeoController
{

    public static $seoFields = [
        'seo_title' => '',
        'seo_description' => '',
        'seo_h1' => '',
        'seo_keywords' => '',
    ];

    public static function cutSeoFields($request) {
        foreach (self::$seoFields as $key => $value) {
            self::$seoFields[$key] = $request->input($key);
        }

        unset($request['seo_title']);
        unset($request['seo_description']);
        unset($request['seo_h1']);
        unset($request['seo_keywords']);

        return $request;

    }

    public static function addSeoFields($model, $id) {

        $seo = Seo::firstOrCreate(['model_type' => $model, 'model_id' => $id]);

        $seo['title'] = self::$seoFields['seo_title'];
        $seo['description'] = self::$seoFields['seo_description'];
        $seo['h1'] = self::$seoFields['seo_h1'];
        $seo['keywords'] = self::$seoFields['seo_keywords'];

        $seo->save();
    }
}