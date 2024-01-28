<?php

use App\Livewire\Actions\Favorite;
use App\Services\ZenQuotesService;
use function Livewire\Volt\{computed, layout};

layout('layouts.app');

$quotes = computed(function (ZenQuotesService $service) {
    return $service->getRandomQuotes(10);
});

$addFavorite = function (string $author, string $quote, Favorite $favorite) {
    $favorite(
        author: $author,
        quote: $quote
    );

    $this->dispatch('notify', 'Favorite added!');
};

?>

<div class="bg-white rounded-lg shadow px-5">
    <ul role="list" class="divide-y divide-gray-100">
        @foreach($this->quotes as $quote)
            <li class="flex gap-x-4 py-5">
                <div class="flex-auto">
                    <div class="flex items-baseline justify-between gap-x-4">
                        <p class="text-sm leading-6 text-gray-900">
                            {{ $quote['q'] }}
                        </p>
                    </div>
                    <div class="flex items-baseline justify-between gap-x-4">
                        <p class="text-sm font-semibold leading-6 text-gray-600">
                            {{ $quote['a'] }}
                        </p>
                        <button wire:click="addFavorite('{{ $quote['a'] }}', '{{ $quote['q'] }}')"
                                class="flex-none text-xs text-indigo-600 hover:underline">
                            Favorite
                        </button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>


