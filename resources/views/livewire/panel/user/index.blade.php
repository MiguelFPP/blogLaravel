<div>
    @if (session('success'))
        <div
            class="uppercase border border-green-600 bg-green-100  text-green-600 font-bold p-3 my-3 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    <table class="w-full text-sm text-left text-gray-900">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Nombre</th>
                <th scope="col" class="py-3 px-6">email</th>
                <th scope="col" class="py-3 px-6">Rol</th>
                <th scope="col" class="py-3 px-6 text-center">Accion</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="bg-white border-b dark:border-gray-700 hover:bg-gray-100 text-base">
                    <td class="py-2 px-6">
                        {{ $user->id }}
                    </td>
                    <td class="py-2 px-6">
                        {{ $user->name }} {{ $user->surname }}
                    </td>
                    <td class="py-2 px-6">
                        {{ $user->email }}
                    </td>
                    <td class="py-2 px-6">
                        @if ($user->rol == 1)
                            Administrador
                        @elseif ($user->rol == 2)
                            Usuario
                        @endif
                    </td>
                    <td class="py-2 px-6">
                        <div class="flex justify-center">
                            <a href="{{ route('panel.user.edit', $user) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <button wire:click="$emit('deleteUser', {{ $user->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <div class="container mx-auto">
                    <p class="text-lg text-gray-700">
                        No hay categorias registradas.
                    </p>
                </div>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('deleteUser', (user_id) => {
            Swal.fire({
                title: 'Estas Seguro?',
                text: "Toda la informacion relacionada al usuario sera eliminada, no podra revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    /* aliminar vacante */
                    Livewire.emit('delete', user_id)
                    Swal.fire(
                        'Eliminada!',
                        'El usuario ha sido eliminada.',
                        'success'
                    )
                }
            })
        });
    </script>
@endpush
