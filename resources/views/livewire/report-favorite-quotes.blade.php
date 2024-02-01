<?php

use App\Livewire\Actions\Unfavorite;
use Illuminate\Support\Facades\DB;
use function Livewire\Volt\{computed, layout};

layout('layouts.app');

$report = computed(function () {
    return DB::table('quote_user')
        ->select('quotes.id as quote_id', 'quotes.quote', 'authors.name as author_name', 'users.name as user_name', 'users.email as user_email', 'quote_user.created_at as created_at')
        ->join('quotes', 'quote_user.quote_id', '=', 'quotes.id')
        ->join('authors', 'quotes.author_id', '=', 'authors.id')
        ->join('users', 'quote_user.user_id', '=', 'users.id')
        ->orderBy('quote_user.created_at', 'desc')
        ->get();
});

$unFavoriteQuote = function ($quoteId, Unfavorite $unfavorite) {
    $unfavorite(quoteId: $quoteId);
    $this->dispatch('notify', 'Quote removed from favorites!');
};

?>

<div class=" bg-white rounded-lg shadow px-5">
    @if($this->report->isNotEmpty())
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($this->report as $item)
                <li class="flex gap-x-4 py-5">
                    <div class="flex-auto">
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm leading-6 text-gray-900">
                                {{ $item->quote }}
                            </p>
                            <p class="flex-none text-xs text-gray-600">
                                <a href="{{ "/login?email=" . $item->user_email }}">
                                    {{ $item->user_name }}
                                </a>
                            </p>
                        </div>
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm font-semibold leading-6 text-gray-600">
                                {{ $item->author_name }}
                            </p>
                            @if(auth()->user()->email === $item->user_email)
                                <button wire:click="unFavoriteQuote({{ $item->quote_id }})"
                                        class="flex-none text-xs text-red-600 hover:underline">
                                    Remove
                                </button>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="p-5">
            <p class="text-gray-500">
                Nobody has favorited any quotes yet.
            </p>
        </div>
    @endif
</div>


