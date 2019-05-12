@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Información del libro <a class="btn btn-primary" href="{{url('libros')}}" title="Regresar al listado" role="button">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                    </a></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Nombre:</b> {{$book->name}}</li>
                            <li class="list-group-item"><b>Autor:</b> {{$book->author}}</li>
                            <li class="list-group-item"><b># Páginas:</b> {{$book->number_pages}}</li>
                            @php
                                $textState = "Disponible";
                                $classState = "success";
                                if(!$book->available){
                                    $textState = "Prestado";
                                    $classState = "warning";
                                }
                            @endphp
                            <li class="list-group-item"><b>Estado:</b> <span class="badge badge-{{$classState}}">{{$textState}}</span></li>
                            <li class="list-group-item"><b># Préstamos:</b> {{$book->loans_count}}</li>
                            <li class="list-group-item"><b>Fecha Creación:</b> {{$book->created_at}}</li>
                            <li class="list-group-item"><b>Última Actualización:</b> {{$book->updated_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection