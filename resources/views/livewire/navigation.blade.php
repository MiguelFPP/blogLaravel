<div>

    @if (route('dashboard') === url()->current())
        @include('layouts.navigation-panel')
    @else
        <x-navigation-home :categories="$categories"></x-navigation-home>
    @endif
</div>
