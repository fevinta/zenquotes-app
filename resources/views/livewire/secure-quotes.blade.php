<?php

use App\Services\ZenQuotesService;
use function Livewire\Volt\{layout, state};

layout('layouts.app');

state([
    'data' => fn(ZenQuotesService $service) => $service->requestQuotes(quantity: 10)
]);

$refreshQuotes = function (ZenQuotesService $service) {
    $this->data = $service->requestQuotes(quantity: 10, refresh: true);
};

?>
<div>
    <div class="mb-5 flex flex-row justify-between">
        <h1 class="text-xl font-bold">Quotes</h1>
        <x-primary-button wire:click="refreshQuotes">Clear Cache</x-primary-button>
    </div>
    <div class="bg-white rounded-lg shadow px-5">
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($this->data['quotes'] as $quote)
                <li class="flex gap-x-4 py-5">
                    <div class="flex-auto">
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm leading-6 text-gray-900">
                                @if($this->data['cached'])
                                    <span class="font-bold">[Cached]</span>
                                @endif
                                {{ $quote['q'] }}
                            </p>
                        </div>
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm font-semibold leading-6 text-gray-600">
                                {{ $quote['a'] }}
                            </p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>


