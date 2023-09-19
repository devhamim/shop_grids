<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public static $data;

    public static function saveUnit($request)
    {
        self::$data = new Unit();
        self::$data->name = $request->name;
        self::$data->code = $request->code;
        self::$data->description = $request->description;
        self::$data->status = $request->status;
        self::$data->save();
    }

    public static function updateUnit($request, $id)
    {
        self::$data = Unit::find($id);
        self::$data->name = $request->name;
        self::$data->code = $request->code;
        self::$data->description = $request->description;
        self::$data->status = $request->status;
        self::$data->save();
    }

    public static function deleteUnit($id)
    {
        self::$data = Unit::find($id);
        self::$data->delete();

    }
}
