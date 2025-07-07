<x-app-layout>
    <div class="place-items-center">
        <div class="card w-80 mt-10">
            <header>
                <h2 class="text-2xl font-bold text-center">Informacion de perfil</h2>
            </header>
            <section>
                <div class="grid grid-cols-3 grid-rows-2 gap-1">
                    <div>
                        <span class="text-sm font-bold">Nombres:</span>
                    </div>
                    <div class="col-span-2">
                        <span class="w-full">
                            {{ Auth::user()->primer_nombre }} {{ Auth::user()->segundo_nombre }}
                        </span>
                    </div>
                    <div class="row-start-2">
                        <span class="text-sm font-bold">Apellidos:</span>
                    </div>
                    <div class="col-span-2 row-start-2">
                        <span class="w-full">
                            {{ Auth::user()->primer_apellido }} {{ Auth::user()->segundo_apellido }}
                        </span>
                    </div>
                </div>
            </section>
            <footer class="flex justify-center">
                <button
                    class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer"
                    type="button" onclick="document.getElementById('edit-profile').showModal()">Editar Perfil</button>
            </footer>

            <dialog id="edit-profile" class="dialog w-full sm:max-w-[425px] max-h-[612px]" onclick="this.close()">
                <article onclick="event.stopPropagation()">
                    <header>
                        <h2>Editar Perfil</h2>
                        <p>Haz los cambios necesarios para tu perfil. Click en el boton de abajo para guardar los
                            cambios.</p>
                    </header>
                    <section>
                        <form id="edit-profile-form" action="{{ route('perfil.update', Auth::user()->id_usuario) }}"
                            method="POST" class="form grid grid-cols-2 grid-rows-2 gap-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="first_name">Primer nombre</label>
                                <input type="text" name="primer_nombre" id="first_name" maxlength="20"
                                    value="{{ old('primer_nombre', Auth::user()->primer_nombre) }}">
                            </div>
                            <div>
                                <label for="second_name">Segundo nombre</label>
                                <input type="text" name="segundo_nombre" id="second_name" maxlength="20"
                                    value="{{ old('segundo_nombre', Auth::user()->segundo_nombre) }}">
                            </div>
                            <div class="row-start-2">
                                <label for="first_lastname">Primer apellido</label>
                                <input type="text" name="primer_apellido" id="first_lastname" maxlength="20"
                                    value="{{ old('primer_apellido', Auth::user()->primer_apellido) }}">
                            </div>
                            <div class="row-start-2">
                                <label for="second_lastname">Segundo apellido</label>
                                <input type="text" name="segundo_apellido" id="second_lastname" maxlength="20"
                                    value="{{ old('segundo_apellido', Auth::user()->segundo_apellido) }}">
                            </div>
                        </form>
                    </section>
                    <footer>
                        <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                        <button
                            class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                            onclick="document.getElementById('edit-profile-form').submit()" type="submit" form="edit-profile-form">
                            Guardar Cambios
                        </button>
                    </footer>
                    <form method="dialog">
                        <button aria-label="Close dialog">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </form>
                </article>
            </dialog>
        </div>
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                <h2 class="text-base font-semibold text-red-700 mb-2">Error</h2>
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>
