@extends('adminlte::page')

@section('content_header')
<h1><b>Clientes / Actualizar datos del cliente</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Llene los datos del formulario</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/clientes/' . $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Cedula -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Cédula <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$cliente->nro_documento}}" name="nro_documento" placeholder="Escriba aquí..." required>
                                </div>
                                @error('nro_documento')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Nombres -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombres del cliente <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$cliente->nombre}}" name="nombre" placeholder="Escriba aquí..." required>
                                </div>
                                @error('nombre')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
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
                                    <input type="text" class="form-control" value="{{$cliente->apellidos}}" name="apellidos" placeholder="Escriba aquí..." required>
                                </div>
                                @error('apellidos')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha nacimiento -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fecha de nacimiento <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" value="{{$cliente->fecha_nacimiento}}" name="fecha_nacimiento" placeholder="Escriba aquí..." required>
                                </div>
                                @error('fecha_nacimiento')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Segunda fila -->
                    <div class="row">
                        <!-- Género -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Género <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select name="genero" class="form-control">
                                        <option value="MASCULINO" {{ old('genero', $cliente->genero) == 'MASCULINO' ? 'selected' : '' }}>MASCULINO</option>
                                        <option value="FEMENINO" {{ old('genero', $cliente->genero) == 'FEMENINO' ? 'selected' : '' }}>FEMENINO</option>
                                    </select>

                                </div>
                                @error('genero')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
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
                                    <input type="email" class="form-control" value="{{$cliente->email}}" name="email" placeholder="Escriba aquí..." required>
                                </div>
                                @error('email')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Celular -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Celular <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="number" class="form-control" value="{{$cliente->celular}}" name="celular" placeholder="Escriba aquí..." required>
                                </div>
                                @error('celular')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
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
                                    <input type="number" class="form-control" value="{{$cliente->ref_celular}}" name="ref_celular" placeholder="Escriba aquí..." required>
                                </div>
                                @error('ref_celular')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Botones -->
                    <div class="row">
                        <div class="col-md-12 ps-2">
                            <div class="form-group">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success ms-1">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop