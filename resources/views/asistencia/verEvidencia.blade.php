@extends('adminlte::page')

@section('title', 'Grupo | GEAM')
<link rel="icon" href="public/favicons/favicon.ico">

<link rel="stylesheet" type="text/css" href="{{ asset('css/switch.css') }}">

@csrf

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4-4.6.0/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/sp-1.4.0/sl-1.3.3/datatables.min.css" />

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
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

    <div class="col-12">

        <div class="card card-primary">

            <div class="card-header">

                <h4 class="card-title"> EVIDENCIA DE LA CLASE <b>{{ $clase->title }}</b> DEL GRUPO DE
                    <b>{{ $nombreGrupo->name_group }}</b>
                </h4>

                {{-- @isset($infoevidencia)
                    <button type="button" class="btn btn-success   float-right" data-toggle="modal" data-target="#modal-xl">
                        Cargar evidencia
                    </button>
                @endisset --}}

            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($infoevidencia as $i)

                        @php
                            $ext = pathinfo($i->url, PATHINFO_EXTENSION);
                        @endphp

                        @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'svg')

                            <div class="col-sm-2">
                                <a href="{{ $i->url }}" data-toggle="lightbox" data-title="Evidencia"
                                    data-gallery="gallery">
                                    <img src="{{ $i->url }}" class="img-fluid mb-2" alt="white sample" />


                                    <div class="form-group text-center">
                                        <a href=""></a>
                                        <form action="{{ route('evidencia.eliminar', $i) }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm confirm">
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>


                                </a>
                            </div>

                        @endif

                        @if ($ext == 'pdf')

                            <div class="col-sm-1">
                                <a href="#" data-toggle="modal" data-target="#modal-x{{ $i->id }}">
                                    <img src="{{ asset('/storage/Imgdefecto/pdf.png') }}" class="img-fluid mb-2"
                                        alt="white sample" />

                                </a>

                                <div class="form-group text-center">
                                    <a href=""></a>
                                    <form action="{{ route('evidencia.eliminar', $i) }}" class="d-inline"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm confirm">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </div>

                            <div class="modal fade" id="modal-x{{ $i->id }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Evidencia</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>


                                        <div class="container">
                                            <embed src="{{ $i->url }}" type="application/pdf" width="100%"
                                                height="850px" />

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                        @if ($ext == 'xlsx')

                            <div class="col-sm-1">
                                <a href="{{ $i->url }}">
                                    <img src="{{ asset('/storage/Imgdefecto/xls.png') }}" class="img-fluid mb-2"
                                        alt="white sample" />
                                </a>


                                <div class="form-group text-center">
                                    <a href=""></a>
                                    <form action="{{ route('evidencia.eliminar', $i) }}" class="d-inline"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm confirm">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </div>

                        @endif

                    @endforeach

                </div>
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

    {{-- para la galeria de fotos --}}

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@stop

@section('js')

    <script>
        $(".confirm").click(function() {
            var bool = confirm("Seguro de eliminar el dato?");
            if (bool) {
                alert("se elimino correctamente");
            } else {
                alert("cancelo la solicitud");
            }
        });

        <
        script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" >
    </script>





    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        Dropzone.options.myAwesomeDropzone = {

            dictDefaultMessage: "Arrastre un archivo PDF o imagen al recuadro para subir la evidencia",
            acceptedFiles: ".png,.jpg,.jpeg,application/pdf,.xls,.xlsx,.csv", // configuro los tipos de archivos que se aceptan en la aplicacion
        };
    </script>

    {{-- @if (session('info'))
        <script>
            $(document).Toasts('create', {
                class: 'bg-info',
                title: 'Mensaje de alerta',
                body: 'Muy bien, el estudiante se ha actualizado con exito.'
            })
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
    @endif --}}



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.6.0/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/sp-1.4.0/sl-1.3.3/datatables.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
    </script>



    {{-- para la galeria de fotos --}}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"
        integrity="sha512-YibiFIKqwi6sZFfPm5HNHQYemJwFbyyYHjrr3UT+VobMt/YBo1kBxgui5RWc4C3B4RJMYCdCAJkbXHt+irKfSA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js.map">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js.map">
    </script>


    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>


@stop
