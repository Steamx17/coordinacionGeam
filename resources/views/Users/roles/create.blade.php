@extends('adminlte::page')

@section('title', 'Usuarios')



@section('content_header')


    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Crear nuevo rol</h1>
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

            {!! Form::open(['route' => 'roles.store']) !!}
            <div class="form-group">

                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => ' Ingrese el nombre del rol']) !!}
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


            </div>

            <h2 class="h3">Lista de permisos </h2>


            @foreach ($permissions as $permission)
                <div>

                    <label>
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                        {{ $permission->description }}
                    </label>
                </div>
            @endforeach
            {!! Form::submit('Crear rol', ['class' => 'btn btn-primary']) !!}
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

@stop

@section('js')

    @if (session('info'))
        <script>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Mensaje de alerta',
                body: 'Muy bien, se asigno los roles correctamente.'
            })
        </script>
    @endif




@stop
