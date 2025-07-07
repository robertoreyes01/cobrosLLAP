<x-app-layout>
    <div class="place-items-center">
        <h2>Lista de Alumnos</h2>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->primer_nombre }}</td>
                            <td>{{ $alumno->primer_apellido }}</td>
                            <td>
                                <button class="btn-icon-outline">
                                    
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>