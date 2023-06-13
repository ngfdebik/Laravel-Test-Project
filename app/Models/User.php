<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'gender',
        'telephone','address',
    ];

    public static function getDataIndex(){
        return DB::table('users AS u')
            ->select(['u.id', 'u.name',
                      'auto.brand', 'auto.id AS auto_id'])
            ->join('automobiles AS auto', 'u.id', '=', 'auto.user_id')
            ->orderBy('u.id','asc')
            ->paginate(4);
    }

    public static function getDataEdit($person){
        return DB::table('users AS u')
            ->select(['u.id', 'u.name', 'u.gender', 'u.telephone', 'u.address',
                       'auto.id AS auto_id','auto.brand', 'auto.model', 'auto.color', 'auto.stateNumberRF', 'auto.inTheParking'])
            ->join('automobiles AS auto', 'auto.user_id', 'u.id')
            ->where('u.id', '=' , $person)
            ->get();
    }

    public static function getDataCars(){
        return DB::table('users')
        ->select(['id', 'name'])
        ->get();
    }

    public static function getRandomUserId(){
        return DB::table('users')
                ->select('id')
                ->inRandomOrder()
                ->first();
    }

    public static function insertGetId($person){
        return DB::table('users')->insertGetId($person);
    }

    public static function updateById($person, $data){
        DB::table('users')
        ->where('id', $person)
        ->update($data);
    }

    public static function deleteById($person){
        DB::table('users')
            ->where('id', $person)
            ->delete();
    }


}
