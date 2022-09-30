<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simcard;
use App\Models\SimcardsAsignada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsignaController extends Controller
{
    public function asignarBodega(Request $request)
    {
        $texto=trim($request->get('texto'));
        $simcards = DB::table('simcards')
            ->join('users','simcards.id_userAsignado','=','users.id')
            ->select('simcards.id','simcards.linea','simcards.id_userAsignado','simcards.estado','users.name')
            ->where('estado',0)
            ->where('simcards.id_userAsignado',1)
            ->where('simcards.id','LIKE','%'.$texto.'%')
            ->orderBy('simcards.id','asc')
            ->paginate(100000000000000);
        return view('asignacion.asignarbodega', compact('simcards','texto'));

    }

    public function asignadoBodega(Request $request)
    {
        $asignars = $request->asignando;

        foreach ($asignars as $asignar){
            Simcard::where('id',$asignar)->update(['id_userAsignado'=>3]);
        }
        // $id = Auth::id();
        // $idsimcard=$request->input($asignar);
        // $simcards=Simcard::findOrFail($idsimcard);
        // $simcards->estado=0;
        // $simcards->save();
        return back();
    }


    public function estado(Request $request)
    {
        $texto=trim($request->get('texto'));
        $simcards = DB::table('simcards')
            ->join('users','simcards.id_userAsignado','=','users.id')
            ->select('simcards.estado','simcards.id','simcards.linea','users.name')
            ->where('simcards.estado','=','Activa')
            ->where('simcards.linea','LIKE','%'.$texto.'%')
            ->orderBy('simcards.id','desc')
            ->paginate(100000000000000);


        return view('asignacion.estadosim', compact('simcards','texto'));
    }

    public function estadobodega(Request $request)
    {
        $activars = $request->activado;



        foreach ($activars as $activar){
            Simcard::where('id',$activar)->update(['estado'=>'Inactiva','id_userAsignado'=>3]);
            SimcardsAsignada::where('estado','Activa')->where('id_simcard',$activar)->update(['estado'=>'Inactiva']);
        }
        return back();

    }
}
