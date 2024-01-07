<?php

use Illuminate\Support\Facades\Storage;

//hàm tái sử dụng upload ảnh
if (!function_exists('upload_file')) {
    function upload_file($folder, $file)
    {
        return 'storage/' . Storage::put($folder, $file);
    }

}


//hàm tái sử dụng xóa ảnh
if (!function_exists('delete_file')) {
    function delete_file($pathFile)
    {
        $pathFile = str_replace('storage/', '', $pathFile);
        return Storage::exists($pathFile) ? Storage::delete($pathFile) : null;
    }
}