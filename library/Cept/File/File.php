<?php
namespace Cept\File;

class File
{

    /**
     * Check if file is an image
     * @param string $file
     * @return boolean
     */
    public static function isImage($file)
    {
        $imageSize = getimagesize($file);
        $imageType = $imageSize[2];
        if(in_array($imageType , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
        {
            return true;
        }
        return false;
    }
}
