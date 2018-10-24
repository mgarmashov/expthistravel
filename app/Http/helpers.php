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
