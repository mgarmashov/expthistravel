<?php

if (! function_exists('cropImage')) {
    function cropImage($src, $width = null, $height = null)
    {
        //get relative path
        if (stripos($src, 'torage/')) {
            $src = str_replace('storage/', '', $src);
        }

        //check if file exists
        $newSrc = str_replace('.', '-'.$width.'_'.$height.'.', $src);
        if(\Storage::disk('public')->exists($newSrc)) {
            return 'storage/'.$newSrc;
        }

        if (!$width && !$height) {
            $width = 500;
        }

        //http://image.intervention.io/
        $img = Image::make(\Storage::disk('public')->get($src));
        $img->fit($width, $height);

        \Storage::disk('public')->put($newSrc, $img->stream());

        return 'storage/'.$newSrc;
    }
}


if (! function_exists('randomBgImage')) {
    function randomBgImage()
    {
        $bgImages = [
            'windsurf.jpg',
            'boat.jpg',
            'food.jpg',
            'bus.jpg',
            'bikes.jpg',
            'asia1.jpg',
            'asia2.jpg',
            'asia3.jpg',
            'asia4.jpg',
            'beach1.jpg',
            'beach2.jpg',
            'beach3.jpg',
            'beach4.jpg',
            'waterfall.jpg',
        ];

        return array_random($bgImages);
    }
}

