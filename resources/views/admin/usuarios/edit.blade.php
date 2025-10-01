@extends('adminlte::page')

@section('content_header')
<h1><b>Usuarios / Modifique los datos del usuario</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Llene los datos del formulario</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/usuarios/'. $usuario->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Rol <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select name="rol" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{$role->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected': ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('nombre')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del usuario <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $usuario->name }}" name="name" placeholder="Escriba aquí..." required>
                                </div>
                                @error('name')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" value="{{ $usuario->email }}" name="email" placeholder="Escriba aquí..." required>
                                </div>
                                @error('email')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Contraseña <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password" placeholder="Escriba aquí...">
                                </div>
                                @error('password')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Repita la contraseña <b>(*)</b></label>
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Escriba aquí...">
                                </div>
                                @error('password_confirmation')
                                <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12 ps-2">
                            <div class="form-group">
                                <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success ms-1">Modificar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
