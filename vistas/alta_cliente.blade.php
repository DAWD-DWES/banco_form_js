@extends('app')

@section('contenido')
<div class="container mt-4">
    <h2>Crear Cliente</h2>
    <form id="formCrearCliente" action="cliente.php" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dni" class="form-label">DNI:</label>
            <input type="text" class="form-control" id="dni" name="dni" pattern="[0-9A-Za-z]{8,20}" required>
            <div class="invalid-feedback">Por favor, introduce un DNI válido (entre 8 y 20 caracteres alfanuméricos).</div>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
            <div class="invalid-feedback">Por favor, introduce el nombre del cliente.</div>
        </div>
        <div class="mb-3">
            <label for="apellido1" class="form-label">Primer Apellido:</label>
            <input type="text" class="form-control" id="apellido1" name="apellido1" required>
            <div class="invalid-feedback">Por favor, introduce el primer apellido del cliente.</div>
        </div>
        <div class="mb-3">
            <label for="apellido2" class="form-label">Segundo Apellido:</label>
            <input type="text" class="form-control" id="apellido2" name="apellido2" required>
            <div class="invalid-feedback">Por favor, introduce el segundo apellido del cliente.</div>
        </div>
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            <div class="invalid-feedback">Por favor, introduce la fecha de nacimiento del cliente.</div>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9,15}">
            <div class="invalid-feedback">Por favor, introduce un número de teléfono válido (entre 9 y 15 dígitos).</div>
        </div>
        <button type="submit" class="btn btn-primary">Crear Cliente</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Función para validar el formulario antes de enviarlo
    document.getElementById('formCrearCliente').addEventListener('submit', function(event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        this.classList.add('was-validated');
    });
</script>
@endpush

