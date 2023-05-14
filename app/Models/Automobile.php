<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automobile extends Model
{
    use HasFactory;

    protected $updated_at = true;
    protected $created_at = true;

    public static function getAutos(){
        return DB::table('automobiles')
            ->get();
    }

    public static function getIdByPerson($person){
        return DB::table('automobiles')
        ->select('id')
        ->where('personId', $person)
        ->get();
    }

    public static function getPersonIdByAutoId($auto){
        return DB::table('automobiles')
        ->select('personId')
        ->where('id', $auto)
        ->first();
    }

    public static function getCountAutoByPersonId($personId){
        return DB::table('automobiles')
        ->where('personId', $personId)
        ->get()
        ->count('*');
    }

    public static function getAutoInParking(){
        return DB::table('automobiles')
        ->select(['id','brand', 'model', 'color', 'stateNumberRF', 'inTheParking','personId'])
        ->where('inTheParking', 1)
        ->get();
    }

    public static function insertAuto($automobiles){
        DB::table('automobiles')->insert($automobiles);
    }

    public static function updateById($auto, $data){
        DB::table('automobiles')
        ->where('id', $auto)
        ->update($data);
    }
    
    
    public static function deleteById($auto){
        DB::table('automobiles')
        ->where('id', $auto)
        ->delete();
    }

}
