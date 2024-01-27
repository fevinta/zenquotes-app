<?php

use function Livewire\Volt\{state};

state([
    'quotes' => auth()->user()->Quotes()->with('Author')->get()
]);

$unFavoriteQuote = function ($quoteId) {
    auth()->user()->Quotes()->detach($quoteId);
    $this->quotes = auth()->user()->Quotes()->with('Author')->get();
};

?>

<div class=" bg-white rounded-lg shadow px-5">
    @if($this->quotes->isNotEmpty())
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($this->quotes as $quote)
                <li class="flex gap-x-4 py-5">
                    <div class="flex-auto">
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $quote->author->name }}</p>
                            @if($quote->pivot->created_at)
                                <p class="flex-none text-xs text-gray-600">
                                    <time datetime="{{ $quote->pivot->created_at }}">
                                        {{ $quote->pivot->created_at->shortRelativeToNowDiffForHumans() }}
                                    </time>
                                </p>
                            @endif
                        </div>
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm  leading-6 text-gray-600">{{ $quote->quote }}</p>
                            <button wire:click="unFavoriteQuote({{$quote->id}})"
                                    class="flex-none text-xs text-red-600 hover:underline">
                                Remove
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

    @else
        <div class="p-5">
        <p class="text-gray-500">
            You don't have any favorite quotes.
            Check out <a class="hover:underline" href="{{route('today')}}">today's quotes</a> and find the ones that you like.
        </p>
        </div>
    @endif
</div>


