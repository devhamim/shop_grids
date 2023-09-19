<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public static $data,$image,$imageName,$directory,$imageUrl;

    public static function newProduct($request)
    {
        self::$data = new Product();
        self::$data->category_id = $request->category_id;
        self::$data->sub_category_id = $request->sub_category_id;
        self::$data->brand_id = $request->brand_id;
        self::$data->unit_id = $request->unit_id;
        self::$data->name = $request->name;
        self::$data->code  = $request->code ;
        self::$data->model  = $request->model ;
        self::$data->stock_amount  = $request->stock_amount ;
        self::$data->regular_price  = $request->regular_price ;
        self::$data->selling_price  = $request->selling_price ;
        self::$data->short_description  = $request->short_description ;
        self::$data->long_description = $request->long_description;
        self::$data->status = $request->status;
        self::$data->image = self::saveImage($request);
        self::$data->save();
        return self::$data;
    }

    public static function updateProduct($request, $id)
    {
        self::$data = Product::find($id);
        self::$data->category_id = $request->category_id;
        self::$data->sub_category_id = $request->sub_category_id;
        self::$data->brand_id = $request->brand_id;
        self::$data->unit_id = $request->unit_id;
        self::$data->name = $request->name;
        self::$data->code  = $request->code ;
        self::$data->model  = $request->model ;
        self::$data->stock_amount  = $request->stock_amount ;
        self::$data->regular_price  = $request->regular_price ;
        self::$data->selling_price  = $request->selling_price ;
        self::$data->short_description  = $request->short_description ;
        self::$data->long_description = $request->long_description;
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
        return self::$data;
    }

    public static function deleteProduct($id)
    {
        self::$data = Product::find($id);
        if (file_exists(self::$data->image))
        {
            unlink(self::$data->image);

        }
        self::$data->delete();

    }
    private static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageName = 'product-'.rand().'.'. self::$image->Extension();
        self::$directory = 'Uploaded_images/Product_image/';
        self::$imageUrl = self::$directory.self::$imageName;
        self::$image->move(self::$directory,self::$imageName);
        return self::$imageUrl;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function otherImages()
    {
        return $this->hasMany(OtherImage::class);
    }

}
