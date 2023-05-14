<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Database\Query\JoinClause;

use App\Models\Persons;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function index(): View
    {   

        $data = Persons::getDataIndex();
        return view('person.index',['data' => $data]);
    }

    public function create(){
        return view('person.create');
    }

    public function store(Request $request){
        $req = collect($request->request);
        
        $person = $req->only(['name', 'gender', 'telephone','address',])->toArray();
        
        $id = Persons::insertGetId($person);

        $auto = $req->slice(5)->keyBy(function ($value, $key) {
                return str_replace('_', '.', $key);
        })->undot()->map(function($item, $key) use ($id){
            
            if(array_key_exists('inTheParking',$item)){
                $item['inTheParking'] = true;
            }
            else{
                $item['inTheParking'] = false;
            }
            $item['personId'] = $id;
            return $item;
        });
        $auto = $auto->toArray();
        AutomobilesController::create($auto);

        return redirect()->route('person.index');
    }

    public function edit(Request $request): View
    {
        $data = Persons::getDataEdit($request->person);

        $person = $data->map(function ($item, $key) {
            $item = collect($item);
            return $item->only(['id','name', 'gender', 'telephone','address',])->toArray();
        })->flatMap(function ($values) {
            return $values;
        });

        $autos = $data->map(function ($item, $key) {
            $item = collect($item);
            return $item->slice(5)->toArray();
        });

        return view('person.edit', ['person'=>$person->toArray()], ['autos'=>$autos->toArray()]);
    }

    public function update(Request $request){
        $req = collect($request->request);
        $autosId = AutomobilesController::getIdByPerson($request->person);

        $person = $req->only(['name', 'gender', 'telephone','address',])->toArray();
        Persons::updateById($request->person, $person);


        $auto = $req->slice(6)->keyBy(function ($value, $key) {
            return str_replace('_', '.', $key);
        })->undot()->map(function($item, $key) use ($autosId, $request){
            if(array_key_exists('inTheParking',$item)){
                $item['inTheParking'] = true;
            }
            else{
                $item['inTheParking'] = false;
            }


            if($autosId->contains('id', $key)){
                AutomobilesController::update($key, $item);
            }
            else{
                $item['personId'] = $request->person;
                AutomobilesController::create($item);
            }
            return $item;
        });
        return redirect()->route('person.index');
    }

    public function destroy(Request $request){

        $personID = AutomobilesController::getPersonIdByAutoId($request->auto);

        $countAuto = AutomobilesController::getCountAutoByPersonId($personID->personId);

        AutomobilesController::delete($request->auto);
        
        if((int)$countAuto == 1){
            Persons::deleteById($personID->personId);
        }

        return back();;
    }

    public function cars(){
        $persons = Persons::getDataCars();

        $autosInParcking = AutomobilesController::getAutoInParking();

        $autos = AutomobilesController::getAutos();

        foreach($persons as $person){   
            $data[$person->id] = [];
            foreach($autos as $auto){
                if($person->id == $auto->personId){
                    array_push($data[$person->id], $auto);
                }
            }
        }
        
        return view('person.cars', ['data' => $data], ['persons' => $persons]);
    }
}
