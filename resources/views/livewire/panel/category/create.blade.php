<div>
    <form method="POST" wire:submit.prevent="store">
        <div>
            <div class="mb-6">
                <x-label for="name" class="mb-1 text-base">Nombre</x-label>
                <x-input type="text" class="w-full bg-gray-50" name="name" id="name"
                    placeholder="Nombre categoria" wire:model="name" wire:keydown="makeSlug()">
                </x-input>
                @error('name')
                    <div class="text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <x-label for="slug" class="mb-1 text-base">Slug</x-label>
                <x-input type="text" class="w-full bg-gray-50" name="slug" id="slug"
                    placeholder="Slug de la categoria" wire:model="slug" />
                @error('slug')
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
