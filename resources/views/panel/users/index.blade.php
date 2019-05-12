@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('includes.messages')
            @include('includes.modalDelete')
            <div class="card">    
                <div class="card-header">Usuarios <a class="btn btn-primary" href="{{url('usuarios/create')}}" title="Nuevo usuario" role="button">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{$users->links()}}
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Fecha Creación</th>
                            <th scope="col">Última Actualización</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->name}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>
                                        <a title="Ver" href="{{route('usuarios.show',$user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
                                        <a title="Editar" href="{{route('usuarios.edit',$user->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a title="Eliminar" data-toggle="modal" data-target="#modalDelete" 
                                            data-name="{{$user->name}}" href="#"
                                            data-action="{{route('usuarios.destroy',$user->id)}}"
                                            class="btn btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                         {{$users->links()}}
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
            modal.find(".modal-content #exampleModalLongTitle").html("Eliminar Usuario");
            modal.find(".modal-content #txtEliminar").html("¿Está seguro de eliminar el usuario <b>" + name + "</b>?");
            modal.find(".modal-content form").attr('action', action);
        });
    });
</script>
@endprepend