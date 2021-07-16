<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class Helper
{
    // Testing Helper Function
    public static function test()
    {
        return 'I\'m Working. I\'m class based helper!!!';
    }

    // Giving uploaded image a unique name and moving it to some folder
    public static function uniqueNameMoveDelete($file, $folder_path, $old_file_path)
    {
        $filenameWithExt = $file->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extension = $file->getClientOriginalExtension();

        $fileNameToStore = $filename . '_' . mt_rand(1000, 10000) . '.' . $extension;

        if (!empty($old_file_path)) {

            // Deleting file
            if (file_exists(public_path($old_file_path))) {

                unlink(public_path($old_file_path));

            }
        }

        $file->move(public_path("front-end/assets/images/{$folder_path}"), $fileNameToStore);

        $file_path = "front-end/assets/images/{$folder_path}/{$fileNameToStore}";

        return $file_path;
    }

    // Deleting the specified image from storage

    public static function imageDelete($file_path)
    {
        // Deleting file
        if (file_exists(public_path($file_path))) {

            unlink(public_path($file_path));

            return true;

        } else {

            return false;
        }
    }

    public static function moveFile($file)
    {
        $extension = $file->getClientOriginalExtension();

        $fileNameToStore = time() . '_' . mt_rand(1000, 10000) . '.' . $extension;

        $file->move(public_path("uploads"), $fileNameToStore);

        $file_path = "uploads/{$fileNameToStore}";

        return $file_path;
    }

    public static function moveFileAndDeleteOld($file, $old_file)
    {
        File::delete($old_file);

        return self::moveFile($file);
    }

    public static function deleteFile($file_path)
    {
        return File::delete($file_path);
    }

}
