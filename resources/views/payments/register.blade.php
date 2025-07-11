{{--
    resources/views/payments/register.blade.php
    Vista que muestra el historial de pagos de un alumno específico.
    Incluye una tabla con los detalles de cada pago realizado por el alumno.
--}}

<x-app-layout>
    <div class="place-items-center">
        {{-- Título de la página --}}
        <h2 class="text-2xl font-bold my-8">Registro de Pagos de {{ $alumno->nombres }} {{ $alumno->apellidos }}</h2>
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
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted-foreground text-lg">No hay pagos registrados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
