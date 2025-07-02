<x-login-layout>
    <div class="container" style="padding-top: 20px; width: 500px; align-items: center;">
        <div class="mb-4">
            <h2 style="text-align: center;">Bienvenido</h2>
            <h4 style="text-align: center;">Ingresa tus credenciales</h4>
        </div>
        <form class="form space-y-6 w-full" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input class="input px-2" type="email" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input class="input px-2" type="password" name="password">
            </div>
            <button class="btn btn-primary mb-3" type="submit"
                style="background-color: #751711; border-color: #751711; width: 100%;">Iniciar sesión</button>
        </form>
        <div class="mb-3 grid grid-cols-2 grid-rows-1 gap-4">
            <div class="items-center space-x-2">
                <label class="label gap-3">
                    <input type="checkbox" class="input">
                    Recordarme
                </label>
            </div>
            <div class="flex justify-end items-center space-x-2">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-login-layout>
