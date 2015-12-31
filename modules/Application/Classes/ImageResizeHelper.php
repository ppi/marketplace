<?php

namespace Application\Classes;

use Intervention\Image\Image as InterventionImage;

class ImageResizeHelper
{
    
    public function makeThumb($src, $dest, $desired_width)
    {
        $newImage = InterventionImage::make($src)->resize($desired_width, null, true);
        return $newImage->save($dest);
    }
}
