@props(['posts_likes'])
<div class="container mx-auto">
    <div class="max-w-6xl mx-auto mt-4 mb-5" x-data="{
        activeSlide: 1,
        slides: [
            @foreach ($posts_likes as $post) { title: '{{ $post->title }}', image: '{{ $post->image }}', count: {{ $post->count }}}, @endforeach
        ],
        loop() {
            setInterval(() => {
                this.activeSlide = this.activeSlide === 5 ? 1 : this.activeSlide + 1;
                console.log(this.activeSlide);
            }, 5000);
        }
    }" x-init="loop">
        {{-- loop --}}
        <div>
            @foreach ($posts_likes as $post)
                <div x-show="activeSlide === {{ $post->count }}"
                    class="p-24 items-center text-gray-800 rounded-lg bg-cover bg-center"
                    style="background-image: url(@if ($post->image) {{ Storage::url($post->image) }} @else https://cdn.pixabay.com/photo/2022/04/21/19/47/lion-7148207_960_720.jpg @endif)">
                    <h2 class="font-bold text-2xl"> {{ $post->title }} </h2>
                </div>
            @endforeach
        </div>
        {{-- back/next --}}
        <div class="flex justify-between mb-24 -mt-36">
            <div class="flex items-center">
                {{-- previous --}}
                <button x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1"
                    class="bg-slate-200 text-slate-600 hover:bg-blue-500 hover:text-white transition font-bold rounded-full w-12 h-12 shadow flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center">
                {{-- next --}}
                <button x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1"
                    class="bg-slate-200 text-slate-600 hover:bg-blue-500 hover:text-white transition font-bold rounded-full w-12 h-12 shadow flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
        {{-- buttons --}}
        <div class="w-full flex items-center justify-center px-4 -mb-8">
            @foreach ($posts_likes as $post)
                <button
                    class="flex-1 w-4 h-2 mt-4 mx-2 mb-2 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-slate-600 hover:shadow-lg"
                    :class="{
                        'bg-blue-600': activeSlide === {{ $post->count }},
                        'bg-blue-300': activeSlide !== {{ $post->count }}
                    }"
                    x-on:click="activeSlide={{ $post->count }}"></button>
            @endforeach
        </div>
    </div>
</div>
