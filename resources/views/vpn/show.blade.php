@extends('layouts.app')

@section('template_title')
    {{ $vpn->name ?? 'Show Vpn' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Vpn</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('vpns.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $vpn->usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Contrasena:</strong>
                            {{ $vpn->contrasena }}
                        </div>
                        <div class="form-group">
                            <strong>Servicio:</strong>
                            {{ $vpn->servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Id Puntoventa:</strong>
                            {{ $vpn->id_puntoVenta }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
