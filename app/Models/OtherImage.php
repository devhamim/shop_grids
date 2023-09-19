<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherImage extends Model
{
    use HasFactory;
    public static $data,$image,$imageName,$directory,$imageUrl,$otherImages;

    public static function newOtherImage($request, $id)
    {

        foreach ($request->other_images as $other_image) {

            self::$data = new OtherImage();
            self::$data->product_id = $id;
            self::$data->image = self::saveImage($other_image);
            self::$data->save();
        }
    }

    public static function updateOtherImage($request, $id)
    {
//        self::$otherImages = OtherImage::where('product_id',$id)->get();
//        foreach (self::$otherImages as $image) {
//
//            if(file_exists($image->image)){
//                unlink($image->image);
//            }
//            $image->delete();
//        }
        self::deleteOtherImage($id);
        self::newOtherImage($request, $id);


    }

    public static function deleteOtherImage($id)
    {
        self::$otherImages = OtherImage::where('product_id',$id)->get();
        foreach (self::$otherImages as $image) {

            if(file_exists($image->image)){
                unlink($image->image);
            }
            $image->delete();
        }
    }
    private static function saveImage($image){
        self::$imageName = 'other-'.rand().'.'. $image->Extension();
        self::$directory = 'Uploaded_images/Product_other_image/';
        self::$imageUrl = self::$directory.self::$imageName;
        $image->move(self::$directory,self::$imageName);
        return self::$imageUrl;
    }
}
