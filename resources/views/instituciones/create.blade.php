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
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Instituciones</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop


@section('content')


    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Registrar una institucion</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'colegio.store']) !!}

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">

                        {!! Form::label('departamento', 'Departamento') !!}

                        {!! Form::select('departamentoadd', $depart, 0, ['class' => 'form-control select2', 'id' => 'departamentoadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}

                        @error('departamentoadd')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('municipio', 'Municipio') !!}
                        <select id="municipioadd" name="municipios_id" class="form-control select2" style="width: 100%;">
                            <option value="" selected disabled hidden>Seleccione un municipio </option>
                        </select>

                        @error('municipios_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            </div>

            <div class="form-group">

                {!! Form::label('nombreinstitucion', 'Nombre de la institución') !!}
                {!! Form::text('name_colegios', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la institucion', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();']) !!}

                @error('name_colegios')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">


                    <br>
                    {!! Form::button('<i class="fas fa-save"></i> Registrar Datos ', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                    {{-- <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Registrar
                                Datos</button> --}}

                    {{-- antes de enviar los datos se tiene que habilitar la asignacion masiva en el modelo institucion --}}
                    <a href="{{ route('colegio.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
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
        $(function() {

            $('#departamentoadd').on('change', onselectDepartamento);


        });

        function onselectDepartamento() {
            var id_departamento = $(this).val();



            // AJAX
            if (id_departamento != null) {
                $.get('/departamentos/' + id_departamento + '/municipios', function(data) {

                    var html_select = '<option value="" selected disabled hidden>Seleccione un municipio </option>';
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].id + '" >' + data[i].name_municipios +
                        '</option>';

                    // console.log(html_select);
                    $('#municipioadd').html(html_select)

                });
            } else {
                $('#municipioadd').html('<option value="" selected disabled hidden>Seleccione un municipio </option>')
                return;
            }

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
