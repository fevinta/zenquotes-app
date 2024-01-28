<?php

use App\Livewire\Actions\Unfavorite;
use function Livewire\Volt\{computed, layout};

layout('layouts.app');

$quotes = computed(function () {
    return auth()->user()
        ->Quotes()
        ->with('Author')
        ->orderByDesc('created_at')
        ->get();
});

$unfavoriteQuote = function (int $quoteId, Unfavorite $unfavorite) {
    $unfavorite(quoteId: $quoteId);
    $this->dispatch('notify', 'Favorite removed!');
};

?>

<div class="bg-white rounded-lg shadow px-5">
    @if($this->quotes->isNotEmpty())
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($this->quotes as $quote)
                <li class="flex gap-x-4 py-5">
                    <div class="flex-auto">
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm leading-6 text-gray-900">
                                {{ $quote->quote }}
                            </p>
                            @if($quote->pivot->created_at)
                                <p class="flex-none text-xs text-gray-600">
                                    <time datetime="{{ $quote->pivot->created_at }}">
                                        {{ $quote->pivot->created_at->shortRelativeToNowDiffForHumans() }}
                                    </time>
                                </p>
                            @endif
                        </div>
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm font-semibold leading-6 text-gray-600">
                                {{ $quote->author->name }}
                            </p>
                            <button wire:click="unfavoriteQuote({{$quote->id}})"
                                    class="flex-none text-xs text-red-600 hover:underline">
                                Remove
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

    @else
        <div class="p-5 text-gray-500">
            <b>
                You don't have any favorite quotes.
            </b>
            <p class="text-sm">
                Check out <a class="hover:underline" href="{{route('today')}}">today's quotes</a> and find the ones that
                you like.
            </p>
        </div>
    @endif
</div>


