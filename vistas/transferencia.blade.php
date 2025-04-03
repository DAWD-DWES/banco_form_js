@extends('app')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Realizar Transferencia
                </div>
                <div class="card-body">
                    <form method="post" action="index.php" novalidate>
                        <div class="form-group">
                            <label for="dniclienteorigen">DNI Cliente Origen</label>
                            <input type="text" class="form-control" id="dniclienteorigen" name="dniclienteorigen" 
                                   value="{{ ($dniClienteOrigen ?? '') }}" required
                                   pattern="^[0-9]{8}[A-Za-z]$"
                                   placeholder="Debe tener 8 números seguidos de una letra (ej: 12345678Z)">
                            <small id="dniclienteorigenError" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="idcuentaorigen">Cuenta Cliente Origen</label>
                            <input type="number" class="form-control" id="idcuentaorigen" name="idcuentaorigen" 
                                   value="{{ ($idCuentaOrigen ?? '') }}" required
                                   placeholder="Debe ser un número de cuenta (ej: 1234)">
                            <small id="idcuentaorigenError" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="dniclientedestino">DNI Cliente Destino</label>
                            <input type="text" class="form-control" id="dniclientedestino" name="dniclientedestino" 
                                   value="{{ ($dniClienteDestino ?? '') }}" required
                                   pattern="^[0-9]{8}[A-Za-z]$"
                                   placeholder="Debe tener 8 números seguidos de una letra (ej: 12345678Z)">
                            <small id="dniclientedestinoError" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="idcuentadestino">Cuenta Cliente Destino</label>
                            <input type="number" class="form-control" id="idcuentadestino" name="idcuentadestino" 
                                   value="{{ ($idCuentaDestino ?? '') }}" required
                                   placeholder="Debe ser un número de cuenta (ej: 1234)">
                            <small id="idcuentadestinoError" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad (€)</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" 
                                   value="{{ ($cantidad ?? '') }}" required
                                   placeholder="Introduce una cantidad (ej: 100.50)">
                            <small id="cantidadError" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" 
                                   value="{{ ($asunto ?? '') }}" required
                                   pattern="^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ\s.,:;()\-]{1,140}$"
                                   placeholder="El mensaje solo puede contener letras, números, espacios y signos básicos. Máximo 140 caracteres.">
                            <small id="asuntoError" class="text-danger"></small>
                        </div>
                        <button type="submit" class="btn btn-primary m-5" name="transferencia">Realizar Transferencia</button>
                        <div>{{ $message ?? "" }}</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="@asset('assets/validar.js')"></script>
@endpush
