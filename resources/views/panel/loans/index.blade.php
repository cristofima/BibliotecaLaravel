@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('includes.messages')
            <div class="card">    
                <div class="card-header">Préstamos <a class="btn btn-primary" href="{{url('prestamos/create')}}" title="Prestar libro" role="button">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{$loans->links()}}
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Libro</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Fecha Préstamo</th>
                            <th scope="col">Fecha Devolución</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                                <tr>
                                    <th scope="row">{{$loan->book->name}}</th>
                                    <td>{{$loan->user->name}}</td>
                                    <td>{{$loan->created_at}}</td>
                                    <td>
                                        @if($loan->updated_at > $loan->created_at) 
                                            {{$loan->updated_at}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                         {{$loans->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection