<!-- resources/views/login.blade.php --><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - Empleados</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Portal del Empleado</h1>
        <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
            <div class="card-header">Login Usuario</div>
            <div class="card-body">
                <!-- Muestra errores de validación -->
                @if ($errors->has('login'))
                        <div class="alert alert-danger mt-3">{{ $errors->first('login') }}</div>
                @endif
                <form action="{{ route('login') }}" method="POST" class="card-body">
                    @csrf  <!-- Token de seguridad para formularios en Laravel -->
                    <div class="form-group">
                        <label for="user">Número del empleado</label>
                        <input type="text" name="user" id="user" class="form-control" placeholder="Número">
                        @error('user')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">Login</button>

                </form>
            </div>
        </div>
    </div>
</body>
</html>