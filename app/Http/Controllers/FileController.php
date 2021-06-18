<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // 必須要 ↓ 才能被呼叫    傳值方式 ↓
    public static function imgUpload($file)
    {
        // 如果上傳檔案資料夾不存在
        if (!is_dir('upload/')) {
            // 創一個上傳的資料夾(在public內)
            mkdir('upload/');
        }
        // 會先變成tmp檔但是要取得正確的副檔名
        $extenstion = $file->getClientOriginalExtension();
        // 新檔名 = 亂數.副檔名
        $filename = md5(uniqid(rand())) . '.' . $extenstion;
        $path = '/upload/' . $filename;

                  // 存什麼檔 ↓    ↓ 存到哪裡去(不寫死) ↓ 的資料夾的副檔名
        move_uploaded_file($file, public_path() . $path);
    
        return $path;
    }

}
