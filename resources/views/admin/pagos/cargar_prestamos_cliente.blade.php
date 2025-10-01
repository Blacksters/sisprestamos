@extends('adminlte::page')

@section ('content_header')
<h1><b>Prestamos del cliente {{$cliente->apellidos." ".$cliente->nombre}}</b></h1>
<hr>
@stop

@section ('content')
<div class="row">

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Historial de prestamo</h3>


                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                    <thead>
                        <rt>
                            <th style="text-align: center">Nro.</th>
                            <th style="text-align: center">Cedula</th>
                            <th style="text-align: center">Nombres y Apellidos</th>
                            <th style="text-align: center">Monto prestado</th>
                            <th style="text-align: center">Tasa de interes</th>
                            <th style="text-align: center">Modalidad </th>
                            <th style="text-align: center">Nro de cuotas</th>
                            <th style="text-align: center">Monto total</th>
                            <th style="text-align: center">Fecha de inicio</th>
                            <th style="text-align: center">Estado del prestamo</th>
                            <th style="text-align: center">Accion</th>



                        </rt>
                    </thead>
                    <tbody>
                        @php
                        $contador = 1;
                        @endphp
                        @foreach ($prestamos as $prestamo)
                        <tr>
                            <td style="text-align: center;">{{$contador++}}</td>
                            <td>{{$prestamo->cliente->nro_documento}}</td>
                            <td>{{$prestamo->cliente->nombre." ".$prestamo->cliente->apellidos}}</td>
                            <td style="text-align: center;">{{$prestamo->monto_prestado}}</td>
                            <td style="text-align: center;">{{$prestamo->tasa_interes}}</td>
                            <td style="text-align: center;">{{$prestamo->modalidad}}</td>
                            <td style="text-align: center;">{{$prestamo->nro_cuotas}}</td>
                            <td style="text-align: center;">{{$prestamo->monto_total}}</td>
                            <td style="text-align: center;">{{$prestamo->fecha_inicio}}</td>
                            <td style="text-align: center;">
                                @if($prestamo->estado == "Pendiente")
                                <button class="btn btn-danger">{{$prestamo->estado}}</button>
                                @else
                                <button class="btn btn-succes">{{$prestamo->estado}}</button>

                                @endif
                            </td>



                            <!-- botones de accion -->


                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('/admin/pagos/prestamos/create', $prestamo->id) }}" style="border-radius: 4px;" class="btn btn-warning btn-sm">
                                        <i class="fas fa-money-bill-wave"> Ver pagos</i>
                                    </a>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section ('css')

<style>
    .select2-container .select2-selection--single {
        height: 40px !important;
        /*ajusta el tamño total del selectzz*/

    }


    /* Fondo transparente y sin bordes en el contenedor */
    #example1_wrapper .dt-buttons {
        background-color: transparent;
        box-shadow: none;
        border: none;
        display: flex;
        justify-content: center;
        /* Centrar los botones */
        gap: 10px;
        /* Espaciado entre botones */
        margin-bottom: 15px;
        /* Separar botones de la tabla */
    }

    /* Estilo personalizado para los botones */
    #example1_wrapper .btn {
        color: #fff;
        /* Color del texto en blanco */
        border-radius: 4px;
        /* Bordes redondeados */
        padding: 5px 15px;
        /* Espaciado interno */
        font-size: 14px;
        /* Tamaño de fuente */
    }

    /* Colores por tipo de botón */
    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
        border: none;
    }

    .btn-default {
        background-color: #6c7176;
        color: #212529;
        border: none;
    }
</style>


@stop

@section('js')

@endsection