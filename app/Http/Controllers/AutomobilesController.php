<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Database\Query\JoinClause;

use App\Models\Automobile;
use Illuminate\Http\Request;

class AutomobilesController extends Controller
{

    public static function create($auto){
        Automobile::insertAuto($auto);
    }

    public static function getIdByPerson($person){
        return Automobile::getIdByPerson($person)->map(function($item, $key){
            return (array)$item;
        });
    }

    public static function update($key, $item){
        Automobile::updateById($key, $item);
    }

    public static function getPersonIdByAutoId($auto){
        return Automobile::getPersonIdByAutoId($auto);
    }

    public static function getCountAutoByPersonId($personId){
        return Automobile::getCountAutoByPersonId($personId);
    }
    public static function delete($auto){
        Automobile::deleteById($auto);
    }
    public static function getAutoInParking(){
        return Automobile::getAutoInParking();
    }

    public static function getAutos(){
        return Automobile::getAutos();
    }
}
