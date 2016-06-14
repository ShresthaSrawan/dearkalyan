<?php

namespace App\Helpers;

use Image;

class FileHelper
{
    private static $THUMB_PATH = 'thumbnails/';

    /**
     * @param $file
     * @param $path
     * @param null $name
     * @return string
     */
    public static function upload($file, $path, $name = NULL)
    {
        $extension = $file->getClientOriginalExtension();

        if(is_null($name)): 
            // Assigning a unique file name
            $fileName = sha1(time()).'.'.$extension;
            while(file_exists($path.$fileName)):
                $fileName = sha1(time()).'.'.$extension;
            endwhile;
        else:
            $fileName = $name.'.'.$extension;
            if(file_exists($path.$fileName)):
                unlink($path.$fileName);
            endif;
        endif;

        $file->move($path, $fileName);

        return $path.$fileName;
    }

    /**
     * @param $width
     * @param $height
     * @param $file
     * @param $thumbPath
     * @param string $prefix
     * @return string
     */
    public static function getThumbnail($width, $height, $file, $thumbPath, $prefix = 'T-')
    {
        $location = explode('/',$file);
        $name  = $prefix.$width.'-'.$height.'-'.array_pop($location);
        $fileLocation = self::thumbnailLocation($thumbPath).$name;
        if(!file_exists($fileLocation)):
            self::makeThumbnail($width,$height,$file,$fileLocation);
        endif;
        return route('image.thumbs',$name);
    }

    /**
     * @param null $location
     * @return null|string
     */
    public static function thumbnailLocation($location = null)
    {
        return is_null($location) ? self::$THUMB_PATH : $location;
    }


    /**
     * @param $width
     * @param $height
     * @param $file
     * @param $thumbName
     */
    private static function makeThumbnail($width, $height, $file, $thumbName)
    {
        $img = Image::make($file);
        
        $wh = self::getRatio($width,$height,$img);

        $img->resize($wh['width'],$wh['height'])->crop($width,$height,$wh['cropX'],$wh['cropY'])->save($thumbName);
    }

    /**
     * @param $width
     * @param $height
     * @param $file
     * @return array
     */
    private static function getRatio($width, $height, $file)
    {
        $sourceWidth = $file->width();
        $sourceHeight = $file->height();

        $targetWidth = $width;
        $targetHeight = $height;

        $sourceRatio = $sourceWidth / $sourceHeight;
        $targetRatio = $targetWidth / $targetHeight;

        if ( $sourceRatio < $targetRatio ) {
            $scale = $sourceWidth / $targetWidth;
        } else {
            $scale = $sourceHeight / $targetHeight;
        }

        $resizeWidth = (int)($sourceWidth / $scale);
        $resizeHeight = (int)($sourceHeight / $scale);

        $cropTop = (int)(($resizeHeight - $targetHeight) / 2);
        $cropLeft = (int)(($resizeWidth - $targetWidth) / 2);

        return ['height'=>$resizeHeight,'width'=>$resizeWidth,'cropX'=>$cropLeft,'cropY'=>$cropTop];
    }

    /**
     * @param null $location
     */
    public static function clear($location = null)
    {
        $location = is_null($location) ? self::$THUMB_PATH : $location;

        $files = glob($location); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
    }

    /**
     * @param $file
     */
    public static function remove($file)
    {
        if(file_exists($file)){
            unlink($file);
        }
    }

    public static function resize($width, $height, $file, $thumbPath, $prefix = 'T-')
    {
        $location = explode('/',$file);
        $name  = $prefix.$width.'-'.$height.'-'.array_pop($location);
        $fileLocation = self::thumbnailLocation($thumbPath).$name;
        if(!file_exists($fileLocation)):
            if(($width==null && $height==null) || $file==null) return;

            // create instance
            $img = Image::make($file);

            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($fileLocation);
        endif;

        return route('image.thumbs', $name);
    }
}