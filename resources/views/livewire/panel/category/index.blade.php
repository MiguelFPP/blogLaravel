<div>
    @if (session('success'))
        <div
            class="uppercase border border-green-600 bg-green-100  text-green-600 font-bold p-3 my-3 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="px-6 py-4">
        <x-input type="text" wire:model="search" placeholder="Buscar Categoria" class="w-full">
        </x-input>
    </div>

    <table class="w-full text-sm text-left text-gray-900">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="order('id')">
                    ID
                    @if ($sort == 'id')
                        @if ($order == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
                <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="order('name')">
                    Nombre
                    @if ($sort == 'name')
                        @if ($order == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
                <th scope="col" class="py-3 px-6 cursor-pointer" wire:click="order('slug')">
                    Slug
                    @if ($sort == 'slug')
                        @if ($order == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
                <th scope="col" class="py-3 px-6 text-center">Accion</th>
            </tr>
        <tbody>
            @forelse ($categories as $category)
                <tr class="bg-white border-b dark:border-gray-700 hover:bg-gray-100 text-base">
                    <td class="py-2 px-6">
                        {{ $category->id }}
                    </td>
                    <td class="py-2 px-6">
                        {{ $category->name }}
                    </td>
                    <td class="py-2 px-6">
                        {{ $category->slug }}
                    </td>
                    <td class="py-2 px-6">
                        <div class="flex justify-center">
                            <a href="{{ route('panel.category.edit', $category) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <button wire:click="$emit('deleteCategory', {{ $category->id }})">
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
        </thead>
    </table>
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('deleteCategory', (category_id) => {
            Swal.fire({
                title: 'Estas Seguro?',
                text: "No podra revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    /* aliminar vacante */
                    Livewire.emit('delete', category_id)
                    Swal.fire(
                        'Eliminada!',
                        'La categoria ha sido eliminada.',
                        'success'
                    )
                }
            })
        });
    </script>
@endpush
