@extends('adminlte::page')
{{-- para este formulario aplico laravelcollective --}}
{{-- para la instalcion uso el sisguente comando --}}
{{-- composer require laravelcollective/html --}}

@section('title', 'Asistencia | GEAM')


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
                    <li class="breadcrumb-item active">Asistecias</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Registrar Asistencia</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'estudiante.store']) !!} {{-- porner el "multipart/form-data" --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('fecha', 'Fecha') !!}
                        {!! Form::date('date_assistance', null, ['class' => 'form-control', 'id' => 'fechaadd']) !!}

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('horainicio', 'Hora de inicio') !!}

                        {!! Form::select('start_time_assistance', $hora, '07:00', ['class' => 'form-control select2', 'id' => 'horainicioadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('horafinal', 'Hora de final') !!}

                        {!! Form::select('end_time_assistance', $hora, '10:00', ['class' => 'form-control select2', 'id' => 'horafinaladd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('tiempoo', 'Tiempo Trancurrido') !!}
                        {!! Form::text('time_elapsed_assistance', null, ['class' => 'form-control', 'id' => 'horas_justificacion_real', 'readonly']) !!}

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">

                        {!! Form::label('profesor', 'Clase') !!}

                        {!! Form::select('id_clases', $clase, '10:00', ['class' => 'form-control select2', 'id' => 'claseadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">

                        {!! Form::label('materialsocializado', 'Material socializado') !!}
                        {!! Form::text('socialized_material_assistance', null, ['class' => 'form-control', 'id' => 'materialsocializadoadd', 'placeholder' => 'Guías AB 2021']) !!}


                    </div>


                </div>
                <div class="col-md-6">
                    <div class="form-group">


                        {!! Form::label('ejetematico', 'Eje temático') !!}
                        {!! Form::text('main_theme_assistance', null, ['class' => 'form-control', 'id' => 'ejetematicoadd', 'placeholder' => 'Ciencias naturales – estequiometria', 'title' => 'Eje Temático']) !!}

                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('Institución', 'Institución') !!}

                        {!! Form::select('id_colegios', $colegio, 0, ['class' => 'form-control select2', 'id' => 'institucionadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}


                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('Materia', 'Materia') !!}

                        {!! Form::select('id_subjects', $clase, 0, ['class' => 'form-control select2', 'id' => 'subjectadd', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('number', 'Numero de asistentes') !!}
                        {!! Form::number('number_assistants', null, ['class' => 'form-control', 'id' => 'numberassistants', 'placeholder' => '35 Estudiantes', 'title' => 'Numero de asistentes']) !!}

                        {{-- <input class="form-control" title="Numero de estudiantes que asistieron" pattern="^[0-9]+"
                        id="numberassistants" name="numberassistants" type="number" placeholder="35 Estudiantes"
                        required> --}}

                    </div>
                </div>
            </div>

            <div class="form-group">

                {!! Form::label('observaciones', 'Observaciones') !!}
                {!! Form::textarea('observations_assistance', null, ['class' => 'form-control', 'placeholder' => 'Observaciones...', 'rows' => '3', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'id' => 'observacionesadd']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('exampleInputFile', 'Adjuntar lista de asistencia (.txt / .pdf / .jpg)') !!}
                <div class="input-group">

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="evidenceadd" required name="evidenceadd"
                            onchange="return fileValidation(this.files[0].name)" />
                        <label class="custom-file-label" id="evidencelabel" name="evidencelabel"
                            for="exampleInputFile"></label>
                    </div>
                </div>

                <input type="text" id="name" name="name" class="form-control" value="No se ha seleccionado un archivo"
                    readonly>
                <br>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">

                    <br>
                    {!! Form::button('<i class="fas fa-save"></i> Registrar Asistencia ', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                    <a href="{{ route('asistencia.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i>
                        Cancelar</a>
                </div>

            </div>

            {!! Form::close() !!}

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






        <script>
            function calculardiferencia() {
                var hora_final = $('#horafinaladd').val();
                var hora_inicio = $('#horainicioadd').val();
                // console.log("- "+hora_inicio + hora_final);
                // Expresión regular para comprobar formato
                var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
                // Si algún valor no tiene formato correcto sale
                if (!(hora_inicio.match(formatohora) &&
                        hora_final.match(formatohora))) {
                    return;
                }
                // Calcula los minutos de cada hora
                var minutos_inicio = hora_inicio.split(':')
                    .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
                var minutos_final = hora_final.split(':')
                    .reduce((p, c) => parseInt(p) * 60 + parseInt(c));

                // Si la hora final es anterior a la hora inicial sale
                if (minutos_final < minutos_inicio) return;

                // Diferencia de minutos
                var diferencia = minutos_final - minutos_inicio;

                // Cálculo de horas y minutos de la diferencia
                var horas = Math.floor(diferencia / 60);
                var minutos = diferencia % 60;
                if (hora_final <= hora_inicio || hora_inicio >= hora_final) {
                    $('#horas_justificacion_real').val("Error, Verifique...");
                } else {
                    $('#horas_justificacion_real').val(horas + ':' +
                        (minutos < 10 ? '0' : '') + minutos);
                }
            }

            $('#horainicioadd').change(calculardiferencia);
            $('#horafinaladd').change(calculardiferencia);
            calculardiferencia();
        </script>

        <script>
            function eliminar($id, $clase, $fila) {
                Swal.fire({
                    title: 'Desea Eliminar esta asistencia?' + $clase,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Eliminar`,
                    denyButtonText: `No eliminar, cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '../includes/sentences/delete_asistences.php',
                            data: {
                                id: $id
                            },
                            success: function(msg) {
                                Swal.fire('Asistencia eliminada!', '', 'success')
                                $($fila).fadeOut(1000);
                            },
                            error: function() {
                                Swal.fire('Changes are not saved', '', 'error')
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Asistencia no eliminada', '', 'info')
                    }
                })
            }
        </script>


        <script>
            function fileValidation($name) {
                var fileInput = document.getElementById('evidenceadd');
                var filePath = fileInput.value;
                if (fileInput.length == 0) {
                    alert("Por favor seleccion un archivo");
                } else {
                    var allowedExtensions = /(.jpg|.jpeg|.png|.pdf)$/i;
                    if (!allowedExtensions.exec(filePath)) {
                        alert('El  archivo ' + $name + ' no contiene extensiones: .jpeg / .jpg / .png / .pdf');
                        fileInput.value = '';
                        return false;
                    } else {
                        $("#name").val($name);
                    }
                }
            }
        </script>
    @stop
