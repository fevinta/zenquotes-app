<?php

namespace App\Http\Controllers\Api;

use App\Services\ZenQuotesService;
use Illuminate\Support\Collection;

abstract class ApiController
{
    public function __construct(
        protected readonly ZenQuotesService $service
    ) {
        //
    }

    public function parseListOfQuotes(array $data): Collection
    {
        return collect($data['quotes'])->map(function ($quote) use ($data) {
            return [
                'text'   => ($data['cached'] ? '[Cached] ' : '') . $quote['q'],
                'author' => $quote['a'],
            ];
        });
    }
}
