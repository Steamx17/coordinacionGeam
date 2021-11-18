@extends('adminlte::page')
{{-- para este formulario aplico laravelcollective --}}
{{-- para la instalcion uso el sisguente comando --}}
{{-- composer require laravelcollective/html --}}

@section('title', 'Institución | GEAM')


@section('plugins.Select2', true)



@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1></h1>
            <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Estudiantes</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop


@section('content')


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Estudiante</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($estudiante, ['route' => ['estudiante.update', $estudiante], 'method' => 'put']) !!}

            <div class="form-group">

                {!! Form::label('documento', 'Documento de identidad') !!}
                {!! Form::text('identification_students', null, ['class' => 'form-control', 'placeholder' => 'Ingrese documento de indentidad del estudiante', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();']) !!}

                @error('identification_students')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group">

                {!! Form::label('NombresApellidos', 'Nombres y Apellidos') !!}
                {!! Form::text('names_students', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre y apellido del estudiante', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();']) !!}

                @error('names_students')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">

                        {!! Form::label('grupo', 'Grupo') !!}

                        {!! Form::select('grupos_id', $grupo, $estudiante->grupos_id, ['class' => 'form-control select2', 'id' => 'grupoadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}

                        @error('grupos_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">

                    <br>
                    {!! Form::button('<i class="fas fa-sync-alt"></i> Actualizar Datos ', ['type' => 'submit', 'class' => 'btn btn-info']) !!}

                    <a href="{{ route('estudiante.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
                        Canselar</a>
                </div>

            </div>

            {!! Form::close() !!}
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->

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
