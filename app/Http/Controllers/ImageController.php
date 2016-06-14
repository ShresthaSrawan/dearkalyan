<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;
use App\Http\Requests;

class ImageController extends Controller
{
    const IMAGE_PATH = 'images/';

    const THUMBNAIL_PATH = 'images/thumbs/';

    private $request;
    private $mimes = [
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpg',
        'gif' => 'image/gif',
    ];

    /**
     * ImageController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $file
     * @param string $path
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function thumbnail($file, $path = self::THUMBNAIL_PATH)
    {
        $prop = explode('.',$file);
        $ext = strtolower(end($prop));
        $mime = array_key_exists($ext,$this->mimes) ? $this->mimes[$ext] : FALSE;

        if(FALSE == $mime || FALSE == file_exists($path)) abort(404, 'Resource not found');

        return $this->getImage($path.$file,$mime);
    }

    /**
     * @param $file
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function image($file)
    {
        $prop = explode('.',$file);
        $ext = strtolower(end($prop));
        $mime = array_key_exists($ext,$this->mimes) ? $this->mimes[$ext] : FALSE;

        $path = self::IMAGE_PATH.$file;
        
        if(FALSE == $mime || FALSE == file_exists($path)) abort(404, 'Resource not found');

        return $this->getImage($path,$mime);
    }

    /**
     * @param $path
     * @param $mime
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function getImage($path, $mime){
        $request = $this->request;

        $size = filesize($path);
        $file = file_get_contents($path);
        $headers = [
            'Content-Type' => $mime,
            'Content-Length' => $size
        ];

        $response = response( $file, 200, $headers );
        $fileTime = filemtime($path);
        $etag = md5($fileTime);
        $time = date('r', $fileTime);
        $expires = date('r', $fileTime + 3600);

        $response->setEtag($etag);
        $response->setLastModified(new DateTime($time));
        $response->setExpires(new DateTime($expires));
        $response->setPublic();
        
        if($response->isNotModified($request)) return $response;
        return $response->prepare($request);
    }
}