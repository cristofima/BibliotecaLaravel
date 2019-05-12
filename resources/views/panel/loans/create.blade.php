@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Prestar Libro <a class="btn btn-primary" href="{{url('prestamos')}}" title="Regresar al listado" role="button">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                    </a></div>
                    <div class="card-body">
                        @include('includes.messages')
                        {!! Form::open(['url' => 'prestamos']) !!}
                            <div class="form-group row">
                                <label for="user" class="col-sm-2 col-form-label">Usuario</label>
                                <div class="col-sm-10">
                                    <select id="user" name="user_id" class="form-control" required>
                                        <option value="">-- Seleccionar ---</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="book" class="col-sm-2 col-form-label">Libro</label>
                                <div class="col-sm-10">
                                    <select id="book" name="book_id" class="form-control" required>
                                        <option value="">-- Seleccionar ---</option>
                                        @foreach ($books as $book)
                                            <option value="{{$book->id}}">{{$book->name}}</option>
                                        @endforeach
                                    </select>
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