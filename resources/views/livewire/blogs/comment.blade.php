<div>

    <hr>
    {{-- formulario de comentarios --}}
    <form action="" method="POST" class="mt-2" wire:submit.prevent="comment">
        @csrf
        <x-label class="font-bold text-lg">Escribe tu comentario:</x-label>
        <textarea name="" id="" cols="" rows="2"
            class="w-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            placeholder="Escribe tu comentario..." wire:model.lazy="content"></textarea>

        @if (session('error'))
            <p class="text-sm text-red-500">
                {{ session('error') }}
            </p>
        @endif

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
            <div class="flex justify-between pt-2">
                <p class="text-gray-700">
                    {{ $comment->content }}
                </p>

                @auth
                    @if (auth()->user()->id === $comment->user_id)
                        <button class="cursor-pinter" wire:click="deleteComment({{$comment->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    @endif
                @endauth
            </div>
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
