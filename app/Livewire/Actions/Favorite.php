<?php

namespace App\Livewire\Actions;

use App\Models\Author;

class Favorite
{
    public function __invoke(string $author, string $quote): void
    {
        $author = Author::firstOrCreate(['name' => $author]);

        $quoteModel = $author->quotes()->firstOrCreate(['quote' => $quote]);

        auth()->user()->Quotes()->syncWithoutDetaching([$quoteModel->id]);
    }
}
