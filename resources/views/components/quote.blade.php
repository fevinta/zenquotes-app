@props(['quote', 'author'])

<div class="rounded-lg bg-white shadow-lg p-10 text-gray-800">
    <div class="w-full mb-2">
        <div class="w-full flex flex-row justify-end items-center gap-x-5 fill-gray-300 text-gray-500">
            {{ $slot }}
        </div>
        <p class="text-lg text-gray-600 text-center">
            {{ $quote }}
        </p>
    </div>
    <div class="w-full">
        <p class="text-md text-indigo-500 font-bold text-center">{{ $author }}</p>
    </div>
</div>
