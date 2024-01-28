<?php

namespace App\Livewire\Actions;

class Unfavorite
{
    public function __invoke(int $quoteId): void
    {
        auth()->user()->Quotes()->detach($quoteId);
    }
}
