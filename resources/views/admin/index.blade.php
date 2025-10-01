@extends('adminlte::page')

@section('content_header')
    <h1><b>Bienvenido</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    @php
        $boxes = [
            ['url' => '/admin/configuraciones', 'img' => '/images/ajustes.gif', 'title' => 'Config. Registradas', 'total' => $total_configuraciones, 'unit' => 'configuraciones'],
            ['url' => '/admin/roles', 'img' => '/images/rols.gif', 'title' => 'Roles Registrados', 'total' => $total_roles, 'unit' => 'Roles'],
            ['url' => '/admin/usuarios', 'img' => '/images/usuarios.gif', 'title' => 'Usuarios Registrados', 'total' => $total_usuarios, 'unit' => 'Usuarios'],
            ['url' => '/admin/clientes', 'img' => '/images/clientes.gif', 'title' => 'Clientes Registrados', 'total' => $total_clientes, 'unit' => 'Clientes'],
            ['url' => '/admin/prestamos', 'img' => '/images/prestamo.gif', 'title' => 'Prestamos Registrados', 'total' => $total_prestamos, 'unit' => 'Prestamos'],
            ['url' => '/admin/pagos', 'img' => '/images/pagos.gif', 'title' => 'Pagos Registrados', 'total' => $total_pagos, 'unit' => 'Pagos'],
        ];
    @endphp

    @foreach($boxes as $box)
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm zoomP">
                <div class="row align-items-center p-2">
                    <div class="col-4">
                        <a href="{{ url($box['url']) }}">
                            <img src="{{ url($box['img']) }}" width="100%" alt="imagen">
                        </a>
                    </div>
                    <div class="col-8 text-left">
<h5><b>{{ $box['title'] }}</b></h5>
<span class="info-number" data-target="{{ $box['total'] }}">0</span> {{ $box['unit'] }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Total de préstamos por mes</b></h3>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Total de pagos por mes</b></h3>
            </div>
            <div class="card-body">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .info-box {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        cursor: pointer;
    }
    .info-box:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .counter {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
    }

    .info-number {
    font-size: 1.2rem;   /* un poco más grande */
    font-weight: bold;   /* negrita */
    color: #ffffffff;      /* azul por defecto */
    transition: color 0.3s ease;
}

.info-number:hover {
    color: #28a745;      /* verde al pasar el mouse */
}

</style>
@stop

@section('js')

@php
$meses = array_fill(1, 12, 0);
$suma_prestamo = array_fill(1, 12, 0);
foreach ($prestamos as $prestamo) {
    $fecha = strtotime($prestamo['fecha_inicio']);
    $mes = (int) date('m', $fecha);
    $meses[$mes]++;
    $suma_prestamo[$mes] += $prestamo['monto_prestado'];
}
$reporte_prestamo = implode(',', $suma_prestamo);

$meses_pagos = array_fill(1, 12, 0);
$suma_pagos = array_fill(1, 12, 0);
foreach ($pagos as $pago) {
    if (!empty($pago['fecha_pago']) && $pago['monto_pagado'] > 0) {
        $fecha = strtotime($pago['fecha_pago']);
        $mes = (int) date('m', $fecha);
        $meses_pagos[$mes]++;
        $suma_pagos[$mes] += $pago['monto_pagado'];
    }
}
$reporte_pagos = implode(',', $suma_pagos);
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Animación de contadores
document.addEventListener("DOMContentLoaded", function() {
    const counters = document.querySelectorAll('.info-number');
    const speed = 1; // cuanto menor, más lento (ajústalo)

    counters.forEach(counter => {
        const animate = () => {
            const value = +counter.getAttribute('data-target'); 
            let data = +counter.innerText; 

            if (data < value) {
                counter.innerText = data + 1; // sube de 1 en 1
                setTimeout(animate, 600); // 600 ms entre incrementos (0.6s)
            } else {
                counter.innerText = value; 
            }
        };
        animate();
    });
});

    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    // Chart préstamos
    var datos = [{{$reporte_prestamo}}];
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Préstamos',
                data: datos,
                fill: true,
                backgroundColor: 'rgba(54,162,235,0.1)',
                borderColor: 'rgba(54,162,235,1)',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: 'rgba(54,162,235,1)'
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: { display: true, position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Chart pagos
    var datos2 = [{{$reporte_pagos}}];
    const ctx2 = document.getElementById('myChart2');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Pagos',
                data: datos2,
                backgroundColor: 'rgba(75,192,192,0.6)',
                borderColor: 'rgba(75,192,192,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1200,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: { display: true, position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@stop
