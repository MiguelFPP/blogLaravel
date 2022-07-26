<div>
    <form method="POST" wire:submit.prevent="updateInfo">
        <div>
            <div class="mb-6">
                <x-label for="name" class="mb-1 text-base">Nombre</x-label>
                <x-input type="text" class="w-full bg-gray-50" name="name" id="name" placeholder="Su nombre"
                    wire:model.lazy="name">
                </x-input>
                @error('name')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="surname" class="mb-1 text-base">Apellido</x-label>
                <x-input type="text" class="w-full bg-gray-50" name="surname" id="surname"
                    placeholder="Su apellido" wire:model.lazy="surname">
                </x-input>
                @error('surname')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="email" class="mb-1 text-base">Nombre</x-label>
                <x-input type="email" class="w-full bg-gray-50" name="email" id="email"
                    placeholder="Su correo electronico" wire:model.lazy="email">
                </x-input>
                @error('email')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
    </form>
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('userUpdated', () => {
            /* alerta actualizar informacion */
            Swal.fire(
                'Actualizada!',
                'La informaciona ha sido actualizada.',
                'success',
            )
        });
    </script>
@endpush
