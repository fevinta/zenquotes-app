@props(['cached'=> false, 'quote'])

<div class="h-full rounded-lg bg-white shadow-lg p-8 text-gray-800">
    <div class="h-full flex flex-col justify-center items-center">
        <p class="text-lg text-gray-600 text-center mb-2">
            @if($cached)
                <span class="font-bold">[Cached]</span>
            @endif
            {{ $quote['q'] }}
        </p>
        <p class="text-md text-indigo-500 font-bold text-center">
            {{ $quote['a'] }}
        </p>
        <div class="mt-8 flex flex-row justify-center items-center gap-x-5 text-gray-500">
            {{ $slot }}
        </div>
    </div>
</div>
