@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar Libro <a class="btn btn-primary" href="{{url('libros')}}" title="Regresar al listado" role="button">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                    </a></div>
                    <div class="card-body">
                        @include('includes.messages')
                        {!! Form::open(['route' => ['libros.update', $book->id],'method' => 'PATCH']) !!}
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input required type="text" min="3" max="60" class="form-control" id="name" name="name" value="{{$book->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="author" class="col-sm-2 col-form-label">Autor</label>
                                <div class="col-sm-10">
                                    <input required type="text" min="3" max="40" class="form-control" id="author" name="author" value="{{$book->author}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number_pages" class="col-sm-2 col-form-label"># Páginas</label>
                                <div class="col-sm-10">
                                    <input required type="number" min="1" class="form-control" id="number_pages" name="number_pages" value="{{$book->number_pages}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <div class="col-sm-10">
                                      <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection