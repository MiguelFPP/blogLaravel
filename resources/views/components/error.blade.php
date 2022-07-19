<div class="mb-2">
    @if (session('error'))
        <div class="bg-red-500 rounded-md border-red-700 p-1">
            <p class=" text-white">
                {{ session('error') }}
            </p>
        </div>
    @endif
</div>
