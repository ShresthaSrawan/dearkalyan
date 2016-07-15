<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\FileHelper;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends Model
{
    const THUMB_PATH = "images/thumbs/";
    const IMAGE_PATH = "images/uploaded";
    const DEFAULT_THUMB = "/images/avatar_user.png";
    protected $fillable = ['path'];
    protected $appends = ['thumbnail'];

    /**
     * @param $image
     */
    public function setPath($image)
    {
        if ($image instanceof UploadedFile && $image->isValid()) {
            $this->removeImage();
            $this->path = FileHelper::upload($image, $this->image_path);
            $this->save();
        }
    }

    /**
     * Remove Image File Function
     */
    public function removeImage()
    {
        if (!is_null($this->path) && file_exists($this->path) && $this->path != "") {
            Storage::delete($this->path);
        }
    }

    /**
     * @param UploadedFile
     */
    public function upload($image)
    {
        if ($image instanceof UploadedFile && $image->isValid()) {
            $this->path = FileHelper::upload($image, $this->image_path);
        }
    }

    /**
     * @param int $w
     * @param int $h
     * @return string
     */
    public function resize($w = null, $h = null)
    {
        if (is_null($this->path) || $this->path == "" || !file_exists($this->path)) {
            return self::DEFAULT_THUMB;
        } else {
            return FileHelper::resize($w, $h, $this->path, self::THUMB_PATH, '_');
        }
    }

    /**
     * @return mixed
     */
    public function getImagePathAttribute()
    {
        $class = $this->imageable_type;
        if ($class == "" or is_null($class)) return self::IMAGE_PATH;
        return $class::IMAGE_PATH;
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return $this->thumbnail();
    }

    /**
     * @param int $w
     * @param int $h
     * @return string
     */
    public function thumbnail($w = 150, $h = 150)
    {
        if (is_null($this->path) || $this->path == "" || !file_exists($this->path)) {
            return self::DEFAULT_THUMB;
        } else {
            return FileHelper::getThumbnail($w, $h, $this->path, self::THUMB_PATH, '_');
        }
    }

    /**
     * @param array $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(array $options = array())
    {
        $this->removeImage();
        return parent::delete($options);
    }
}
