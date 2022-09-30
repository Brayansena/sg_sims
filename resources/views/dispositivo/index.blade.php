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
                            <form style="display: flex;align-items: center;flex-direction: row-reverse;" action="{{route('dispositivos.index') }}"  method="get" id="search">
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
                        <div style="display: flex;justify-content: space-between;align-items: center;flex-direction: row-reverse;padding: 5px 5px 1px;">
                             <div style="display: flex;flex-direction: row;">
                                <a href="{{ route('dispositivos.exportar') }}" class="btn btn-warning btn-sm2 float-right"  data-placement="left">
                                    {{ __('Exportar') }}
                                  </a>
                                <a href="{{ route('dispositivos.create') }}" class="btn btn-primary btn-sm2 float-right"  data-placement="left">
                                  {{ __('Crear') }}
                                </a>
                              </div>
                              <form style="display: flex;flex-direction: row-reverse" action="{{ route('dispositivos.importar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="file-select" id="src-file1" >
                                    <input type="file" class="" name="file" aria-label="Archivo">
                                  </div>
                                  <button type="submit" class="btn btn-primary btn-sm2 float-right">Importar</button>
                                </form>
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
                                        <th>Marca</th>
										<th>Descripcion</th>
                                        <th>Activo</th>
										<th>Tipo Dispositivo</th>
										<th>Serial</th>
										<th>Cod PDV</th>
                                        <th>Nombre Pdv</th>
										<th>Estado</th>
										<th>Cedula Responsable</th>
										<th>Responsable</th>
										<th>Fecha Asignacion</th>
										<th>Numeroacta</th>
										<th>Mac</th>
										<th>Imei</th>
										<th>Capacidad</th>
										<th>Observacion</th>
										<th>Modificado Por</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dispositivos as $dispositivo)
                                        <tr>
                                            <td>{{ $dispositivo->marca }}</td>
											<td>{{ $dispositivo->descripcion }}</td>
											<td>{{ $dispositivo->id }}</td>
											<td>{{ $dispositivo->tipoDispositivo }}</td>
											<td>{{ $dispositivo->serial }}</td>
											<td>{{ $dispositivo->id_puntoVenta }}</td>
											<td>{{ $dispositivo->nombrePdv }}</td>
											<td>{{ $dispositivo->estado }}</td>
											<td>{{ $dispositivo->cedulaResponsable }}</td>
											<td>{{ $dispositivo->responsable }}</td>
											<td>{{ $dispositivo->fechaAsignacion }}</td>
											<td>{{ $dispositivo->numeroActa }}</td>
											<td>{{ $dispositivo->mac }}</td>
											<td>{{ $dispositivo->imei }}</td>
											<td>{{ $dispositivo->capacidad }}</td>
											<td>{{ $dispositivo->observacion }}</td>
											<td>{{ $dispositivo->name }}</td>

                                            <td>
                                                <form action="{{ route('dispositivos.destroy',$dispositivo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('dispositivos.edit',$dispositivo->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
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
