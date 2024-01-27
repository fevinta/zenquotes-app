<?php

use \App\Services\ZenQuotesService;
use \Illuminate\Support\Facades\Cache;
use function Livewire\Volt\{state, layout, mount};
use App\Models\Author;

layout('layouts.app');

state([
    'quote' => null
]);

mount(function (ZenQuotesService $service) {
    $this->quote = $service->getTodayQuote();
});

$clearCache = function (ZenQuotesService $service) {
    Cache::forget('today-quote');
    $this->quote = $service->getTodayQuote();
};

$refreshQuote = function (ZenQuotesService $service) {
    $this->quote = $service->getTodayQuote(refresh: true);
};

$favorite = function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $author = Author::firstOrCreate(['name' => $this->quote['data']['a']]);

    $quoteModel = $author->quotes()->firstOrCreate(['quote' => $this->quote['data']['q']]);

    auth()->user()->Quotes()->syncWithoutDetaching([$quoteModel->id]);
};

?>

<div>
    <h1 class="text-xl font-bold mb-5">Today's Quote</h1>
    <x-quote :quote="$quote['data']['q']" :author="$quote['data']['a']">
        @if($quote['cached'])
            <x-cache-button wire:click="clearCache"/>
        @endif
        <x-refresh-button/>
        <x-favorite-button wire:click="favorite"/>
    </x-quote>
</div>
