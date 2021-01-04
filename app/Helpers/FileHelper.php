<?php
namespace App\Helpers;
use Illuminate\Http\File;

use Storage;
use Image;

class FileHelper

{
    /*
    * ディレクトリの有無を確認し、作成する
    */
    public static function addDirectory($directory, $mod)
    {
        //ディレクトリの有無を確認
        if (!Storage::exists($directory)) {
            //ディレクトリを作成
            Storage::makeDirectory($directory, $mod, true);
        }
    }
    /**
    * ファイルをリサイズし保存する
    */
    public static function storeResizeImg($file, $file_path, $file_name, $width, $height)
    {
        $org_img = Image::make($file);

        $org_img = $org_img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $org_img->save();

        // Save and Get public local Url
        return self::storeFileFromPath($file_path, $file, $file_name);
    }

    public static function storeFileFromPath($filepath, $photo, $file_name)
    {
        //Upload local storage
        Storage::putFileAs($filepath, new File($photo), $file_name);
        //Get public local Url
        return Storage::url($filepath.$file_name);
    }

    public static function makeUniqFileName($ext, $path)
    {
        $file_name = '';
        while (1) {
            $file_name = sha1(rand().microtime()).'.'.$ext;
            if (!Storage::exists($path. $file_name)) {
                break;
            }
        }
        return $file_name;
    }
}
