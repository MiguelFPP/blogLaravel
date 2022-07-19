<x-app-layout>
    <div class="container mx-auto mt-4">
        <article class="w-full h-80 bg-cover bg-center rounded-lg"
            style="background-image: url(@if ($post->image) {{ Storage::url($post->image) }} @else https://cdn.pixabay.com/photo/2022/04/21/19/47/lion-7148207_960_720.jpg @endif)">
            <div class="w-full h-full px-8 pb-10 flex flex-col justify-end">
        </article>

        <div class="mt-2">
            @foreach ($post->tags as $tag)
                <a href="{{ route('blog.tag', $tag) }}" class="text-gray-500">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                        {{ $tag->name }}
                    </span>
                </a>
            @endforeach
        </div>
        <div class="mt-4 md:mt-8">
            <h1 class="text-4xl font-bold">
                {{ $post->title }}
            </h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4">
            <div class="sm:col-span-2 md:col-span-3">
                <div class="mt-2">
                    <p class="text-gray-700">
                        {!! $post->content !!}
                    </p>
                </div>

                <div class="flex justify-between mt-6">
                    <p class="font-bold text-sm text-end">
                        Publicado por: <span class="font-normal">{{ $post->user->name }}</span>
                    </p>
                    <p class="font-bold text-sm text-end">
                        Publicado el: <span class="font-normal">{{ $post->created_at->format('d M Y') }}</span>
                    </p>
                </div>
                <div class="mt-4">
                    <hr>
                    {{-- formulario de comentarios --}}
                    <form action="" method="POST" class="mt-2">
                        @csrf
                        <x-label class="font-bold text-lg">Escribe tu comentario:</x-label>
                        <textarea name="" id="" cols="" rows="2"
                            class="w-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Escribe tu comentario..."></textarea>

                        <div class="mt-4">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full">
                                Enviar
                            </button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    {{-- seccion de comentarios --}}
                    <h3 class="text-lg font-bold mt-4">Comentarios:</h3>
                    @forelse ($post->comments as $comment)
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
            </div>
            <hr class="sm:hidden">
            {{-- recomendaciones categoria --}}
            <div class="sm:flex sm:flex-col sm:pl-14 mt-6 sm:-mt-10">
                <p class="font-bold text-lg text-start sm:text-end mb-6">
                    Mas en: <a href="{{ route('blog.category', $post->category) }}">{{ $post->category->name }}</a>
                </p>
                <div class="grid grid-cols-3 sm:grid-cols-1 gap-2 items-end mb-2">
                    @forelse ($similars as $similar)
                        <div class="w-full h-full bg-cover bg-center rounded-lg py-10"
                            style="background-image: url(@if ($similar->image) {{ Storage::url($similar->image) }} @else https://cdn.pixabay.com/photo/2022/04/21/19/47/lion-7148207_960_720.jpg @endif)">
                            <div class="w-full h-full px-4">
                                <h1 class="text-lg text-black font-bold -mt-10">
                                    <a href="{{ route('blog.show', $similar) }}">
                                        {{ $similar->title }}
                                    </a>
                                </h1>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-700">
                            No hay post relacionados
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
