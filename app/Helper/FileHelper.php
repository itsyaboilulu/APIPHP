<?php

namespace App\Helper;


class FileHelper {
    public $storageDirectory = '../../storage';

    public static function store($file, $destination, $fileName) {
        try {
            file_put_contents(
                self::$storageDirectory . '/' . $destination . '/' . $fileName,
                $file
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public static function get($dest){
       return file_get_contents( self::$storageDirectory . '/' . $dest );
    }
}