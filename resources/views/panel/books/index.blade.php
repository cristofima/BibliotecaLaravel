@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('includes.messages')
            @include('includes.modalDelete')
            @include('includes.modalGiveBack')
            @php
                $isAdmin = Auth::user()->hasRole('admin');
            @endphp
            <div class="card">    
                <div class="card-header">Libros 
                    @if($isAdmin)
                        <a class="btn btn-primary" href="{{url('libros/create')}}" title="Nuevo libro" role="button">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                         {{$books->links()}}
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha Creación</th>
                            <th scope="col">Última Actualización</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <th scope="row">{{$book->name}}</th>
                                    <td>{{$book->author}}</td>
                                    @php
                                        $textState = "Disponible";
                                        $classState = "success";
                                        if(!$book->available){
                                            $textState = "Prestado";
                                            $classState = "warning";
                                        }
                                    @endphp
                                    <td class="text-center"><span class="badge badge-{{$classState}}">{{$textState}}</span></td>
                                    <td>{{$book->created_at}}</td>
                                    <td>{{$book->updated_at}}</td>
                                    <td>
                                        @if(!$book->available && $isAdmin)
                                            <a title="Devolver" data-toggle="modal" data-target="#modalGiveBack" 
                                            data-name="{{$book->name}}" href="#"
                                            data-action="{{route('libros.giveBack',$book->id)}}"
                                            class="btn btn-warning btn-xs"><i class="fa fa-undo-alt" aria-hidden="true"></i></a>
                                        @endif
                                        <a title="Ver" href="{{route('libros.show',$book->id)}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
                                        @if($isAdmin)
                                            <a title="Editar" href="{{route('libros.edit',$book->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <a title="Eliminar" data-toggle="modal" data-target="#modalDelete" 
                                                data-name="{{$book->name}}" href="#"
                                                data-action="{{route('libros.destroy',$book->id)}}"
                                                class="btn btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{$books->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@prepend('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var name = button.data('name');
            var modal = $(this);
            modal.find(".modal-content #exampleModalLongTitle").html("Eliminar Libro");
            modal.find(".modal-content #txtEliminar").html("¿Está seguro de eliminar el libro <b>" + name + "</b>?");
            modal.find(".modal-content form").attr('action', action);
        });

        $('#modalGiveBack').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var name = button.data('name');
            var modal = $(this);
            modal.find(".modal-content #exampleModalLongTitle").html("Devolver Libro");
            modal.find(".modal-content #txtBack").html("¿Está seguro de devolver el libro <b>" + name + "</b>?");
            modal.find(".modal-content form").attr('action', action);
        });
    });
</script>
@endprepend