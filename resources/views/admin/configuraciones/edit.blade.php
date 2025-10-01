@extends('adminlte::page')

@section ('content_header')
<h1><b>Configuraciones/Modificacion de la configuracion</b></h1>
<hr>
@stop

@section ('content')
<div class="row">

    <div class="col-md-12">
        <div class="card card-outline card-succes">
            <div class="card-header">
                <h3 class="card-title">Llene los datos del formulario</h3>


                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form action="{{url ('admin/configuraciones', $configuracion->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre de la institucion</label> <b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$configuracion->nombre}}" name="nombre" placeholder="Escriba aqui..." required>
                                            @error('nombre')
                                            <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Descripcion de la institucion</label> <b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$configuracion->descripcion}}" name="descripcion" placeholder="Escriba aqui..." required>
                                            @error('descripcion')
                                            <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Direccion de la institucion</label> <b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$configuracion->direccion}}" name="direccion" placeholder="Escriba aqui..." required>
                                            @error('direccion')
                                            <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Telefono</label> <b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$configuracion->telefono}}" name="telefono" placeholder="Escriba aqui..." required>
                                            @error('telefono')
                                            <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Email</label> <b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" value="{{$configuracion->gmail}}" name="gmail" placeholder="Escriba aqui..." required>
                                            @error('gmail')
                                            <small style="color: red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Pagina Web</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pager"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$configuracion->we}}" name="web" placeholder="Escriba aqui...">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Moneda</label> <b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                            <select id="currencySelect" name="moneda" class="form-control">
                                                <option value="DOP" {{ ($configuracion->moneda=='DOP') ? 'selected' : '' }}>Peso Dominicano (DOP)</option>
                                                <option value="USD" {{ ($configuracion->moneda=='USD') ? 'selected' : '' }}>Dólar Estadounidense (USD)</option>
                                                <option value="EUR" {{ ($configuracion->moneda=='EUR') ? 'selected' : '' }}>Euro (EUR)</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="logo">Logo</label> <b> (*)</b>
                            <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control">
                            <p class="text-danger" id="errorLogo"></p>
                            <small class="help-block with-errors text-center"></small>
                        </div>
                        <center>
                            <output id="list">
                                <img src="{{ asset('storage/' . $configuracion->logo) }}" width="100px" alt="Imagen">

                            </output>
                        </center>
                        <script>
                            function archivo(evt) {
                                var files = evt.target.files; // FileList object

                                // Obtenemos la imagen del campo "file".
                                for (var i = 0, f; f = files[i]; i++) {
                                    //Solo admitimos imagenes.
                                    if (!f.type.match('image.*')) {
                                        continue;
                                    }

                                    var reader = new FileReader();

                                    reader.onload = (function(theFile) {
                                        return function(e) {
                                            // Inserta la imagen
                                            document.getElementById('list').innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                                        };
                                    })(f);

                                    reader.readAsDataURL(f);
                                }
                            }

                            document.getElementById('file').addEventListener('change', archivo, false);
                        </script>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url ('/admin/configuraciones')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
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

@section ('css')
@stop

@section('js')
@endsection