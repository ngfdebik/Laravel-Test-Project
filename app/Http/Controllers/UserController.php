<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\AutomobileResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::getDataIndex();
        return view('user.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $req = collect($request->all());

        $user = $req->only(['name', 'gender', 'telephone','address',])->toArray();

        $id = User::insertGetId($user);

        $auto = $req->except(['_token', 'name', 'gender', 'telephone','address',])
                    ->keyBy(function ($value, $key) {
                        return str_replace('_', '.', $key);
                    })
                    ->undot()
                    ->map(function($item, $key) use ($id){
                        $item['user_id'] = $id;
                        $item['inTheParking'] = array_key_exists('inTheParking', $item);
                        return $item;
                    })
                    ->toArray();
        
        AutomobilesController::create($auto);

        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::getDataEdit($id)->toArray();

        $content = json_decode(json_encode(UserResource::collection($data)));

        $user = $content[0];
        //dd($user);
        $autos = json_decode(json_encode(AutomobileResource::collection($data)));
        //dd($autos);
        return view('user.edit', ['user'=>$user, 'autos'=>$autos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $req = collect($request->all());
        $autosId = AutomobilesController::getIdByPerson($id);
        $user = $req->only(['name', 'gender', 'telephone','address',]);

        $autos = $req->except(['_token','_method', 'name', 'gender', 'telephone','address',])
                    ->keyBy(function ($value, $key) {
                        return str_replace('_', '.', $key);
                    })
                    ->undot()
                    ->map(function($item, $key) use ($id, $autosId){
                        $item['user_id'] = $id;
                        $item['inTheParking'] = array_key_exists('inTheParking', $item);

                        $autosId->contains('id', $key) ? (AutomobilesController::update($key, $item)) : (AutomobilesController::create($item));
                    })
                    ->toArray();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = AutomobilesController::getPersonIdByAutoId($id);

        AutomobilesController::delete($id);

        if(!(bool)AutomobilesController::getCountAutoByPersonId($userId->user_id)){
            User::deleteById($userId->user_id);
        }

        return redirect()->route('user.index');
    }
}
