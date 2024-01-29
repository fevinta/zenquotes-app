<?php

namespace App\Http\Controllers\Api;

use App\Services\ZenQuotesService;

class QuoteController
{
    public function __construct(
        private readonly ZenQuotesService $service
    ) {
        //
    }

    public function Index(bool $new = false)
    {
        $data = $this->service->requestQuotes(
            quantity: 5,
            refresh: $new
        );

        return collect($data['quotes'])->map(function ($quote) use ($data) {
            return [
                'text'   => ($data['cached'] ? '[Cached] ' : '') . $quote['q'],
                'author' => $quote['a'],
            ];
        });
    }
}
