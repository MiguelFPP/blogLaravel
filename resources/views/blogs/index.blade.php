<x-app-layout>

    <x-carousel :posts_likes="$posts_likes"></x-carousel>

    <div class="container mx-auto py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($posts as $post)
                <article
                    class="w-full h-80 bg-cover bg-center @if ($loop->first) md:col-span-2 @endif rounded-lg"
                    style="background-image: url(@if ($post->image) {{ Storage::url($post->image) }} @else https://cdn.pixabay.com/photo/2022/04/21/19/47/lion-7148207_960_720.jpg @endif)">
                    <div class="w-full h-full px-8 pb-10 flex flex-col justify-end">
                        <div class="">
                            @foreach ($post->tags as $tag)
                                <a href="#" class="text-gray-500">
                                    <span
                                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                        {{ $tag->name }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        <h1 class="text-4xl text-black leading-8 font-bold mt-2">
                            <a href="">
                                {{ $post->title }}
                            </a>
                        </h1>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
