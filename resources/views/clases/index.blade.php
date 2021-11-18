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
                <div class="col-12">
                    <div id="CalendarioWeb"></div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>

    <!-- Modal(Agregar, Modificar, Eliminar) -->
    <div class="modal fade bd-example-modal-lg" id="ModalEventos" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloEvento"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card card-primary ">
                            <div class="card-header">
                                <h3 class="card-title">Añadir/Editar/Eliminar Eventos</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Colapso">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                {!! Form::open() !!}


                                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"> --}}
                                <input type="hidden" id="txtID" name="txtID">

                                <div class="form-group">

                                    {!! Form::label('fecha', 'Fecha Seleccionada:') !!}
                                    {!! Form::text('txtFecha', null, ['class' => 'form-control', 'placeholder' => '', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'id' => 'txtFecha', 'readonly']) !!}

                                    @error('txtFecha')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">

                                        {!! Form::label('titulo', 'Titulo:') !!}
                                        {!! Form::text('Titulo', null, ['class' => 'form-control', 'placeholder' => 'Titulo del evento', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'id' => 'txtTitulo']) !!}

                                        @error('Titulo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        {!! Form::label('hora', 'Hora del evento:') !!}

                                        <div class="input-group clockpicker" data-autoclose="true">
                                            {!! Form::text('Hora', '10:30', ['class' => 'form-control', 'id' => 'txtHora']) !!}
                                        </div>

                                        @error('Hora')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            {!! Form::label('profesor', 'Profesor') !!}

                                            {!! Form::select('docentes_id', $docente, 0, ['class' => 'form-control select2', 'id' => 'docentes_id', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}

                                            @error('grupo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        {{-- <input type="text" id="docentes_id" class="form-control" readonly /> --}}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('grupo', 'Grupo') !!}

                                            {!! Form::select('grupo', $grupo, 0, ['class' => 'form-control select2', 'id' => 'grupos_id', 'style' => 'width: 100%;'], [0 => ['disabled', 'hidden']]) !!}

                                            @error('grupo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>


                                    </div>
                                </div>
                                <div class="form-group">

                                    {!! Form::label('descripcion', 'Descripcion:') !!}
                                    {!! Form::textarea('txtDescripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripcion...', 'rows' => '3', 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'id' => 'txtDescripcion']) !!}

                                    @error('observation_group')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Color:</label>
                                    <input type="color" id="txtColor" value="#ff0000" name="txtFecha" class="form-control"
                                        style="height: 36px;" /><br>
                                </div>


                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                    <button type="button" id="btnModificar" class="btn btn-info">Modificar</button>
                    <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
                    <br>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
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
                $('#docentes_id').val(
                    value
                ); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
            });
        });
        $(function() {
            $(document).on('change', '#grupo', function() { //detectamos el evento change
                var value = $("#grupo option:selected").text();
                $('#grupos_id').val(
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

                eventClick: function(calEvent, jsEvent, view) {
                    $('#btnAgregar').prop("disabled", true);
                    $('#btnModificar').prop("disabled", false);
                    $('#btnEliminar').prop("disabled", false);
                    //H2
                    $('#tituloEvento').html(calEvent.title);
                    //MOSTRAR LA INFORMACION DEL EVENTO EN LOS INPUTS
                    $('#txtDescripcion').val(calEvent.description);
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);
                    FechaHora = calEvent.start._i.split(" ");
                    $('#txtFecha').val(FechaHora[0]);
                    $('#txtHora').val(FechaHora[1]);
                    $('#grupos_id').val(calEvent.grupos_id);
                    $("#grupos_id").change();
                    $('#docentes_id').val(calEvent.docentes_id);
                    $("#docentes_id").change();
                    $("#ModalEventos").modal();
                },
                buttonIcons: true,
                weekNumbers: false,
                editable: true,
                eventLimit: true,
                eventDrop: function(calEvent) {
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);
                    $('#txtdescription').val(calEvent.description);
                    var fechaHora = calEvent.start.format().split("T");
                    $('#txtFecha').val(fechaHora[0]);
                    $('#txtHora').val(fechaHora[1]);
                    $('#txtdescription').val(calEvent.description);
                    $('#grupos_id').val(calEvent.grupos_id);
                    $("#grupos_id").change();
                    $('#docentes_id').val(calEvent.docentes_id);
                    $("#docentes_id").change();

                    RecolectarDatosGUI();
                    EnviarInformacion('modificar', NuevoEvento, true);
                }

            });

        });
    </script>


    <script>
        var NuevoEvento;

        $('#btnAgregar').click(function() {
            RecolectarDatosGUI();
            EnviarInformacion('agregar', NuevoEvento);
        });
        $('#btnEliminar').click(function() {
            RecolectarDatosGUI();
            EliminarInformacion('eliminar', NuevoEvento);
        });
        $('#btnModificar').click(function() {
            RecolectarDatosGUI();
            ActualizarInformacion('modificar', NuevoEvento);
        });

        function RecolectarDatosGUI() {
            NuevoEvento = {
                id: $('#txtID').val(),
                title: $('#txtTitulo').val(),
                start: $('#txtFecha').val() + " " + $('#txtHora').val(),
                color: $('#txtColor').val(),
                description: $('#txtDescripcion').val(),
                textColor: "#FFFFFF",
                end: $('#txtFecha').val() + " " + $('#txtHora').val(),
                docentes_id: $('#docentes_id').val(),
                grupos_id: $('#grupos_id').val()
               
            };
        }


        function EnviarInformacion(accion, objEvento, modal) {
            let Urlstore = "{{ route('clase.store') }}"
            if (objEvento) {

                $.ajax({
                    type: "POST",
                    url: Urlstore,
                    data: {
                        id: $('#txtID').val(),
                        title: $('#txtTitulo').val(),
                        start: $('#txtFecha').val() + " " + $('#txtHora').val(),
                        color: $('#txtColor').val(),
                        description: $('#txtDescripcion').val(),
                        textColor: "#FFFFFF",
                        end: $('#txtFecha').val() + " " + $('#txtHora').val(),
                        docentes_id: $('#docentes_id').val(),
                        grupos_id: $('#grupos_id').val(),
                        _token: $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        $("#ModalEventos").modal('hide');
                    }
                });
            }
        }

        function ActualizarInformacion(accion, objEvento, modal) {
            let UrlUpdate = "{{ route('clasex.update') }}"
            if (objEvento) {

                $.ajax({
                    type: "POST",
                    url: UrlUpdate,
                    data: {
                        id: $('#txtID').val(),
                        title: $('#txtTitulo').val(),
                        start: $('#txtFecha').val() + " " + $('#txtHora').val(),
                        color: $('#txtColor').val(),
                        description: $('#txtDescripcion').val(),
                        textColor: "#FFFFFF",
                        end: $('#txtFecha').val() + " " + $('#txtHora').val(),
                        docentes_id: $('#docentes_id').val(),
                        grupos_id: $('#grupos_id').val(),
                        _token: $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        $("#ModalEventos").modal('hide');
                    }
                });
            }
        }

        function EliminarInformacion(accion, objEvento, modal) {
            let UrlEliminar = "{{ route('clasex.destroy') }}"
            if (objEvento) {
                $.ajax({
                    type: "POST",
                    url: UrlEliminar,
                    data: {
                        id: $('#txtID').val(),
                        _token: $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        $("#ModalEventos").modal('hide');
                    }
                });
            }
        }
        $('.clockpicker').clockpicker();

        function limpiarFormulario() {
            $('#txtID').val('');
            $('#txtTitulo').val('');
            $('#txtColor').val('');
            $('#txtDescripcion').val('');
            $('#docentes_id').val('');
            $('#grupos_id').val('');
            $('#profesor option').prop('selected', function() {
                return this.defaultSelected;
            });
        }
    </script>

@stop

@endcan

@can('clase.docente')

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
                $('#docentes_id').val(
                    value
                ); //le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
            });
        });
        $(function() {
            $(document).on('change', '#grupo', function() { //detectamos el evento change
                var value = $("#grupo option:selected").text();
                $('#grupos_id').val(
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
