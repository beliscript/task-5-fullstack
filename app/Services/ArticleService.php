<?php

namespace App\Services;

/**
 * Class ArticleService.
 */
class ArticleService
{
    public static function insertImage($request) {
        $filename = "";
        if($request->file('image')){
            $file= $request->file('image');
            $filename= time().date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }
        return $filename;
    }
}