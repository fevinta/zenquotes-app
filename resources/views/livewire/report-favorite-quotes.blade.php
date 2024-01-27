<?php

use function Livewire\Volt\{state};

state([
    'quotes' => \Illuminate\Support\Facades\DB::table('quote_user')
        ->select('quotes.id as quote_id', 'quotes.quote', 'authors.name as author_name', 'users.name as user_name', 'users.email as user_email', 'quote_user.created_at as created_at')
        ->join('quotes', 'quote_user.quote_id', '=', 'quotes.id')
        ->join('authors', 'quotes.author_id', '=', 'authors.id')
        ->join('users', 'quote_user.user_id', '=', 'users.id')
        ->orderBy('quote_user.created_at', 'desc')
        ->get()
]);

$unFavoriteQuote = function ($quoteId) {
    auth()->user()->Quotes()->detach($quoteId);
    $this->quotes = auth()->user()->Quotes()->with('Author')->get();
};

?>

<div class=" bg-white rounded-lg shadow px-5">
    @if($this->quotes->isNotEmpty())
        <ul role="list" class="divide-y divide-gray-100">
            @foreach($this->quotes as $favoriteQuote)
                <li class="flex gap-x-4 py-5">
                    <div class="flex-auto">
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $favoriteQuote->author_name }}
                            </p>
                            <p class="flex-none text-xs text-gray-600">
                                <a href="{{ "/login?email=" . $favoriteQuote->user_email }}">
                                    {{ $favoriteQuote->user_name }}
                                </a>
                            </p>
                        </div>
                        <div class="flex items-baseline justify-between gap-x-4">
                            <p class="text-sm  leading-6 text-gray-600">{{ $favoriteQuote->quote }}</p>
                            @if(auth()->user()->email === $favoriteQuote->user_email)
                                <button wire:click="unFavoriteQuote({{$favoriteQuote->quote_id}})"
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


