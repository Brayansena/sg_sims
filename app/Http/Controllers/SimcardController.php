<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Operadore;
use App\Models\Simcard;
use App\Exports\SimcardExport;
use App\Imports\SimcardImport;
use Maatwebsite\Excel\Facades\Excel;
/**
 * Class SimcardController
 * @package App\Http\Controllers
 */
class SimcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texto=trim($request->get('texto'));
        $simcards = DB::table('simcards')
            ->join('users','simcards.id_userAsignado','=','users.id')
            ->select('simcards.id','simcards.linea','simcards.apn','simcards.usuario','simcards.clave','simcards.planAsignado','simcards.fechaCorte','simcards.estado','simcards.id_userAsignado','simcards.operador','simcards.id_userCreador','users.name','simcards.updated_at')
            ->where('simcards.id','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(100000000000);

        return view('simcard.index', compact('simcards','texto'))
            ->with('i', (request()->input('page', 1) - 1) * $simcards->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $simcard = new Simcard();
        $users=User::pluck('name','id');
        return view('simcard.create', compact('simcard','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $simcard = new Simcard;
        $idu = Auth::id();
        $simcard->id_userCreador=$idu;
        $simcard->id=$request->input('id');
        $simcard->linea=$request->input('linea');
        $simcard->usuario=$request->input('usuario');
        $simcard->clave=$request->input('clave');
        $simcard->fechaCorte=$request->input('fechaCorte');
        $simcard->apn=$request->input('apn');
        $simcard->planAsignado=$request->input('planAsignado');
        $simcard->operador=$request->input('operador');

        $simcard->save();
        return redirect()->route('simcards.index')
            ->with('success', 'Simcard creada satisfactoriamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $simcard = Simcard::find($id);

        return view('simcard.show', compact('simcard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $simcard = Simcard::find($id);
        $users=User::pluck('name','id');
        return view('simcard.edit', compact('simcard','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Simcard $simcard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $simcard=Simcard::findOrFail($id);
        $idu = Auth::id();
        $simcard->id_userCreador=$idu;
        $simcard->linea=$request->input('linea');
        $simcard->usuario=$request->input('usuario');
        $simcard->clave=$request->input('clave');
        $simcard->fechaCorte=$request->input('fechaCorte');
        $simcard->apn=$request->input('apn');
        $simcard->planAsignado=$request->input('planAsignado');
        $simcard->operador=$request->input('operador');

        $simcard->save();

        return redirect()->route('simcards.index')
            ->with('success', 'Simcard actualizada satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $simcard = Simcard::find($id)->delete();

        return redirect()->route('simcards.index')
            ->with('success', 'Simcard eliminada satisfactoriamente');
    }
    public function exportar()
    {
        return Excel::download(new SimcardExport, 'Simcard.xlsx');
        return back()->with('success', 'Exportado satisfactoriamente');
    }
    public function importar(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new SimcardImport,$file);
        return back()->with('success', 'Importado satisfactoriamente');
    }
    public function consulta(Request $request)
    {
        $texto=trim($request->get('texto'));
        $simcards = DB::table('simcards')
            ->join('users','simcards.id_userAsignado','=','users.id')
            ->select('simcards.id','simcards.linea','simcards.apn','simcards.usuario','simcards.clave','simcards.planAsignado','simcards.fechaCorte','simcards.estado','simcards.id_userAsignado','simcards.operador','simcards.id_userCreador','users.name','simcards.updated_at')
            ->where('simcards.id','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(100000000000);

        return view('simcard.consulta', compact('simcards','texto'))
            ->with('i', (request()->input('page', 1) - 1) * $simcards->perPage());
    }

    public function consultaUser(Request $request)
    {
        $texto=trim($request->get('texto'));
        $simcards = DB::table('simcards')
            ->join('users','simcards.id_userAsignado','=','users.id')
            ->select('simcards.id','simcards.linea','simcards.apn','simcards.usuario','simcards.clave','simcards.planAsignado','simcards.fechaCorte','simcards.estado','simcards.id_userAsignado','simcards.operador','simcards.id_userCreador','users.name','simcards.updated_at')
            ->where('simcards.id','LIKE','%'.$texto.'%')
            ->orderBy('id','desc')
            ->paginate(100000000000);

        return view('simcard.consultaUser', compact('simcards','texto'))
            ->with('i', (request()->input('page', 1) - 1) * $simcards->perPage());
    }
}
