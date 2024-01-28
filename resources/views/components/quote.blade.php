@props(['quote', 'author'])

<div class="h-full rounded-lg bg-white shadow-lg p-10 text-gray-800">
    <div class="h-full flex flex-col justify-center items-center">
        <p class="text-lg text-gray-600 text-center mb-2">
            {{ $quote }}
        </p>
        <p class="text-md text-indigo-500 font-bold text-center">
            {{ $author }}
        </p>
        <div class="mt-8 flex flex-row justify-center items-center gap-x-5 text-gray-500">
            {{ $slot }}
        </div>
    </div>
</div>
