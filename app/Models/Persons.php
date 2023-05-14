<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persons extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'id', 'name', 'gender',
        'telephone','address',
    ];
    protected $updated_at = true;
    protected $created_at = true;

    public static function getDataIndex(){
        return DB::table('persons AS per')
            ->select(['per.id', 'per.name',
                      'auto.brand', 'auto.id AS auto_id'])
            ->join('automobiles AS auto', 'per.id', '=', 'auto.personId')
            ->orderBy('per.id','asc')
            ->paginate(4);
    }

    public static function getDataEdit($person){
        return DB::table('persons AS per')
            ->select(['per.id', 'per.name', 'per.gender', 'per.telephone', 'per.address',
                       'auto.id AS auto_id','auto.brand', 'auto.model', 'auto.color', 'auto.stateNumberRF', 'auto.inTheParking'])
            ->join('automobiles AS auto', 'auto.personId', 'per.id')
            ->where('per.id', '=' , $person)
            ->get();
    }

    public static function getDataCars(){
        return DB::table('persons')
        ->select(['id', 'name'])
        ->get();
    }

    public static function getRandomUserId(){
        return DB::table('persons')
                ->select('id')
                ->inRandomOrder()
                ->first();
    }

    public static function insertGetId($person){
        return DB::table('persons')->insertGetId($person);
    }

    public static function updateById($person, $data){
        DB::table('automobiles')
        ->where('id', $person)
        ->update($data);
    }

    public static function deleteById($person){
        DB::table('persons')
            ->where('id', $person)
            ->delete();
    }

}
