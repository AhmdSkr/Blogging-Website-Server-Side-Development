<?php

namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class SimpleFileCollectionService implements FileCollectionService
{
    /**
     * uploads file to a file server.
     * @param $file the file to upload.
     * @param $filenamePrefix prefix of 
     */
    public function upload($file, $filenamePrefix = ""): string|bool
    {
        $name = uniqid($filenamePrefix,true);
        $extension = $file->getClientOriginalExtension();
        $filename = implode('.',[$name,$extension]);
        $path = $file->getMimeType();
        
        if ($file->storeAs($path, $filename) === false)
        {
            return false;
        }
        $url = implode('/', [env('APP_URL'), $path, urlencode($filename)]);
        
        /*LOGGING*/
        {
            $message = "File of mimetype='".$file->getMimeType()."'\nname='".$file->getClientOriginalName()."'\nuploaded and found @ URL='".$url."'.";
            logger($message);
        }

        return $url;
    }

    /**
     * removes file located at `$url`.
     * @param $url file locator
     * @return bool if removed successfully `true`, otherwise `false`
     */
    public function remove($url): bool
    {
        if(!$this->isSupportedUrl($url))
        {
            throw new Exception("An unsupported Url has been passed to ".SimpleFileCollectionService::class);
        }
        $path = parse_url($url, PHP_URL_PATH);
        return Storage::exists($path) ? Storage::delete($path) : false;
    }

    public function isSupportedUrl($url)
    {
        $url = parse_url($url);
        $expected = parse_url(env('APP_URL'));
        return $url['scheme'] === $expected['scheme']
            && $url['host'] === $expected['host']
            && $url['port'] === $expected['port'];
    }

}
