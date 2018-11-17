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
        try {
            $img = Image::make(\Storage::disk('public')->get($src));
            $img->fit($width, $height);

            \Storage::disk('public')->put($newSrc, $img->stream());

            return 'storage/'.$newSrc;
        } catch (Exception $e) {
            return '';
        }
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

if (! function_exists('monthsList')) {
    function monthsList()
    {
        return [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
    }
}