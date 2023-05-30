<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Image;

trait StorageUpload
{
    public function storageUpload($request, $fieldName, $folderName, $width = 0, $height = 0)
    {

        if (!$request->hasFile($fieldName)) {
            // ko co file thi return null
            return null;
        }
        
        $file = $request->$fieldName;

        // ten file
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();

        // resize file
        if ($width == 0 && $height == 0) {
            // khi ko resize (ko truyen heigh va width)
            $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
        } else {

            // resize 
            $file = Image::make($file->path());
            $file->resize($width, $height, function ($const) {
                $const->aspectRatio();
            });
            $filePathOrigin = public_path('storage/' . $folderName . '/' . auth()->id() . '/' . $fileNameHash);
            // Lưu hình ảnh
            $file->save($filePathOrigin);
            // Cấp quyền truy cập cho tệp tin
            $filePath = $folderName . '/' . auth()->id() . '/' . $fileNameHash;
        }
        $data = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        // return file name & file path
        return $data;
    }
    public function storageUploadMulti($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);

        $data = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];

        return $data;
    }
}
