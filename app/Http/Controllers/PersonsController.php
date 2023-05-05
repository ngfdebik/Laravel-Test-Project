<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Database\Query\JoinClause;

use App\Models\Persons;
use App\Models\Automobile;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function index(): View
    {   
        $data = DB::table('persons AS per')
            ->select(['per.id', 'per.name',
                      'auto.brand', 'auto.id AS auto_id'])
            ->join('automobiles AS auto', 'per.id', '=', 'auto.person_id')
            ->orderBy('per.id','asc')
            ->paginate(4);
        

        return view('person.index',['data' => $data]);
    }

    public function create(){
        return view('person.create');
    }

    public function store(Request $request){
        $automobiles['brand'] = $request->brand;;
        $automobiles['model'] = $request->model;
        $automobiles['color'] = $request->color;
        $automobiles['state_number_RF'] = $request->state_number_RF;
        for($i = 0, $j = 0; $i < count($request->id); $i++)
            if($j < count(($request->in_the_parking ? $request->in_the_parking : [])) &&
                $request->in_the_parking[$j] == $request->id[$i]){
                $automobiles['in_the_parking'][$i] = true;
                $j++;
            }
            else{
                $automobiles['in_the_parking'][$i] = false;
            }


        $person = $request->validate([
            'name' => 'string',
            'gender' => 'string',
            'telephone' => 'string',
            'address' => 'string',
        ]);

        $id = DB::table('persons')->insertGetId($person);

        for($i = 0; $i < count($automobiles['brand']); $i++){
            DB::table('automobiles')->insert([
                'brand' =>  $automobiles['brand'][$i],
                'model' =>  $automobiles['model'][$i],
                'color' =>  $automobiles['color'][$i],
                'state_number_RF' =>  $automobiles['state_number_RF'][$i],
                'in_the_parking' => $automobiles['in_the_parking'][$i],
                'person_id' => $id,
            ]);
        }

        return redirect()->route('person.index');
    }

    public function edit(Request $request): View
    {
        $data = DB::table('persons AS per')
            ->select(['per.id', 'per.name', 'per.gender', 'per.telephone', 'per.address',
                       'auto.id AS auto_id','auto.brand', 'auto.model', 'auto.color', 'auto.state_number_RF', 'auto.in_the_parking'])
            ->join('automobiles AS auto', 'auto.person_id', 'per.id')
            ->where('per.id', '=' , $request->person)
            ->get();


        $person['id'] = $data[0]->id;
        $person['name'] = $data[0]->name;
        $person['gender'] = $data[0]->gender;
        $person['telephone'] = $data[0]->telephone;
        $person['address'] = $data[0]->address;

        foreach($data as $content)
            unset($content->id, $content->name, $content->gender, $content->telephone, $content->address);
        

        return view('person.edit', ['person' => $person], ['autos'=>$data]);
    }

    public function update(Request $request){
        dump($request);
        $person = $request->validate([
            'name' => 'string',
            'gender' => 'string',
            'telephone' => 'string',
            'address' => 'string',
        ]);

        $autos['brand'] = $request->brand;
        $autos['model'] = $request->model;
        $autos['color'] = $request->color;
        $autos['state_number_RF'] = $request->state_number_RF;

       
        
        $automobiles = array_merge($request->old, ($request->new ? $request->new : []));
        $autosFlag = array_merge(($request->in_the_parking ? $request->in_the_parking : []),
                                 ($request->in_the_parking_new ? $request->in_the_parking_new : []));
        
        $countFlag = count($autosFlag);
        $countAuto = count($automobiles);

        for($i = 0, $j = 0; $i < $countAuto; $i++){
            if($i < count($request->old)){
                if($j < $countFlag && $autosFlag[$j] == $automobiles[$i]){
                    $autos['in_the_parking'][$i] = true;
                    $j++;
                }
                else{
                    $autos['in_the_parking'][$i] = false;
                }
            }
            else if($i < $countAuto){
                if($j < $countFlag && $autosFlag[$j] == $automobiles[$i]){
                    $autos['in_the_parking'][$i] = true;
                    $j++;
                }
                else{
                    $autos['in_the_parking'][$i] = false;
                }
            }
        }


        for($i = 0, $j = 0; $i < $countAuto; $i++){
            if($i < count($request->old)){
                DB::table('automobiles')
                ->where('id', $request->old[$i])
                ->update([
                    'brand' =>  $autos['brand'][$i],
                    'model' =>  $autos['model'][$i],
                    'color' =>  $autos['color'][$i],
                    'state_number_RF' =>  $autos['state_number_RF'][$i],
                    'in_the_parking' => $autos['in_the_parking'][$i],
                    'person_id' => $request->person,
                ]);
            }
            else if($i < $countAuto){
                DB::table('automobiles')
                ->insert([
                    'brand' =>  $autos['brand'][$i],
                    'model' =>  $autos['model'][$i],
                    'color' =>  $autos['color'][$i],
                    'state_number_RF' =>  $autos['state_number_RF'][$i],
                    'in_the_parking' => $autos['in_the_parking'][$i],
                    'person_id' => $request->person,
                ]);
            }
        }
        
        return redirect()->route('person.index');
    }

    public function destroy(Request $request){

        $personID = DB::table('automobiles')
        ->select('person_id')
        ->where('id', $request->auto)
        ->get();


        $countAuto = DB::table('automobiles')
        ->where('person_id', $personID[0]->person_id)
        ->get()
        ->count('*');


        DB::table('automobiles')
        ->where('id', $request->auto)
        ->delete();


        if((int)$countAuto == 1){
            DB::table('persons')
            ->where('id', $personID[0]->person_id)
            ->delete();
        }

        return redirect()->route('person.index');
    }

    public function cars(){
        $persons = DB::table('persons')
        ->select(['id', 'name'])
        ->get();


        $autosInParcking = DB::table('automobiles')
            ->select(['id','brand', 'model', 'color', 'state_number_RF', 'in_the_parking','person_id'])
            ->where('in_the_parking', 1)
            ->get();

        $autos = DB::table('automobiles')
            ->get();

        foreach($persons as $person){   
            $data[$person->id] = [];
            foreach($autos as $auto){
                if($person->id == $auto->person_id){
                    array_push($data[$person->id], $auto);
                }
            }
        }
        
        
        return view('person.cars', ['data' => $data], ['persons' => $persons]);
    }
}
