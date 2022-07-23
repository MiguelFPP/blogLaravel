<div>
    <div>
        <form method="POST" wire:submit.prevent="store">
            <div>
                <div class="mb-6">
                    <x-label for="title" class="mb-1 text-base">Titulo</x-label>
                    <x-input type="text" class="w-full bg-gray-50" name="title" id="title"
                        placeholder="Titulo del post " wire:model.lazy="title" wire:change="makeSlug()"
                        :value="old('title')">
                    </x-input>
                    @error('title')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-label for="slug" class="mb-1 text-base">Slug</x-label>
                    <x-input type="text" class="w-full bg-gray-50" name="slug" id="slug"
                        placeholder="Slug del post " wire:model.lazy="slug" :value="old('slug')" />
                    @error('slug')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-label for="body" class="mb-1 text-base">Cuerpo del post</x-label>
                    <textarea name="body" id="body" wire:model.lazy="body" cols="30" rows="5"
                        class="w-full bg-gray-50 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Cuerpo del post"></textarea>
                    @error('body')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <div wire:ignore x-data="{ content: @entangle('content') }" x-init="ClassicEditor
                        .create($refs.ckeditor, {
                            extraPlugins: [MyCustomUploadAdapterPlugin],
                        }).then(editor => {
                            editor.model.document.on('change:data', () => {
                                content = editor.getData()
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });">
                        <x-label for="content" class="mb-1 text-base">Contenido</x-label>
                        <div x-ref="ckeditor"></div>
                    </div>
                    @error('content')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @dump($images)
                <div class="mb-6">
                    <x-label for="category_id" class="mb-1 text-base">Categoria</x-label>
                    <select name="category_id" id="category_id" wire:model.lazy="category_id"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full bg-gray-50">
                        <option value="" selected>Seleccione una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-label for="tags_id" class="mb-1 text-base">Tags</x-label>
                    @foreach ($tags as $tag)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tags_id[]" value="{{ $tag->id }}"
                                wire:model.lazy="tags_id"
                                class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                            <span class="ml-2">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                    @error('tags_id')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-label for="image" class="mb-1 text-base">Imagen</x-label>
                    <x-input type="file" class="w-full bg-gray-50" name="image" id="image" wire:model="image"
                        accept="image/*" />

                    <div class="items-center my-5 w-80">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt=""
                                class="w-full object-cover rounded-md shadow-md">
                        @endif
                    </div>

                    @error('image')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-label for="status" class="mb-1 text-base">Estado</x-label>
                    <select name="status" id="status" wire:model="status"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full bg-gray-50">
                        <option value="eraser">Borrador</option>
                        <option value="published">Publicado</option>
                    </select>
                    @error('status')
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
</div>
@push('scripts')
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('images.upload') }}", true);
                xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                xhr.responseType = 'json';
            }
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    /* almacenar el path de la imagen en el componenet co la funcion addImage de livewire */
                    @this.addImage(response.path)
                    resolve({
                        default: response.url
                    });
                });
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }
            _sendRequest(file) {
                const data = new FormData();
                /* nombre de donde se almacena la imagen para el backend */
                data.append('upload', file);
                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }
    </script>
@endpush
