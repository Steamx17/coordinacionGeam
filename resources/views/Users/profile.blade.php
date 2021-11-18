@extends('adminlte::page')

@section('title', 'Usuarios')



@section('content_header')


    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ $rol[0] }} </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/300/300"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"> {{ $userx->name }} </h3>

                        <p class="text-muted text-center"> </p>


                        <a class="btn btn-danger btn-flat float-right  btn-block Salirx2" href="#">
                            <i class="fa fa-fw fa-power-off"></i>
                            {{ __('adminlte::adminlte.log_out') }}
                        </a>
                        <form id="logout-form" action="" method="POST" style="display: none;">
                            @if (config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                            @endif
                            {{ csrf_field() }}
                        </form>

                    </div>

                </div>

            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Configuaracion</a></li>

                            <li class="nav-item"><a class="nav-link" href="#settings"
                                    data-toggle="tab">{{-- <i
                                        class="fa fa-user"></i> --}} Cambiar Password</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">

                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">



                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
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

@stop

@section('js')

    @if (session('info'))
        <script>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Mensaje de alerta',
                body: 'Muy bien, se asigno los roles correctamente.'
            })
        </script>
    @endif

    <script>
        $(".Salirx2").click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            var linkURL = $(this).attr("href");
            SalirdelSistema(linkURL);
        });

        function SalirdelSistema(linkURL) {
            swal({
                title: "¿Quieres salir del sistema?",
                text: "La sesión actual se cerrará y saldrás del sistema.",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#007BFF",
                cancelButtonColor: "#DC3545",
                confirmButtonText: "Si, salir!",
                cancelButtonText: "No, cancelar!"
            }).then(function(result) {
                console.log(result);
                if (result.value) {
                    window.location.href = event.preventDefault();
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

@stop
