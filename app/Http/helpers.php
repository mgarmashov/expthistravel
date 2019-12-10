<?php

if (! function_exists('cropImage')) {
    function cropImage($src, $width = null, $height = null)
    {
        //get relative path
        if (stripos($src, 'torage/')) {
            $src = str_replace('/storage/', '', $src);
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
            return $src;
        }
    }
}

if (! function_exists('is_admin_controller')) {
    /**
     * @return bool
     */
    function is_admin_controller()
    {
        return ($route = app()->router->current()) && in_array('admin', (array)$route->middleware());
    }
}


if (! function_exists('randomBgImage')) {
    function randomBgImage()
    {
        $filesInFolder = \File::files('images/bg-images/');

        $fileNames = [];
        foreach($filesInFolder as $path) {
            $fileNames[] = rawurlencode(pathinfo($path)['basename']);
        }

        return asset('images/bg-images/'.array_random($fileNames));
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




if (! function_exists('uploadImage')) {
    function uploadImage($destination_path, $file)
    {
        try
        {
            $image = \Image::make($file);
            if (is_file($file)) {
                $filename = md5($file->getClientOriginalName().time()).'.jpg';
            } else {
                $filename = md5($file.time()).'.jpg';
            }

            \Storage::disk('public')->put($destination_path.'/'.$filename, $image->stream());

            return 'storage/'.$destination_path . '/' . $filename;
        }
        catch (\Exception $e)
        {
            if (empty ($image)) {
                return response('Not a valid image type', 412);
            } else {
                return response('Unknown error', 412);
            }
        }
    }
}
