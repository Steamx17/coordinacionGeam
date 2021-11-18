@extends('adminlte::page')
{{-- para este formulario aplico laravelcollective --}}
{{-- para la instalcion uso el sisguente comando --}}
{{-- composer require laravelcollective/html --}}

@section('title', 'Profesores | GEAM')


@section('plugins.Select2', true)




@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Docentes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')


    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Editar Docente</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($docente, ['route' => ['docente.update', $docente], 'method' => 'put']) !!}

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombres') !!}
                        {!! Form::text('names_teacher', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del docente', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'id' => 'names_teacher', 'oninput' => 'actualizarnombreCompletoEditar()']) !!}

                        @error('names_teacher')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('apellido', 'Apellidos') !!}
                        {!! Form::text('surnames_teacher', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el apellido del docente', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'id' => 'surnames_teacher', 'oninput' => 'actualizarnombreCompletoEditar()']) !!}

                        @error('surnames_teacher')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="form-group">
                        {!! Form::label('nombrecompleto', 'Nombre completo') !!}
                        {!! Form::text('fullname_teacher', null, ['class' => 'form-control', 'readonly', 'id' => 'fullname_teacher']) !!}

                        @error('fullname_teacher')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">

                        {!! Form::label('asiganatura', 'Asiganatura impartida') !!}

                        {!! Form::select('subjects_id', $asignat, null, ['class' => 'form-control select2', 'id' => 'departamentoadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}

                        @error('subjects_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('estado', 'Estado del docente') !!}

                        {!! Form::select('status', ['0' => 'Seleccione un estado', 'ACTIVE' => 'ACTIVO', 'INACTIVE' => 'INACTIVO'], null, ['class' => 'form-control select2', 'id' => 'status', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}


                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

            </div>

            <div class="form-group">

                {!! Form::label('observacione', 'Observaciones') !!}
                {!! Form::textarea('observations_teacher', null, ['class' => 'form-control', 'placeholder' => 'Observaciones...', 'rows' => '3', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();']) !!}

                @error('observations_teacher')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


            </div>


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">

                    <br>

                    {!! Form::button('<i class="fas fa-sync-alt"></i> Actualizar Datos ', ['type' => 'submit', 'class' => 'btn btn-info']) !!}

                    {{-- <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Registrar
                                Datos</button> --}}

                    {{-- antes de enviar los datos se tiene que habilitar la asignacion masiva en el modelo grupo --}}
                    <a href="{{ route('docente.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
                        Cancelar</a>
                </div>

            </div>

            {!! Form::close() !!}

        </div>

    </div>





    <footer class="main-footer">
        @yield('footer')

        <strong>Copyright &copy;<?php echo date('Y'); ?><a href="#"> Sistema de gestión académica - Grupo Educativo Abel
                Mendoza,
                desarrollado por Edison Guzman.</a> </strong>

        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>

    </footer>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script>
        $("#test").keyup(function() {
            this.value = this.value.toUpperCase();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input').attr('autocomplete', 'off');
        });
    </script>


    <script>
        function actualizarnombreCompleto() {
            let nombres = document.getElementById("names_teacher").value;
            let apellidos = document.getElementById("surnames_teacher").value;

            document.getElementById("fullname_teacher").value = nombres.toUpperCase() + " " + apellidos.toUpperCase();
        }

        function actualizarnombreCompletoEditar() {
            let nombres = document.getElementById("names_teacher").value;
            let apellidos = document.getElementById("surnames_teacher").value;
            //Se actualiza en municipio inm
            document.getElementById("fullname_teacher").value = nombres.toUpperCase() + " " + apellidos.toUpperCase();
        }
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>

@stop
