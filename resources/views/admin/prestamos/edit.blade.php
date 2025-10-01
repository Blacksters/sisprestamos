@extends('adminlte::page')

@section('content_header')
<h1><b>Prestamos / Modificar datos del prestamo </b></h1>
<hr>
@stop

@section('content')
<form action="{{url ('admin/prestamos', $prestamo->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
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
                                        <option value="{{$cliente->id}}" {{$prestamo->cliente_id == $cliente->id ? 'selected': ''}}>
                                            {{$cliente->nro_documento." - ".$cliente->nombre." ".$cliente->apellidos}}
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

                    <hr>

                    <div class="" id="contenido_cliente" style="display: block;">

                        <div class="row">
                            <!-- Cedula -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Cédula</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nro_documento" name="nro_documento" value="{{$prestamo->cliente->nro_documento}}" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Nombres -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nombres del cliente</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$prestamo->cliente->nombre}}" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Apellidos -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Apellidos del cliente</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{$prestamo->cliente->apellidos}}" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha nacimiento -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="fecha_nacimiento" value="{{ $prestamo->cliente->fecha_nacimiento}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Segunda fila -->
                        <div class="row">
                            <!-- Género -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Género</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                        </div>

                                        <input type="text" class="form-control" id="genero" name="genero" value="{{ $prestamo->cliente->genero}}" placeholder="Seleccione aquí..." disabled>


                                    </div>

                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $prestamo->cliente->email}}" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Celular -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Celular </b></label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="celular" name="celular" value="{{ $prestamo->cliente->celular}}" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Celular de referencia -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Celular de referencia</label>
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="ref_celular" name="ref_celular" value="{{ $prestamo->cliente->ref_celular}}" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Datos del prestamo</h3>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Monto del prestamo</label>
                                <input type="text" id="monto_prestado" value="{{ $prestamo->monto_prestado}}" name="monto_prestado" class="form-control" required>
                                @error('monto_prestado')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group mb-3">
                                <label for="">Tasa Interes</label>
                                <input type="text" id="tasa_interes" name="tasa_interes" value="{{ $prestamo->tasa_interes}}" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('tasa_interes')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Modalidad</label>
                                <select name="modalidad" id="modalidad" class="form-control">
                                    <option value="Diario" {{$prestamo->modalidad == 'Diario' ? 'selected': ''}}>Diario</option>
                                    <option value="Semanal" {{$prestamo->modalidad == 'Semanal' ? 'selected': ''}}>Semanal</option>
                                    <option value="Quincenal" {{$prestamo->modalidad == 'Quincenal' ? 'selected': ''}}>Quincenal</option>
                                    <option value="Mensual" {{$prestamo->modalidad == 'Mensual' ? 'selected': ''}}>Mensual</option>
                                    <option value="Anual" {{$prestamo->modalidad == 'Anual' ? 'selected': ''}}>Anual</option>
                                </select>
                                @error('modalidad')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for=""># de cuotas</label>
                                <input type="number" name="nro_cuotas" value="{{ $prestamo->nro_cuotas}}" id="nro_cuotas" class="form-control" max="14" oninput="if(this.value > 14) this.value = 14;" min="1" required>
                                @error('nro_cuotas')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Fecha del prestamo</label>
                                <input type="date" name="fecha_inicio" id="fecha_prestamo" class="form-control"value="{{ $prestamo->fecha_inicio}}">
                                @error('fecha_prestamo')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <div style="height: 32px;"></div>
                                <button type="button" class="btn btn-success" onclick="calcularPrestamo();"> <i class="fas fa-calculator"></i> Calcular prestamo</button>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Monto por cuota</label>
                                <input type="text" id="monto_cuota" class="form-control" disabled>
                                <input type="text" name="monto_cuota" id="monto_cuota2" class="form-control" hidden>
                                @error('monto_cuota')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Monto del interes</label>
                                <input type="text" name="monto_interes" id="monto_interes" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Monto final</label>
                                <input type="text" name="monto_final" id="monto_final" class="form-control" disabled>
                                <input type="text" id="monto_final2" name="monto_total" hidden>
                                @error('monto_total')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12 ps-2">
                            <div class="form-group">
                                <a href="{{ url('/admin/prestamos') }}" class="btn btn-secondary">Volver</a>
                                <button type="submit" class="btn btn-success">Actualizar prestamo</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
    </div>
</form>
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
            $.ajax({
                url: '{{url("/admin/prestamos/cliente/")}}' + '/' + id,
                type: 'GET',
                success: function(cliente) {
                    $('#contenido_cliente').css('display', 'block');
                    $('#nro_documento').val(cliente.nro_documento);
                    $('#nombre').val(cliente.nombre);
                    $('#apellidos').val(cliente.apellidos);
                    $('#fecha_nacimiento').val(cliente.fecha_nacimiento);
                    $('#genero').val(cliente.genero);
                    $('#email').val(cliente.email);
                    $('#celular').val(cliente.celular);
                    $('#ref_celular').val(cliente.ref_celular);

                },
                error: function() {
                    alert('No se pudo obtener la información del cliente');
                }
            });
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

    window.onload = function () {
        calcularPrestamo()
    }
</script>

@stop