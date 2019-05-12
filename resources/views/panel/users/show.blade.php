@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Información del usuario <a class="btn btn-primary" href="{{url('usuarios')}}" title="Regresar al listado" role="button">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                    </a></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Nombre:</b> {{$user->name}}</li>
                            <li class="list-group-item"><b>E-mail:</b> {{$user->email}}</li>
                            <li class="list-group-item"><b>Fecha Creación:</b> {{$user->created_at}}</li>
                            <li class="list-group-item"><b>Última Actualización:</b> {{$user->updated_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection