@extends('adminlte::page')

@section('content_header')
<h1><b>Pagos/ Registro de un nuevo pago </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos del cliente</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <i class="fas fa-id-card"></i> {{ $prestamo->cliente->nro_documento }}<br><br>
                            <i class="fas fa-user"></i> {{ $prestamo->cliente->apellidos }}. {{ $prestamo->cliente->nombres }}<br><br>
                            <i class="fas fa-calendar"></i> {{ $prestamo->cliente->fecha_nacimiento }}<br><br>
                            <i class="fas fa-user-check"></i> {{ $prestamo->cliente->genero }}<br><br>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <i class="fas fa-envelope"></i> {{ $prestamo->cliente->email }}<br><br>
                            <i class="fas fa-phone"></i> {{ $prestamo->cliente->celular }}<br><br>
                            <i class="fas fa-phone"></i> {{ $prestamo->cliente->ref_celular }}<br><br>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos del prestamo</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Monto prestado</b><br>
                            <i class="fas fa-money-bill-wave"></i> {{ $prestamo->monto_prestado }}<br><br>

                            <b>Tasa de interes</b><br>
                            <i class="fas fa-percent"></i> {{ $prestamo->tasa_interes }}<br><br>

                            <b>Modalidad</b><br>
                            <i class="fas fa-calendar-alt"></i> {{ $prestamo->modalidad }}<br><br>

                            <b>Nro de cuotas</b><br>
                            <i class="fas fa-list"></i> {{ $prestamo->nro_cuotas }}<br><br>

                            <b>Monto total</b><br>
                            <i class="fas fa-money-bill-alt"></i> {{ $prestamo->monto_total }}<br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6    ">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos de los pagos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-stipped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"># cuotas</th>
                                    <th style="text-align: center;">Monto de la cuota</th>
                                    <th style="text-align: center;">F. pago</th>
                                    <th style="text-align: center;">Estado</th>
                                    <th style="text-align: center;">F. Canc</th>
                                    <th style="text-align: center;">Accion</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $contador = 1;
                                @endphp
                                @foreach($pagos as $pago)

                                <tr>
                                    <td style="text-align: center;">{{$contador++}}</td>
                                    <td style="text-align: center;">{{$pago->monto_pagado}}</td>
                                    <td style="text-align: center;">{{$pago->fecha_pago}}</td>
                                    <td style="text-align: center;">{{$pago->estado}}</td>
                                    <td style="text-align: center;">{{$pago->fecha_cancelado}}</td>
                                    <td style="text-align: center;">
                                        @if($pago->estado == "Confirmado")
                                        <button type="button" class="btn btn-danger btn-sm">Cancelado</button>
                                        <a href="{{url('/admin/pagos/comprobantedepago',$pago->id )}}" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></a>
                                        @else
                                        <form action="{{ url('/admin/pagos/create', $pago->id) }}" method="post" id="miFormulario{{$pago->id}}" onsubmit="return preguntar(event, {{$pago->id}});">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" style="border-radius: 4px;">
                                                <i class="fas fa-money-bill"> pagar</i>
                                            </button>
                                        </form>
                    </div>
                    <script>
                        function preguntar(event, configuracionId) {
                            event.preventDefault(); // Evita el envío del formulario por defecto

                            Swal.fire({
                                title: "Estas seguro de registrar este pago?",
                                text: "",
                                icon: 'question',
                                showDenyButton: true,
                                confirmButtonText: 'Si',
                                confirmButtonColor: 'rgba(24, 213, 21, 1)',
                                denyButtonColor: '#c02727ff',
                                denyButtonText: 'No',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('miFormulario' + configuracionId).submit();
                                }
                            });

                            return false; // Importante: previene que el form se envíe hasta que decidas
                        }
                    </script>
                    @endif
                    </td>
                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>

@stop


@section('css')

@stop

@section('js')


@stop