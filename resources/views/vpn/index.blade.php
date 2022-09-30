@extends('layouts.app')

@section('template_title')
    Vpn
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex;align-items: center;flex-direction: row-reverse;justify-content: space-between;padding: 10px 5px 5px;">
                            <form style="display: flex;align-items: center;flex-direction: row-reverse;" action="{{route('vpns.index') }}"  method="get" id="search">
                              <div class="">
                                  <input type="submit" class="btn btn-dark btn-sm2" value="Buscar">
                                </div>
                              <div class="">
                                <input type="text" class="form-control" name="texto" value="{{ $texto }}">
                              </div>
                            </form>
                            <span style="font-size: 20px;">
                                {{ __('Vpns') }}
                            </span>
                        </div>
                        <div style="display: flex;justify-content: space-between;align-items: center;padding: 5px 5px 1px;flex-direction: row-reverse;">
                             <div class="float-right">
                                <a href="{{ route('vpns.create') }}" class="btn btn-primary btn-sm2 float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                              </div>
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
                                        <th>No</th>

										<th>Usuario</th>
										<th>Contrasena</th>
										<th>Servicio</th>
										<th>Punto Venta</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vpns as $vpn)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $vpn->usuario }}</td>
											<td>{{ $vpn->contrasena }}</td>
											<td>@if ($vpn->servicio==0)
                                                OVPN
                                            @else
                                                PPTP
                                            @endif
                                        </td>
											<td>{{ $vpn->nombrePdv }}</td>

                                            <td>
                                                <form action="{{ route('vpns.destroy',$vpn->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('vpns.show',$vpn->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('vpns.edit',$vpn->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $vpns->links() !!}
            </div>
        </div>
    </div>
@endsection
