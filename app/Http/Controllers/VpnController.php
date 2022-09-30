<?php

namespace App\Http\Controllers;

use App\Models\PuntoVenta;
use App\Models\Vpn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * Class VpnController
 * @package App\Http\Controllers
 */
class VpnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texto=trim($request->get('texto'));
        $vpns = DB::table('vpns')
            ->join('punto_ventas','vpns.id_puntoVenta','=','punto_ventas.id')
            ->select('vpns.id','vpns.usuario','vpns.contrasena','vpns.servicio','punto_ventas.nombrePdv')
            ->where('punto_ventas.cod_puntoVenta','LIKE','%'.$texto.'%')
            ->orderBy('vpns.id','desc')
            ->paginate(10);

        return view('vpn.index', compact('vpns','texto'))
            ->with('i', (request()->input('page', 1) - 1) * $vpns->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vpn = new Vpn();
        $puntoVenta=PuntoVenta::pluck('nombrePdv','id');
        $collection = collect([
            ['id' => '0',  'servicio' => 'OVPN'],
            ['id' => '1', 'servicio' => 'PPTP'],
        ]);
        $servicio = $collection->pluck('servicio', 'id');
        $servicio->all();
        return view('vpn.create', compact('vpn','puntoVenta','servicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Vpn::$rules);

        $vpn = Vpn::create($request->all());

        return redirect()->route('vpns.index')
            ->with('success', 'Vpn created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vpn = Vpn::find($id);

        return view('vpn.show', compact('vpn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vpn = Vpn::find($id);
        $puntoVenta=PuntoVenta::pluck('nombrePdv','id');
        $collection = collect([
            ['id' => '0',  'servicio' => 'OVPN'],
            ['id' => '1', 'servicio' => 'PPTP'],
        ]);
        $servicio = $collection->pluck('servicio', 'id');
        $servicio->all();
        return view('vpn.edit', compact('vpn','puntoVenta','servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vpn $vpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vpn $vpn)
    {
        request()->validate(Vpn::$rules);

        $vpn->update($request->all());

        return redirect()->route('vpns.index')
            ->with('success', 'Vpn updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vpn = Vpn::find($id)->delete();

        return redirect()->route('vpns.index')
            ->with('success', 'Vpn deleted successfully');
    }
}
