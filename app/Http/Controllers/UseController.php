<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UseModel;

class UseController extends Controller
{
    public function give(Request $request, $thing_id, $to_id){
        $user_id=auth()->user()->id;
        $use = UseModel::where('thing_id', $thing_id)->where('user_id', $user_id)->get();
        if(count($use)){
            $id=$use[0]->id; 
            $useold=UseModel::findOrFail($id);
            if($useold->amount>1){
                $useold->amount=$useold->amount-1;
                $useold->save();
                $useto = UseModel::where('thing_id', $thing_id)->where('user_id', $to_id)->get();
                if (count($useto)){
                    $usetoid=$useto[0]->id;
                    $usetonew=UseModel::findOrFail($usetoid);
                    $usetonew->amount=$usetonew->amount+1; 
                    $usetonew->save();
                    return response('Success');
                }
                else{
                    $usenew = new UseModel();
                    $usenew->thing_id= $thing_id;
                    $usenew->user_id= $to_id;
                    $usenew->place_id= 1;
                    $usenew->amount=1;
                    $usenew->save();
                    return response('Success');
                }
            }
            else{
                $useold->delete();
                $useto = UseModel::where('thing_id', $thing_id)->where('user_id', $to_id)->get();
                if (count($useto)){
                    $usetoid=$useto[0]->id;
                    $usetonew=UseModel::findOrFail($usetoid);
                    $usetonew->amount=$usetonew->amount+1; 
                    $usetonew->save();
                    return response('Success');
                }
                else{
                    $usenew = new UseModel();
                    $usenew->thing_id= $thing_id;
                    $usenew->user_id= $to_id;
                    $usenew->place_id= 1;
                    $usenew->amount=1;
                    $usenew->save();
                    return response('Success');
                }
            }
        }
        else{
            return response('Такой вещи нет или она вам не принадлежит');
        }
    }

    public function update(Request $request, $id){
        $use = UseModel::findOrFail($id);
        $use->place_id=request('place_id'); 
        $use->save();
        return response()->json(['use' => $use]);
    }
}
