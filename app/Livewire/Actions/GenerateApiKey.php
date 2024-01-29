<?php

namespace App\Livewire\Actions;

use App\Models\User;
use Illuminate\Support\Str;

class GenerateApiKey
{
    public function __invoke(): string
    {
        $apiKey = Str::random(80);

        while (User::where('api_key', $apiKey)->exists()) {
            $apiKey = Str::random(80);
        }

        return $apiKey;
    }
}
