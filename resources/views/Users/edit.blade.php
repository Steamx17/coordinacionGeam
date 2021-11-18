@extends('adminlte::page')

@section('title', 'Usuarios')



@section('content_header')


    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Asignar un rol</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{ $User->name }}</p>
            <h2 class="h5">Listado de roles</h2>
            {!! Form::model($User, ['route' => ['User.update', $User], 'method' => 'put']) !!}
            @foreach ($roles as $role)
                <div>
                    <label>

                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                    </label>

                </div>
            @endforeach

            {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary', 'mt-2']) !!}

            {!! Form::close() !!}
        </div>

    </div>




    <footer class="main-footer">
        @yield('footer')

        <strong>Copyright &copy;<?php echo date('Y'); ?><a href="#"> Sistema de gestión académica - Grupo Educativo Abel Mendoza,
                desarrollado por Edison Guzman.</a> </strong>

        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>

    </footer>


@stop

@section('css')

    <link rel="stylesheet" href=" {{ asset('vendor/toastr/toastr.min.css') }}">

@stop

@section('js')

    <script src=" {{ asset('vendor/toastr/toastr.min.js') }}"></script>

    @if (session('info'))
        <script>
            $(document).ready(function() {
                toastr["success"]("Muy bien, se asigno los roles correctamente.", "Mensaje de alerta");
                toastr.options = {
                    //primeras opciones
                    "closeButton": false, //boton cerrar
                    "debug": false,
                    "newestOnTop": false, //notificaciones mas nuevas van en la parte superior
                    "progressBar": true, //barra de progreso hasta que se oculta la notificacion
                    "preventDuplicates": false, //para prevenir mensajes duplicados
                    "onclick": null,
                    //Posición de la notificación
                    //toast-bottom-left, toast-bottom-right, toast-bottom-left, toast-top-full-width, toast-top-center
                    "positionClass": "toast-top-right",
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                };
            });
        </script>
    @endif


@stop
