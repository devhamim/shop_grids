<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public static $data,$image,$imageName,$directory,$imageUrl;

    public static function saveCategory($request)
    {
        self::$data = new Category();
        self::$data->name = $request->name;
        self::$data->description = $request->description;
        self::$data->status = $request->status;
        self::$data->image = self::saveImage($request);
        self::$data->save();
    }

    public static function updateCategory($request, $id)
    {
        self::$data = Category::find($id);
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

    public static function deleteCategory($id)
    {
        self::$data = Category::find($id);
        if (file_exists(self::$data->image))
        {
            unlink(self::$data->image);

        }
        self::$data->delete();

    }
    private static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageName = 'category-'.rand().'.'. self::$image->Extension();
        self::$directory = 'Uploaded_images/Category_image/';
        self::$imageUrl = self::$directory.self::$imageName;
        self::$image->move(self::$directory,self::$imageName);
        return self::$imageUrl;
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
