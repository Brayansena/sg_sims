@extends('layouts.app')

@section('template_title')
    Dispositivos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex;align-items: center;flex-direction: row-reverse;justify-content: space-between;padding: 10px 5px 5px;">
                            <form style="display: flex;align-items: center;flex-direction: row-reverse;" action="{{route('dispositivos.consulta') }}"  method="get" id="search">
                              <div class="">
                                  <input type="submit" class="btn btn-dark btn-sm2" value="Buscar">
                                </div>
                              <div class="">
                                <input type="text" class="form-control" name="texto" value="{{ $texto }}">
                              </div>
                            </form>
                            <span style="font-size: 20px;">
                                {{ __('Dispositivos') }}
                            </span>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Cod Punto Venta</th>
                                        <th>Nombre Punto Venta</th>
                                        <th>Activo Dispositivo</th>
										<th>Tipo Dispositivo</th>
										<th>Marca</th>
										<th>Descripcion</th>
										<th>Serial</th>
										<th>Mac</th>
										<th>Imei</th>
										<th>Capacidad</th>
										<th>Observacion</th>
                                        <th>Estado</th>
										<th>Modificado Por</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dispositivos as $dispositivo)
                                        <tr>
                                            <td>{{ $dispositivo->id_puntoVenta }}</td>
                                            <td>{{ $dispositivo->nombrePdv }}</td>
                                            <td>{{ $dispositivo->id }}</td>
											<td>{{ $dispositivo->tipoDispositivo }}</td>
											<td>{{ $dispositivo->marca }}</td>
											<td>{{ $dispositivo->descripcion }}</td>
											<td>{{ $dispositivo->serial }}</td>
											<td>{{ $dispositivo->mac }}</td>
											<td>{{ $dispositivo->imei }}</td>
											<td>{{ $dispositivo->capacidad }}</td>
											<td>{{ $dispositivo->observacion }}</td>
											<td>{{ $dispositivo->estado }}</td>
											<td>{{ $dispositivo->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $dispositivos->links() !!}
            </div>
        </div>
    </div>
@endsection
