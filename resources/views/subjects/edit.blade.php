@extends('adminlte::page')
{{-- para este formulario aplico laravelcollective --}}
{{-- para la instalcion uso el sisguente comando --}}
{{-- composer require laravelcollective/html --}}

@section('title', 'Asignaturas | GEAM')


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
                    <li class="breadcrumb-item active">Asignaturas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')


    <div class="card card-info">

        <div class="card-header">
            <h3 class="card-title">Editar Asignatura</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($subject, ['route' => ['subject.update', $subject], 'method' => 'put']) !!}

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">

                        {!! Form::label('nombreasignatura', 'Nombre de asignatura') !!}
                        {!! Form::text('name_subjects', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del subject', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();']) !!}

                        @error('name_subjects')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">

                        {!! Form::label('observaciones', 'Observaciones') !!}
                        {!! Form::textarea('observations_subjects', null, ['class' => 'form-control', 'placeholder' => 'Observaciones...', 'rows' => '3', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();']) !!}

                        @error('observations_subjects')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">

                    <br>
                    {!! Form::button('<i class="fas fa-sync-alt"></i> Actualizar Datos ', ['type' => 'submit', 'class' => 'btn btn-info']) !!}


             
                    <a href="{{ route('subject.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
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
        // obtengo el valor de la seleccion del combo, para luego usar ese valor y hacer una consulta usando AJAX
        // y asi cargar los municipios pertenecientes a ese departamento. 
        $(function() {

            var departamento = $("#departamentoadd").val();
            var DatoactualMunicipio = $("#temporalMunicip").val();



            // AJAX
            if (departamento != null) {
                $.get('/api/departamentos/' + departamento + '/municipios', function(data) {
                    var html_select =
                        '<option value="" selected disabled hidden>Seleccione un municipio </option>';
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].id + '" >' + data[i].name_municipios +
                        '</option>';

                    // console.log(html_select);
                    $('#municipioadd').html(html_select)

                    //seteao un valor por defecto al  select en este caso su id que viene de la la tabla en la vista index
                    $(document).ready(function() {
                        $("#municipioadd").val(DatoactualMunicipio);
                        $("#municipioadd").change();

                    });
                });


            } else {
                $('#municipioadd').html(
                    '<option value="" selected disabled hidden>Seleccione un municipio </option>')
                return;
            }

        })
    </script>





    <script>
        //Funcion para mostrar un municipio en un comobo box o selectcion   
        $(function() {
            $('#departamentoadd').on('change', onselectDepartamento);

        });

        function onselectDepartamento() {
            var id_departamento = $(this).val();

            // AJAX
            if (id_departamento != null) {
                $.get('/api/departamentos/' + id_departamento + '/municipios', function(data) {
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
