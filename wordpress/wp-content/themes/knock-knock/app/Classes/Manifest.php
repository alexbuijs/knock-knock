<?php 

namespace App\Classes;

use Illuminate\Filesystem\Filesystem;

class Manifest 
{
    // TODO: make class persistant so it doesn't have to do this on every call to getAsset
    public static function getAsset($assetName) 
    {
        $filesystem = new Filesystem();

        $manifestPath = get_template_directory() . '/dist/manifest.json';
    
        $manifest = json_decode($filesystem->get($manifestPath), true);
    
        return get_template_directory_uri() . '/dist/' . ($manifest[$assetName] ?? $assetName);    
    }
}