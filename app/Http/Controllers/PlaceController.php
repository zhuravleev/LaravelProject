<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);

        $place = new Place();
        $place->name = request('name');
        $place->description = request('description');
        $place->repair = false;
        $place->work = false; 
        $place->save();

        return response()->json([
            'place' => $place
        ], 201);

    }

    public function delete($id){
        return response(Place::findOrFail($id)->delete());
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'repair'=>'required',
            'work'=>'required'
        ]);

        $place = Place::findOrFail($id);
        $place->name = request('name');
        $place->description = request('description');
        $place->repair = request('repair');
        $place->work = request('work');
        $place->save();

        return response()->json([
            'place' => $place
        ], 201);
    }


    public function show(){
        $places=Place::take(PHP_INT_MAX)->get();
        return response()->json(['places'=>$places]);
    }
}
