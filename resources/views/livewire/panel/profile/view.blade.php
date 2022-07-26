<div>
    <h1 class="text-2xl mb-2">Informacion Basica</h1>
    <form method="POST" wire:submit.prevent="updateInfo" class="mb-6">
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

    <hr>

    <h1 class="text-2xl mb-2 mt-4">Cambiar Contraseña</h1>

    <form method="POST" wire:submit.prevent="updatePassword" class="mb-6">
        <div>
            <div class="mb-6">
                <x-label for="actual_pass" class="mb-1 text-base">Contraseña Actual</x-label>
                <x-input type="password" class="w-full bg-gray-50" name="actual_pass" id="actual_pass"
                    placeholder="Ingresa la contraseña actual" wire:model.lazy="actual_pass">
                </x-input>
                @error('actual_pass')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="new_pass" class="mb-1 text-base">Nueva Contraseña</x-label>
                <x-input type="password" class="w-full bg-gray-50" name="new_pass" id="new_pass"
                    placeholder="Ingrese su nueva contraseña" wire:model.lazy="new_pass">
                </x-input>
                @error('new_pass')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="new_pass_confirmation" class="mb-1 text-base">Repite Contraseña</x-label>
                <x-input type="password" class="w-full bg-gray-50" name="new_pass_confirmation"
                    id="new_pass_confirmation" placeholder="Repita su nueva contraseña"
                    wire:model.lazy="new_pass_confirmation">
                </x-input>
                @error('new_pass_confirmation')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <div wire:loading wire:target="updatePassword">
                <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
            <div wire:loading.class='hidden' wire:target='updatePassword'>
                Cambiar
            </div>
        </button>
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
        Livewire.on('passwordUpdated', () => {
            /* alerta actualizar password success */
            Swal.fire(
                'Actualizada!',
                'La contraseña a sido cambiada.',
                'success',
            )
        });
        Livewire.on('passwordError', () => {
            /* alerta actualizar password error */
            Swal.fire(
                'Error!',
                'la contraseña actual es incorrecta.',
                'error',
            )
        });
    </script>
@endpush
