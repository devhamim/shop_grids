<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public static $data,$image,$imageName,$directory,$imageUrl;

    public static function saveSubCategory($request)
    {
        self::$data = new SubCategory();
        self::$data->category_id = $request->category_id;
        self::$data->name = $request->name;
        self::$data->description = $request->description;
        self::$data->status = $request->status;
        self::$data->image = self::saveImage($request);
        self::$data->save();
    }

    public static function updateSubCategory($request, $id)
    {
        self::$data = SubCategory::find($id);
        self::$data->category_id = $request->category_id;
        self::$data->name = $request->name;
        self::$data->description = $request->description;
        self::$data->status = $request->status;
        if ($request->file('image')){
            if (file_exists(self::$data->image))
            {
                unlink(self::$data->image);

            }
            self::$data->image = self::saveImage($request);
        }
        else{
            self::$data->image = self::$data->image;
        }

        self::$data->save();
    }

    public static function deleteSubCategory($id)
    {
        self::$data = SubCategory::find($id);
        if (file_exists(self::$data->image))
        {
            unlink(self::$data->image);

        }
        self::$data->delete();

    }
    private static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageName = 'sub_category-'.rand().'.'. self::$image->Extension();
        self::$directory = 'Uploaded_images/Sub_category_image/';
        self::$imageUrl = self::$directory.self::$imageName;
        self::$image->move(self::$directory,self::$imageName);
        return self::$imageUrl;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
