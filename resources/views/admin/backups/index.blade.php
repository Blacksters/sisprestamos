@extends('adminlte::page')

@section ('content_header')
<h1><b>Listado de Backups</b></h1>
<hr>
@stop

@section ('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Backups creados</h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/backups/create') }}" class="btn btn-primary">Crear nuevo</a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center">Nro.</th>
                            <th style="text-align: center">Nombre</th>
                            <th style="text-align: center">Peso</th>
                            <th style="text-align: center">Fecha</th>
                            <th style="text-align: center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach($backups as $backup)
                            @php
                                $fileName = basename($backup); // solo el nombre del archivo
                                $fileSize = round(Storage::disk('local')->size($backup) / 1024 / 1024, 2); // tamaño en MB
                                $createdAt = \Carbon\Carbon::createFromTimestamp(Storage::disk('local')->lastModified($backup));
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $contador++ }}</td>
                                <td>{{ $fileName }}</td>
                                <td>{{ $fileSize }} MB</td>
                                <td>{{ $createdAt->format('d/m/Y H:i') }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('admin.backups.descargar', $fileName) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section ('css')

<style>
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
<script>
    $(function() {
        $('#example1').DataTable({
            "pageLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Backups",
                "infoEmpty": "Mostrando 0 a 0 de 0 Backups",
                "infoFiltered": "(Filtrado de _MAX_ total Backups)",
                "lengthMenu": "Mostrar _MENU_ Backups",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            buttons: [{
                    text: '<i class="fas fa-copy"></i> COPIAR',
                    extend: 'copy',
                    className: 'btn btn-default'
                },
                {
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    extend: 'pdf',
                    className: 'btn btn-danger'
                },
                {
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    extend: 'csv',
                    className: 'btn btn-info'
                },
                {
                    text: '<i class="fas fa-file-excel"></i> EXCEL',
                    extend: 'excel',
                    className: 'btn btn-success'
                },
                {
                    text: '<i class="fas fa-print"></i> IMPRIMIR',
                    extend: 'print',
                    className: 'btn btn-warning'
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection