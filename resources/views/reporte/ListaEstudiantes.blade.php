{{-- {{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Estudiantes</title>
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
   
   
        <div class="container d-flex" style="display: flex; justify-content-between;">
            
            <picture style="border: 1px solid red;">
                <img  src="https://pbs.twimg.com/profile_images/985921545997611009/XPoMKvAx_400x400.jpg" />
            </picture>

            
                 <div style="border: 1px solid blue;">
                  <h4 ><strong>CONTROL DE ASISTENCIA /EVALUACIONES SIMULACROS SEGUIMIENTO ACADÉMICO</strong></h4> 
                </div>
        </div>

       


    <table class="table table-bordered table-sm text-center">
        <thead>
            <tr style="font-size:14px;">
                <th scope="col">#</th>
                <th scope="col">NOMBRES Y APELLIDOS DEL ESTUDIANTE </th>
                <th scope="col">INSTITUCIÓN EDUCATIVA</th>
                <th scope="col">CELULAR<br><small>(ESTUDIANTE)</small></th>
                <th scope="col">NOMBRE DEL ACUDIENTE </th>
                <th scope="col">CELULAR<br><small>(ACUDIENTE)</small></th>
                <th scope="col">FIRMA<br><small>(ESTUDIANTE)</small></th>



            </tr>


            </tr>
        </thead>
        <tbody>
            @foreach ($detalle as $key => $detallex)

                <tr style="font-size:12px;">
                    <td> {{ ++$key }}</td>
                    <td> {{ $detallex->names_students }}</td>
                    <td> </td>

                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>



                </tr>
            @endforeach

        </tbody>
    </table>

    <footer>
        <p><strong> </strong></p>
    </footer>
</body>

</html> --}}





<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Estudiantes</title>
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .table th,
        .table td {
            border-top: none !important;
            border-left: none !important;
        }

        .fixed-table-container {
            border: 0px;
        }

        .table th {
            border-bottom: none !important;
        }

        .table:last-child {
            border: none !important;
        }


        table.tabla_sin {


            border-collapse: collapse;


            border: none;


        }


        td.celda_sin {


            padding: 0;


        }

    </style>
</head>

<body>

    {{-- <table class="table table-sm text-center tabla_sin ">

        <tbody>
            <tr>
                <td width="128px " rowspan="2"><img src="{{ public_path('css/LOGO.jpg') }}" alt="" width="128" />
                </td>
                <td colspan="2">
                    <h3><strong>CONTROL DE ASISTENCIA /EVALUACIONES SIMULACROS SEGUIMIENTO ACADÉMICO</strong></h3>
                </td>
            </tr>

        </tbody>
    </table> --}}


    <table class="table table-sm  tabla_sin">
        <tbody>
            <tr>
                <td width="128" class="text-center"> <img src="{{ public_path('css/LOGO.jpg') }}" alt=""
                        width="128" /></td>
                <td colspan="16" class="text-center">
                    <h3><strong>CONTROL DE ASISTENCIA /EVALUACIONES SIMULACROS SEGUIMIENTO ACADÉMICO</strong></h3>
                   
                    <table id="tabla2" class="table table-sm  tabla_sin " style="font-size:12px;">
                        <tr>
                            <td width=140>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEDE
                                PRESABER:</td>
                            <td colspan="9" style="border: 1px solid #DEE2E6;"></td>
                            <td width=70>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GRADO:
                            </td>
                            <td colspan="1" style="border: 1px solid #DEE2E6;"></td>
                            <td width=40>&nbsp;&nbsp;&nbsp;&nbsp;FECHA:</td>
                            <td colspan="3" style="border: 1px solid #DEE2E6;"></td>
                        </tr>
                        <tr>
                            <td colspan="16"></td>
                        </tr>
                        <tr>
                            <td width=140>NOMBRE DEL JEFE DEL SALÓN:</td>
                            <td colspan="9" style="border: 1px solid #DEE2E6;"></td>
                            <td width=70>AREA/CELULAR:</td>
                            <td colspan="5" style="border: 1px solid #DEE2E6;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-sm text-center tabla_sin" width="100%">
        <thead>
            <tr style="font-size:14px;">
                <th scope="col" class="text-center">#</th>
                <th scope="col">NOMBRES Y APELLIDOS DEL ESTUDIANTE </th>
                <th scope="col">INSTITUCIÓN EDUCATIVA</th>
                <th scope="col">CELULAR<br><small>(ESTUDIANTE)</small></th>
                <th scope="col">NOMBRE DEL ACUDIENTE </th>
                <th scope="col">CELULAR<br><small>(ACUDIENTE)</small></th>
                <th scope="col">FIRMA<br><small>(ESTUDIANTE)</small></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle as $key => $detallex)

                <tr style="font-size:12px;">
                    <td> {{ ++$key }}</td>
                    <td> {{ $detallex->names_students }}</td>
                    <td> </td>

                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>

                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
