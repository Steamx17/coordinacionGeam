@can('clase.admin&&cordinador')
    

@extends('adminlte::page')

    @section('title', 'Clases')


@section('plugins.Select2', true)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Clases</h1>
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Clases</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Calendario de Clases</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapso">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col"></div>
                <div class="col-9">
                    <div id="CalendarioWeb"></div>
                </div>
                <div class="col"></div>
            </div>
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


    <link rel="stylesheet" href="{{ asset('vendor/assets/dist/css/bootstrap-clockpicker.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/assets/dist/css/fullcalendar.min.css') }}">

@stop

@section('js')
    <script src="{{ asset('vendor/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/dist/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/dist/js/es.js') }}"></script>
    <script src="{{ asset('vendor/assets/dist/js/bootstrap-clockpicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- /.content-wrapper -->
    <script>
        $(function() {
            $(document).on('change', '#profesor', function() { //detectamos el evento change
                var value = $("#profesor option:selected").text();
                $('#profesorselect').val(
                    value
                ); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
            });
        });
        $(function() {
            $(document).on('change', '#grupo', function() { //detectamos el evento change
                var value = $("#grupo option:selected").text();
                $('#gruposelect').val(
                    value
                ); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
            });
        });
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
        $(document).ready(function() {
            // seteo la variable MostrarIndex con la ruta que hace una consulta a la DB usando el controlador
            let MostrarIndex = "{{ route('clase.index') }}"
            $('#CalendarioWeb').fullCalendar({
                header: {
                    left: 'today, prev, next',
                    center: 'title',
                    right: 'month, basicWeek, basicDay, timeGridWeek, timeGridDay,listMonth'
                },
                dayClick: function(date, jsEvent, view) {
                    $('#btnAgregar').prop("disabled", false);
                    $('#btnModificar').prop("disabled", true);
                    $('#btnEliminar').prop("disabled", true);
                    limpiarFormulario();
                    $('#txtFecha').val(date.format());
                    $("#ModalEventos").modal();
                },

                events: MostrarIndex,

            });

        });
    </script>


@stop

@endcan
