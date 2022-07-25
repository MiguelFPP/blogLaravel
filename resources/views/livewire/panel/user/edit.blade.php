<div>
    <form method="POST" wire:submit.prevent="update">
        <div>
            <div class="mb-6">
                <x-label for="name" class="mb-1 text-base">Nombres</x-label>
                <x-input type="text" class="w-full bg-gray-50" name="name" id="name" placeholder="Nombre Usuario"
                    wire:model.lazy="name">
                </x-input>
                @error('name')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="surname" class="mb-1 text-base">Apellidos</x-label>
                <x-input type="text" class="w-full bg-gray-50" name="surname" id="surname"
                    placeholder="Apellido Usuario" wire:model.lazy="surname">
                </x-input>
                @error('surname')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="email" class="mb-1 text-base">Slug</x-label>
                <x-input type="email" class="w-full bg-gray-50" name="email" id="email"
                    placeholder="Slug de la categoria" wire:model.lazy="email" />
                @error('email')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <x-label for="rol" class="mb-1 text-base">Rol</x-label>
                <select name="rol" id="rol" wire:model.lazy="rol"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full bg-gray-50">
                    <option value="" selected>Seleccione un Rol</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>
                @error('rol')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <div wire:loading wire:target="update">
                <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
            <div wire:loading.class='hidden' wire:target='update'>
                Actualizar
            </div>
        </button>
    </form>
</div>
