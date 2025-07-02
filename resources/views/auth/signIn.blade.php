<x-login-layout>
    <div class="container" style="padding-top: 20px; width: 500px;">
        <h1 style="text-align: center;">Crear Nueva Cuenta</h1>
        <p style="text-align: center; opacity: 0.5;">Campos obligatorios <span style="color: red;">*</span></p>
        <form class="form space-y-6 w-full" method="POST" action="{{ route('signIn') }}">
            @csrf
            <div class="grid grid-cols-2 grid-rows-1 gap-4 mb-4">
                <div class=" items-center space-x-2">
                    <label for="name" class="form-label">Primer Nombre<span style="color: red;">*</span></label>
                    <input class="input px-2" type="text" name="first_name">
                </div>
                <div class=" items-center space-x-2">
                    <label for="name" class="form-label">Segundo Nombre<span style="color: red;">*</span></label>
                    <input class="input px-2" type="text" name="second_name" >
                </div>
            </div>
            <div class="grid grid-cols-2 grid-rows-1 gap-4 mb-4">
                <div class="items-center space-x-2">
                    <label for="name" class="form-label">Primer Apellido<span style="color: red;">*</span></label>
                    <input class="input px-2" type="text" name="first_lastname">
                </div>
                <div class="items-center space-x-2">
                    <label for="name" class="form-label">Segundo Apellido<span style="color: red;">*</span></label>
                    <input class="input px-2" type="text" name="second_lastname">
                </div>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">Correo Electrónico<span style="color: red;">*</span></label>
                <input class="input px-2" type="email" name="email">
            </div>
            <div>
                <label for="password" class="form-label">Contraseña<span style="color: red;">*</span></label>
                <input class="input px-2" type="password" name="password">
            </div>
            <div id="passwordHelpBlock" class="form-text mb-4">
                Mínimo 8 caracteres, incluye mayúsculas, minúsculas y números, no debe contener
                espacios o emojis.
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña<span style="color: red;">*</span></label>
                <input class="input px-2" type="password" name="password_confirmation">
            </div>
            <button class="btn btn-primary" type="submit" style="background-color: #751711; border-color: #751711; width: 100%;">Crear Cuenta</button>
        </form>
        <br>
    </div>
</x-login-layout>