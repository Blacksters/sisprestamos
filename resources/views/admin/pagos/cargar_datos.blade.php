@extends('adminlte::page')

@section('content_header')
<h1><b>Pagos / Registro de un nuevo pago </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del cliente</h3>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <label for="">Búsqueda del cliente</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-id-card"></i>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <select name="cliente_id" id="" class="form-control select2" style="width: 100%;">
                                    <option value="">Buscar cliente...</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}" {{$datoscliente->id == $cliente->id ? 'selected': ''}}>
                                        {{$cliente->nro_documento}} - {{$cliente->nombre}} {{$cliente->apellidos}}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                @error('cliente_id')
                <small style="color: red;">{{ $message }}</small>
                @enderror
                <!-- seleccion -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
</div>
</div>

<div class="col-md-3">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Datos del cliente</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <i class="fas fa-id-card"></i> {{ $datoscliente->nro_documento }}<br><br>
                        <i class="fas fa-user"></i> {{ $datoscliente->apellidos }} {{ $datoscliente->nombre }}<br><br>
                        <i class="fas fa-calendar"></i> {{ $datoscliente->fecha_nacimiento }}<br><br>
                        <i class="fas fa-user-check"></i> {{ $datoscliente->genero }}<br><br>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        <i class="fas fa-envelope"></i> {{ $datoscliente->email }}<br><br>
                        <i class="fas fa-phone"></i> {{ $datoscliente->celular }}<br><br>
                        <i class="fas fa-phone"></i> {{ $datoscliente->ref_celular }}<br><br>
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
                            <i class="fas fa-calender-alt"></i> {{ $prestamo->modalidad }}<br><br>

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

@stop


@section('css')
<style>
    .select2-container .select2-selection--single {
        height: 40px !important;
        /*ajusta el tamño total del selectzz*/

    }
</style>
@stop

@section('js')
<script>
    $('.select2').select2({});

    $('.select2').on('change', function() {
        var id = $(this).val();
        //alert(cliente_id);
        if (id) {
            window.location.href = "{{ url('/admin/pagos/create') }}" + "/" + id;
        }
    });

    function calcularPrestamo() {
        // Obtener valores del formulario
        const montoPrestado = parseFloat(document.getElementById('monto_prestado').value);
        const tasaInteres = parseFloat(document.getElementById('tasa_interes').value) / 100;
        const modalidad = document.getElementById('modalidad').value;
        const nroCuotas = parseInt(document.getElementById('nro_cuotas').value);

        if (isNaN(montoPrestado) || isNaN(tasaInteres) || isNaN(nroCuotas) || montoPrestado <= 0 || tasaInteres < 0 || nroCuotas <= 0) {
            alert("Por favor ingrese valores validos");
            return;
        }

        // Ajustar la tasa de interés segun la modalidad
        let tasaInteresAjustada = 0;
        switch (modalidad) {
            case "Diario":
                tasaInteresAjustada = tasaInteres / 30; // Suponiendo 30 dias en un mes
                break;
            case "Semanal":
                tasaInteresAjustada = tasaInteres / 4; // Suponiendo 4 semanas en un mes
                break;
            case "Quincenal":
                tasaInteresAjustada = tasaInteres / 2; // Suponiendo 2 quincenas en un mes
                break;
            case "Mensual":
                tasaInteresAjustada = tasaInteres; // Tasa mensual directa
                break;
            case "Anual":
                tasaInteresAjustada = tasaInteres / 12; // Multiplicar por 12 para convertir a mensual
                break;
            default:
                alert("Modalidad no válida.");
                return;
        }

        // Cálculo del interés total
        const interesTotal = montoPrestado * tasaInteresAjustada * nroCuotas;

        // Cálculo del total a pagar
        const totalACancelar = montoPrestado + interesTotal;

        // Cálculo de la cuota fija
        const cuota = totalACancelar / nroCuotas;

        $('#monto_cuota').val(cuota.toFixed(2));
        $('#monto_cuota2').val(cuota.toFixed(2));
        $('#monto_interes').val(interesTotal.toFixed(2));
        $('#monto_final').val(totalACancelar.toFixed(2));
        $('#monto_final2').val(totalACancelar.toFixed(2));




        // Mostrar los resultados en el HTML
        /*alert(`Resultado del préstamo:
        Monto Prestado: ${montoPrestado}
        Tasa de Interés Ajustada: ${(tasaInteresAjustada * 100).toFixed(2)}%
        Modalidad: ${modalidad}
        Número de Cuotas: ${nroCuotas}
        Interés Total: ${interesTotal.toFixed(2)}
        Cuota por Pagar: ${cuota.toFixed(2)}
        Total a Cancelar: ${totalACancelar.toFixed(2)}`);*/
    }
</script>

@stop