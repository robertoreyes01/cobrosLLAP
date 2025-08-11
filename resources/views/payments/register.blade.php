{{--
    resources/views/payments/register.blade.php
    Vista que muestra el historial de pagos de un alumno específico.
    Incluye una tabla con los detalles de cada pago realizado por el alumno.
--}}

<x-app-layout>
    {{-- <a href="javascript:window.history.back();" class="cursor-pointer py-2 mx-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-move-left-icon lucide-move-left">
            <path d="M6 8L2 12L6 16" />
            <path d="M2 12H22" />
        </svg>
    </a> --}}
    @if (Auth::user()->id_rol == 1)
        <div class="relative">
            <div class="absolute right-108.5 pr-0.5">
                <button type="button" data-tooltip="Nuevo pago"
                    onclick="document.getElementById('new-payment').showModal()"
                    class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-file-plus2-icon lucide-file-plus-2">
                        <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        <path d="M3 15h6" />
                        <path d="M6 12v6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <div class="place-items-center">
        {{-- Título de la página --}}
        <h2 class="text-2xl font-bold my-8">Registro de Pagos de {{ $alumno_nombre }} {{ $alumno_apellido }}</h2>
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
        <div class="w-auto">
            {{-- Tabla de pagos del alumno --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Descripción</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        @if (Auth::user()->id_rol == 2 || Auth::user()->id_rol == 1)
                            <th class="text-center">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ($pagos->count() > 0)
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pago->descripcion }}</td>
                                <td>${{ $pago->total }}</td>
                                <td>{{ $pago->fecha }}</td>
                                <td>{{ $pago->lugar }}</td>
                                <td class="flex justify-center">
                                    @if (Auth::user()->id_rol == 2)
                                        <button data-tooltip="Editar" data-id_pago="{{ $pago->id_registro }}"
                                            data-description="{{ $pago->descripcion }}" data-total="{{ $pago->total }}"
                                            data-date="{{ $pago->fecha }}" data-place="{{ $pago->lugar }}"
                                            onclick="openEditPaymentDialog(this)"
                                            class="mx-0.5 rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.25"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-pencil-icon lucide-pencil">
                                                <path
                                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </button>
                                    @elseif (Auth::user()->id_rol == 1)
                                        <button data-tooltip="Editar" data-id_pago="{{ $pago->id_registro }}"
                                            data-description="{{ $pago->descripcion }}"
                                            data-total="{{ $pago->total }}" data-date="{{ $pago->fecha }}"
                                            data-place="{{ $pago->lugar }}" onclick="openEditPaymentDialog(this)"
                                            class="mx-0.5 rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.25"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-pencil-icon lucide-pencil">
                                                <path
                                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </button>
                                        <button data-tooltip="Eliminar" data-id_pago="{{ $pago->id_registro }}"
                                            data-description="{{ $pago->descripcion }}"
                                            data-total="{{ $pago->total }}" onclick="openDeletePaymentDialog(this)"
                                            class="mx-0.5 rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.25"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash-icon lucide-trash">
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            @if (Auth::user()->id_rol < 3)
                                <td colspan="6" class="text-center text-muted-foreground text-lg">
                                    No hay pagos registrados
                                </td>
                            @else
                                <td colspan="5" class="text-center text-muted-foreground text-lg">
                                    No hay pagos registrados
                                </td>
                            @endif
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Dialog para crear un nuevo pago --}}
        <dialog id="new-payment" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="new-payment-title" aria-describedby="new-payment-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="new-payment-title" class="text-lg font-semibold">Nuevo Pago</h2>
                    <p id="new-payment-description">Ingresa los datos del nuevo pago, clic en guardar al finalizar.</p>
                </header>
                <section>
                    <form method="POST" class="form grid gap-4 w-1/2" id="new-payment-form"
                        action="{{ route('payment.store') }}">
                        @csrf
                        <input type="hidden" name="id_alumno" value="{{ $alumno->id_alumno }}">
                        <div class="grid gap-3">
                            <label for="description">En concepto de</label>
                            <select name="descripcion" id="description" class="select w-full">
                                <optgroup label="Descripción">
                                    <option value="Matrícula (Cuota 1)">Matrícula (Cuota 1)</option>
                                    <option value="Matrícula (Cuota 2)">Matrícula (Cuota 2)</option>
                                    <option value="Matrícula (Cuota 3)">Matrícula (Cuota 3)</option>
                                    <option value="Matrícula" data-valor="{{ $seccion->matricula }}">Matrícula
                                    </option>
                                    <option value="Plan de Pago" data-valor="0.00">Plan de Pago</option>
                                    <option value="Mensualidad {{ $mes }}"
                                        data-valor="{{ $seccion->mensualidad }}">Mensualidad {{ $mes }}
                                    </option>
                                    <option value="Colaboración" data-valor="10.00">Colaboración</option>
                                    <option value="Clausura">Clausura</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="relative grid gap-3">
                            <label for="total">Total</label>
                            <input type="number" id="total" name="total" min="0" placeholder="0.00"
                                class="pl-10">
                            <span class="absolute inset-y-11 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                    <line x1="12" x2="12" y1="2" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </span>
                        </div>
                        <div class="grid gap-3">
                            <label for="date">Fecha</label>
                            <input type="date" id="date" name="fecha" class="input w-36"
                                value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="grid gap-3">
                            <label for="place">Lugar</label>
                            <select name="lugar" id="place" class="select w-full">
                                <optgroup label="Lugar">
                                    <option value="LLAP">LLAP</option>
                                    <option value="Banco Hipotecario">Banco Hipotecario</option>
                                    <option value="Banco Agrícola">Banco Agrícola</option>
                                </optgroup>
                            </select>
                        </div>
                    </form>
                </section>
                <footer>
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="new-payment-form"
                        onclick="document.getElementById('new-payment-form').submit()">
                        Guardar
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

        {{-- Dialog para editar un pago --}}
        <dialog id="edit-payment" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="edit-payment-title" aria-describedby="edit-payment-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="edit-payment-title" class="text-lg font-semibold">Editar Pago</h2>
                    <p id="edit-payment-description">Haz los cambios necesarios para el pago. Clic en guardar
                        cambios al terminar.</p>
                </header>
                <section>
                    <form method="POST" class="form grid gap-4 w-1/2" id="edit-payment-form">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-3">
                            <label for="edit-description">Descripción</label>
                            <input type="text" id="edit-description" name="descripcion" disabled>
                        </div>
                        <div class="relative grid gap-3">
                            <label for="edit-total">Total</label>
                            <input type="number" id="edit-total" name="total" min="0" placeholder="0.00"
                                class="pl-10" disabled>
                            <span class="absolute inset-y-11 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                    <line x1="12" x2="12" y1="2" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </span>
                        </div>
                        <div class="grid gap-3">
                            <label for="edit-date">Fecha</label>
                            <input type="date" id="edit-date" name="fecha" class="input w-36">
                        </div>
                        <div class="grid gap-3">
                            <label for="edit-place">Lugar</label>
                            <select name="lugar" id="edit-place" class="select w-full">
                                <optgroup label="Lugar">
                                    <option value="LLAP">LLAP</option>
                                    <option value="Banco Hipotecario">Banco Hipotecario</option>
                                    <option value="Banco Agrícola">Banco Agrícola</option>
                                </optgroup>
                            </select>
                        </div>
                    </form>
                </section>
                <footer>
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="edit-payment-form"
                        onclick="document.getElementById('edit-payment-form').submit()">
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

        {{-- Dialog para eliminar un pago --}}
        <dialog id="delete-payment" class="dialog" aria-labelledby="delete-payment-title"
            aria-describedby="delete-payment-description">
            <article>
                <header>
                    <h2 id="delete-payment-title">¿Estás seguro de querer eliminar este pago de 
                        <span id="delete-payment-description"></span> $<span id="delete-payment-total"></span>?
                    </h2>
                    <p id="delete-payment-description">Esta acción no se puede deshacer. Este pago será eliminado
                        permanentemente.
                    </p>
                </header>
                <footer>
                    <button class="btn-outline" onclick="document.getElementById('delete-payment').close()">
                        Cancelar
                    </button>
                    <form method="POST" id="delete-payment-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-sm py-2 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer">
                            Eliminar
                        </button>
                    </form>
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
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectDescription = document.getElementById('description');
        const total = document.getElementById('total');

        selectDescription.addEventListener('change', function() {
            const selectedOption = selectDescription.options[selectDescription.selectedIndex];
            const valor = selectedOption.getAttribute('data-valor');

            if (valor) {
                total.value = valor;
            } else {
                total.value = '';
            }
        })
    })

    function openEditPaymentDialog(button) {
        const id_pago = button.getAttribute('data-id_pago');
        const description = button.getAttribute('data-description');
        const total = button.getAttribute('data-total');
        const date = button.getAttribute('data-date');
        const place = button.getAttribute('data-place');

        document.getElementById('edit-description').value = description;
        document.getElementById('edit-total').value = total;
        document.getElementById('edit-date').value = date;
        document.getElementById('edit-place').value = place;

        const form = document.getElementById('edit-payment-form')
        form.action = `{{ route('payment.update', ':id') }}`.replace(':id', id_pago);

        document.getElementById('edit-payment').showModal();
    }

    function openDeletePaymentDialog(button) {
        const id_pago = button.getAttribute('data-id_pago');
        const description = button.getAttribute('data-description');
        const total = button.getAttribute('data-total');

        document.getElementById('delete-payment-description').textContent = description;
        document.getElementById('delete-payment-total').textContent = total;

        const form = document.getElementById('delete-payment-form')
        form.action = `{{ route('payment.destroy', ':id') }}`.replace(':id', id_pago);

        document.getElementById('delete-payment').showModal();
    }
</script>