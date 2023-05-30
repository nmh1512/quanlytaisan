<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Image;

trait UploadFileTrait
{
    public function uploadFile($file, $folderName, $width = 0, $height = 0)
    {
        // ten file
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = time() . '.' . $file->getClientOriginalExtension();

        $day = date('d');
        $month = date('m');
        $year = date('Y');
        // resize file
        if ($width == 0 && $height == 0) {
            // khi ko resize (ko truyen heigh va width)
            $filePath = $file->storeAs('public/' . $folderName . '/' . $year . '/' . $month . '/' . $day . '/' . $fileNameHash); // trả về path
        } else {

            // resize 
            $file = Image::make($file->path());
            $file->resize($width, $height, function ($const) {
                $const->aspectRatio();
            });
            $filePathOrigin = public_path('storage/' . $folderName . '/' . $year . '/' . $month . '/' . $day . '/' . $fileNameHash);
            // Lưu hình ảnh
            $file->save($filePathOrigin);
            // Lấy path
            $filePath = $folderName . '/' . $year . '/' . $month . '/' . $day . '/' . $fileNameHash;
        }
        $data = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        // return file name & file path
        return $data;
    }
}
