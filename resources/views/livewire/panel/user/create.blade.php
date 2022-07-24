<div>
    <form method="POST" wire:submit.prevent="store">
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
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
    </form>
</div>
