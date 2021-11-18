@extends('adminlte::page')

@section('title', 'Grupo | GEAM')
<link rel="icon" href="public/favicons/favicon.ico">

<link rel="stylesheet" type="text/css" href="{{ asset('css/switch.css') }}">


@csrf

{{-- <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" /> --}}

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4-4.6.0/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/sp-1.4.0/sl-1.3.3/datatables.min.css" />



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
                    <li class="breadcrumb-item active">Asistencia</li>
                </ol>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop


@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Asistencia de la clase <b>{{ $clase->title }}</b>, cuyos estudiantes pertenecen al
                grupo <b>{{ $nombreGrupo->name_group }}</b>
            </h3>
            <div class="col-12">
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-xl">
                    Cargar evidencia
                </button>

            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @csrf
            <input type="hidden" name="start" id="start" value="{{ $clase->start }}">
            <input type="hidden" name="end" id="end" value="{{ $clase->end }}">
            <div class="table-responsive">
                <table id="TablaEstudiante" class="table table-bordered table-hover projects ">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Identificación Estudiante</th>
                            <th scope="col" class="text-center">Nombres</th>
                            <th scope="col" class="text-center">Marcar * asistencias &nbsp;<input id="activarTodos"
                                    class="mi_checkbox" type="checkbox"> </th>

                            <th scope="col" class="text-center">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($estudianteG as $id => $estudianteGx)

                            <tr>
                                <td class="text-center"> {{ ++$id }}</td>
                                <td class="text-center"> {{ $estudianteGx->identification_students }}</td>

                                {{-- <input type="hidden" name="id_estudiantes[]" value="{{ $estudianteGx->id }}"> --}}

                                <td id="resp{{ $estudianteGx->id }}">

                                    @if ($estudianteGx->cargaStatusAsistencia($estudianteGx->id, $clase->id) == 1)
                                        <span class="btn btn-sm btn-success attdState">Presente</span>
                                    @else
                                        <span class="btn btn-sm btn-danger attdState">Ausente</span>
                                    @endif

                                    <a class="text-dark"
                                        href="{{ url('Asistencias/estudiante/' . $clase->id . '/' . $estudianteGx->id) }}">{{ $estudianteGx->names_students }}</a>

                                </td>

                                <td class="text-center">
                                    <br>
                                    <label class="switch">
                                        <input id="id_clases" type="hidden" name="id_clases" value="{{ $clase->id }}" />
                                        <input name="id_estudiantes" data-id="{{ $estudianteGx->id }}"
                                            class="mi_checkbox" type="checkbox" data-onstyle="success"
                                            data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"
                                            {{ $estudianteGx->cargaStatusAsistencia($estudianteGx->id, $clase->id) ? 'checked' : '' }}
                                            value="{{ $estudianteGx->id }}">
                                        <span class="slider round"></span>
                                    </label>


                                </td>

                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ url('Asistencias/estudiante/' . $estudianteGx->id) }}">
                                        <i class=" fas fa-solid fa-eye "> </i>
                                        Ver asistencias
                                    </a>


                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div style="text-align:center;">

                {{-- @if (($attendances = 2) < 0) --}}
                <button id="btnEnviar" type="submit" class="btn btn-primary">Guardar</button>
                {{-- @endif --}}

                <a href="javascript:history.back()" class="btn btn-danger" style="margin-right: 2%;"
                    role="button">Cancelar</a>
                {{-- @else  <button type="submit" class="btn btn-primary">Cancelar</button>
                @endif --}}
            </div>

        </div>

    </div>


    {{-- Ventana Modal --}}
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cargar Evidencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center"><b>Subir archivos</b></h2>
                            {{-- <div class="card">
                                <div class="card-body">
                                    <form action="{{route('admin.files.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="file" id="" accept="image/*">
                                            <br>
                                            @error('file')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Subir imagen</button>
                                    </form>
                                </div>
                            </div> --}}


                            <form action="{{ route('asistencia.evidencia') }}" method="POST" class="dropzone"
                                id="my-awesome-dropzone">
                                @csrf
                                <input type="hidden" name="grupo_id" id="grupo_id" value="{{ $nombreGrupo->id }}">
                                <input type="hidden" name="clase_id" id="clase_id" value="{{ $clase->id }}">
                                {{-- <div class="col-xs-12 col-lg-3">
                                    <button class="btn btn-danger">
                                        <i class="icon-trash fa fa-trash"></i>
                                        <span>Eliminar</span>
                                    </button> 
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <br>
                    <div class="col-lg-12">
                        <div class="text-center" style="text-align: center;">
                            <h5 class="title"><b>Ver archivos guardados</b></h5>
                            <a class="btn btn-primary"
                                href="{{ url('Ver/evidencia/' . $nombreGrupo->id . '/' . $clase->id) }}">
                                <i class="fa fa-eye"></i> Ver archivos
                            </a>

                        </div>
                        <br>
                    </div>


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <br>
    <br>

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


    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/r-2.2.9/datatables.min.css" />

    <link rel="stylesheet" href=" {{ asset('vendor/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@stop

@section('js')

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        Dropzone.options.myAwesomeDropzone = {

            dictDefaultMessage: "Arrastre un archivo PDF o imagen al recuadro para subir la evidencia",
            acceptedFiles: ".png,.jpg,.jpeg,application/pdf,.xls,.xlsx,.csv", // configuro los tipos de archivos que se aceptan en la aplicacion
        };
    </script>

    <script src=" {{ asset('vendor/toastr/toastr.min.js') }}"></script>
    @if (session('info'))
        <script>
            $(document).Toasts('create', {
                class: 'bg-info',
                title: 'Mensaje de alerta',
                body: 'Muy bien, el grupo se ha actualizado con exito.'
            })
        </script>
    @else
        @if (session('info2'))
            <script>
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Mensaje de alerta',
                    body: 'Muy bien, el grupo se ha agregado con exito.'
                })
            </script>
        @endif


    @endif

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.6.0/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/sp-1.4.0/sl-1.3.3/datatables.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
    </script>

    <script>
        $("#activarTodos").click(function() {

            $('input[type="checkbox"]').attr('checked', $("#activarTodos").is(':checked'));

            $('input[name="id_estudiantes"]').each(function(element) {
                if ($(this).is(':checked')) {
                    attdState.addClass('btn-success').text(@json(__('Presente')));
                } else {
                    attdState.addClass('btn-danger').text(@json(__('Ausente')));
                }
            });

        });
    </script>



    <script>
        $("#btnEnviar").click(function() {
            var arrTodo = new Array();
            let Urlstore = "{{ route('asistencia.store') }}"
            /*Agrupamos todos los input con name=cbxEstudiante*/
            $('input[name="id_estudiantes"]').each(function(element) {
                var item = {};
                item.id_clases = $(':hidden#id_clases').val();
                item.start = $(':hidden#start').val();
                item.end = $(':hidden#end').val();
                item.id_estudiantes = this.value;
                item.present = this.checked;
                arrTodo.push(item);
            });
            /*Creao el  objeto para enviarlo al servidor*/
            var toPost = JSON.stringify(arrTodo);
            //console.log(toPost);
            //console.log(id_clase);
            $.ajax({
                data: {
                    toPost,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                type: "POST",
                url: Urlstore,
                success: function(data) {
                    //alert(data);
                    if (data == 0) {

                        toastr["error"]("Clase terminada, no es posible modificar la asistencia ",
                            "Alerta de error");
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

                    } else {

                        toastr["success"](data, "Mensaje de alerta");
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

                    }

                }
            });
        });
    </script>


    <script>
        $('input[type="checkbox"]').change(function() {
            var attdState = $(this).parent().parent().parent().find('.attdState').removeClass(
                'btn-success btn-danger');
            if ($(this).is(':checked')) {
                attdState.addClass('btn-success').text(@json(__('Presente')));
            } else {
                attdState.addClass('btn-danger').text(@json(__('Ausente')));
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            var idioma = {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad",
                    "collection": "Colección",
                    "colvisRestore": "Restaurar visibilidad",
                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                    "copySuccess": {
                        "1": "Copiada 1 fila al portapapeles",
                        "_": "Copiadas %d fila al portapapeles"
                    },
                    "copyTitle": "Copiar al portapapeles",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todas las filas",
                        "1": "Mostrar 1 fila",
                        "_": "Mostrar %d filas"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                    "fillHorizontal": "Rellenar celdas horizontalmente",
                    "fillVertical": "Rellenar celdas verticalmentemente"
                },
                "decimal": ",",
                "searchBuilder": {
                    "add": "Añadir condición",
                    "button": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condición",
                    "conditions": {
                        "date": {
                            "after": "Despues",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "notBetween": "No entre",
                            "notEmpty": "No Vacio",
                            "not": "Diferente de"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vacio",
                            "equals": "Igual a",
                            "gt": "Mayor a",
                            "gte": "Mayor o igual a",
                            "lt": "Menor que",
                            "lte": "Menor o igual que",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío",
                            "not": "Diferente de"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vacío",
                            "endsWith": "Termina en",
                            "equals": "Igual a",
                            "notEmpty": "No Vacio",
                            "startsWith": "Empieza con",
                            "not": "Diferente de"
                        },
                        "array": {
                            "not": "Diferente de",
                            "equals": "Igual",
                            "empty": "Vacío",
                            "contains": "Contiene",
                            "notEmpty": "No Vacío",
                            "without": "Sin"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangría",
                    "title": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "value": "Valor"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de búsqueda",
                        "_": "Paneles de búsqueda (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Sin paneles de búsqueda",
                    "loadMessage": "Cargando paneles de búsqueda",
                    "title": "Filtros Activos - %d"
                },
                "select": {
                    "1": "%d fila seleccionada",
                    "_": "%d filas seleccionadas",
                    "cells": {
                        "1": "1 celda seleccionada",
                        "_": "$d celdas seleccionadas"
                    },
                    "columns": {
                        "1": "1 columna seleccionada",
                        "_": "%d columnas seleccionadas"
                    }
                },
                "thousands": ".",
                "datetime": {
                    "previous": "Anterior",
                    "next": "Proximo",
                    "hours": "Horas",
                    "minutes": "Minutos",
                    "seconds": "Segundos",
                    "unknown": "-",
                    "amPm": [
                        "am",
                        "pm"
                    ]
                },
                "editor": {
                    "close": "Cerrar",
                    "create": {
                        "button": "Nuevo",
                        "title": "Crear Nuevo Registro",
                        "submit": "Crear"
                    },
                    "edit": {
                        "button": "Editar",
                        "title": "Editar Registro",
                        "submit": "Actualizar"
                    },
                    "remove": {
                        "button": "Eliminar",
                        "title": "Eliminar Registro",
                        "submit": "Eliminar",
                        "confirm": {
                            "_": "¿Está seguro que desea eliminar %d filas?",
                            "1": "¿Está seguro que desea eliminar 1 fila?"
                        }
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                    },
                    "multi": {
                        "title": "Múltiples Valores",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                    }
                },
                "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
            }


            $('#TablaEstudiante').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": idioma,
                "lengthMenu": [
                    [-1],
                    ["Todo"]
                ],

                dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                        //Botón para Excel
                        extend: 'excelHtml5',
                        footer: true,
                        title: 'REPORTE DE ESTUDIANTES',
                        filename: 'Reporte de Estudiantes por grupos',

                        //Aquí es donde generas el botón personalizado
                        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                    },
                    //Botón para PDF
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        footer: true,
                        title: 'REPORTE DE ESTUDIANTES',
                        filename: 'Reporte de Estudiantes por grupos',
                        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    //Botón para copiar
                    {
                        extend: 'copyHtml5',
                        footer: true,
                        title: 'REPORTE DE ESTUDIANTES',
                        filename: 'Reporte de Estudiantes por grupos',
                        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    //Botón para print
                    {
                        extend: 'print',
                        footer: true,
                        filename: 'Reporte de Estudiantes por grupos',
                        text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                    },
                    //Botón para cvs
                    {
                        extend: 'csvHtml5',
                        footer: true,
                        filename: 'Reporte de Estudiantes por grupos',
                        text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                    },
                    {
                        extend: 'colvis',
                        text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                        postfixButtons: ['colvisRestore']
                    }
                ]

            });

        });
    </script>

@stop
