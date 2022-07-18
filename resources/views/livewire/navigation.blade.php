<div>
    @if (route('blog.index') === url()->current())
        <x-navigation-home :categories="$categories"></x-navigation-home>
    @else
        @include('layouts.navigation-panel')
    @endif
</div>
