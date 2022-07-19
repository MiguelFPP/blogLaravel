<div>

    <hr>
    {{-- formulario de comentarios --}}
    <form action="" method="POST" class="mt-2" wire:submit.prevent="comment">
        @csrf
        <x-label class="font-bold text-lg">Escribe tu comentario:</x-label>
        <textarea name="" id="" cols="" rows="2"
            class="w-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            placeholder="Escribe tu comentario..." wire:model.lazy="content"></textarea>

        <div class="mt-4">
            <input type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer"
                value="Comentar">
        </div>
    </form>
    <hr class="mt-4">
    {{-- seccion de comentarios --}}
    <h3 class="text-lg font-bold mt-4">Comentarios:</h3>
    @forelse ($post->comments->sortByDesc('id') as $comment)
        <div class="my-4 px-2 bg-gray-200 rounded-lg shadow-lg">
            <p class="text-gray-700">
                {{ $comment->content }}
            </p>
            <div class="flex justify-between my-2">
                <p class="font-bold text-sm text-end">
                    {{ $comment->user->name }}
                </p>
                <p class="font-bold text-sm text-end">
                    Hace: <span class="font-normal">{{ $comment->created_at->diffForHumans() }}</span>
                </p>
            </div>
        </div>
        <hr>
    @empty
        <div class="bg-gray-200 rounded-lg shadow-lg px-3 my-4">
            <p class="text-gray-700">

                No hay comentarios.
            </p>
        </div>
    @endforelse
</div>
