<x-app-layout>
    <div class="relative place-items-center">
        <h2 class="text-2xl font-bold my-8">Lista de Padres/Tutores</h2>
        <div class="w-120">
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($parents->count() > 0)
                    @foreach ($parents as $parent)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $parent->primer_nombre }} {{ $parent->segundo_nombre }}</td>
                            <td>{{ $parent->primer_apellido }} {{ $parent->segundo_apellido }}</td>
                            <td class="flex justify-center">
                                <form action="{{ route('payment.register', $parent) }}" method="GET">
                                    <button class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md"
                                    type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.75"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-file-search-icon lucide-file-search">
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                            <path
                                                d="M4.268 21a2 2 0 0 0 1.727 1H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3" />
                                            <path d="m9 18-1.5-1.5" />
                                            <circle cx="5" cy="14" r="3" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-muted-foreground text-lg">No hay padres/tutores registrados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3">
                {{ $parents->links() }}
            </div>
        </div>
        <div class="absolute top-18.5 right-95 grid grid-cols-2 grid-rows-1 gap-2">
            <div class="justify-items-end">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="#751711" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-file-search-icon lucide-file-search">
                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                    <path d="M4.268 21a2 2 0 0 0 1.727 1H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3" />
                    <path d="m9 18-1.5-1.5" />
                    <circle cx="5" cy="14" r="3" />
                </svg>
            </div>
            <div>
                <span class="text-[#751711] text-sm">Ver detalles</span>
            </div>
        </div>
    </div>
</x-app-layout>