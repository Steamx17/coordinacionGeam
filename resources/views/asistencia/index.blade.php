@extends('adminlte::page')

@section('title', 'Dashboard')
<link rel="icon" href="public/favicons/favicon.ico">


{{-- <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" /> --}}


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de clases para tomar la asistencia</h1>
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
            {{-- <a class="btn btn-primary" href="{{ route('asistencia.create') }}"> Registrar Asistencia</a> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- <table id="example1" class="table table-bordered table-striped">-->

            <table id="TablaAsistencia" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha-Hora(Inicio/Final)</th>
                        {{-- <th scope="col">Duracion de la clase</th> --}}
                        {{-- <th scope="col">Materia </th> --}}
                        <th scope="col">Clase </th>
                        <th scope="col">Docente</th>
                        <th colspan="2">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clase as $ClaseAsistencia)
                        <tr>
                            <td> {{ $ClaseAsistencia->clase_id }} </td>
                            <td> {{ $ClaseAsistencia->start . ' / ' . $ClaseAsistencia->end }}</td>
                            {{-- <td> {{ $ClaseAsistencia->ObtenerAsignatura($ClaseAsistencia->docentes_id) }} </td> --}}
                            <td> {{ $ClaseAsistencia->title }} </td>
                            <td> {{ $ClaseAsistencia->ObtenerDocente($ClaseAsistencia->docentes_id) }} </td>

                            <td>
                                <a class="btn btn-info" style="width: 80%; "
                                    href="{{ url('Asistencia/Tomar/' . $ClaseAsistencia->grupos_id . '/' . $ClaseAsistencia->clase_id) }}">
                                    <i class=" fas fa-solid fa-eye"> </i>

                                    @if ($ClaseAsistencia->prueba($ClaseAsistencia->grupos_id) != null)
                                        {{ $ClaseAsistencia->prueba($ClaseAsistencia->grupos_id) }} Asistencia
                                    @else
                                        0
                                    @endif

                                </a>
                            <td>
                                <a class="btn btn-primary"
                                    href="{{ url('Ver/evidencia/' . $ClaseAsistencia->grupos_id . '/' .  $ClaseAsistencia->clase_id) }}">
                                    <i class="fa fa-eye"></i> Ver evidencia
                                </a>

                            </td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <br>
    <br>

    <footer class="main-footer">
        @yield('footer')

        <strong>Copyright &copy;<?php echo date('Y'); ?><a href="#"> Sistema de gesti??n acad??mica - Grupo Educativo Abel Mendoza,
                desarrollado por Edison Guzman.</a> </strong>

        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>

    </footer>


@stop

@section('css')

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/r-2.2.9/datatables.min.css" />

@stop

@section('js')


    @if (session('info'))
        <script>
            $(document).ready(function() {

                //tipos de mensajes succes, info, warning, error
                //titulo y mensaje de texto
                toastr["warning"]("Mensaje de prueba", "Demo");

                toastr.options = {
                    //primeras opciones
                    "closeButton": false, //boton cerrar
                    "debug": false,
                    "newestOnTop": false, //notificaciones mas nuevas van en la parte superior
                    "progressBar": true, //barra de progreso hasta que se oculta la notificacion
                    "preventDuplicates": false, //para prevenir mensajes duplicados

                    "onclick": null,

                    //Posici??n de la notificaci??n
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
    @else
        @if (session('info2'))
            <script>
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Mensaje de alerta',
                    body: 'Muy bien, el estudiante se ha agregado con exito.'
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
        $(document).ready(function() {
            var idioma = {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ning??n dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "??ltimo",
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
                    "collection": "Colecci??n",
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
                    "add": "A??adir condici??n",
                    "button": {
                        "0": "Constructor de b??squeda",
                        "_": "Constructor de b??squeda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condici??n",
                    "conditions": {
                        "date": {
                            "after": "Despues",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vac??o",
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
                            "notEmpty": "No vac??o",
                            "not": "Diferente de"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vac??o",
                            "endsWith": "Termina en",
                            "equals": "Igual a",
                            "notEmpty": "No Vacio",
                            "startsWith": "Empieza con",
                            "not": "Diferente de"
                        },
                        "array": {
                            "not": "Diferente de",
                            "equals": "Igual",
                            "empty": "Vac??o",
                            "contains": "Contiene",
                            "notEmpty": "No Vac??o",
                            "without": "Sin"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangr??a",
                    "title": {
                        "0": "Constructor de b??squeda",
                        "_": "Constructor de b??squeda (%d)"
                    },
                    "value": "Valor"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de b??squeda",
                        "_": "Paneles de b??squeda (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Sin paneles de b??squeda",
                    "loadMessage": "Cargando paneles de b??squeda",
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
                            "_": "??Est?? seguro que desea eliminar %d filas?",
                            "1": "??Est?? seguro que desea eliminar 1 fila?"
                        }
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">M??s informaci??n&lt;\\\/a&gt;).<\/a>"
                    },
                    "multi": {
                        "title": "M??ltiples Valores",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aqu??, de lo contrario conservar??n sus valores individuales.",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                    }
                },
                "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
            }


            $('#TablaAsistencia').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": idioma,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todo"]
                ],

                dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                        //Bot??n para Excel
                        extend: 'excelHtml5',
                        footer: true,
                        title: 'REPORTE DE ESTUDIANTES',
                        filename: 'Reporte de Estudiantes',

                        //Aqu?? es donde generas el bot??n personalizado
                        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                    },
                    //Bot??n para PDF
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        footer: true,
                        title: 'REPORTE DE ESTUDIANTES',
                        filename: 'Reporte de Estudiantes',
                        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    //Bot??n para copiar
                    {
                        extend: 'copyHtml5',
                        footer: true,
                        title: 'REPORTE DE ESTUDIANTES',
                        filename: 'Reporte de Estudiantes',
                        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    //Bot??n para print
                    {
                        extend: 'print',
                        footer: true,
                        filename: 'Reporte de Estudiantes',
                        text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                    },
                    //Bot??n para cvs
                    {
                        extend: 'csvHtml5',
                        footer: true,
                        filename: 'Reporte de Estudiantes',
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
