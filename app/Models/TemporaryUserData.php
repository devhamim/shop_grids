<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryUserData extends Model
{
    use HasFactory;
    private static $data;
    public static function newUser($id,$name)
    {
//        dd($id);
        self::$data = new TemporaryUserData();
        self::$data->user_id = $id;
        self::$data->user_name = $name;
        self::$data->save();
    }
}
