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
        return $this->service->requestQuotes(
            quantity: 5,
            refresh: $new
        );
    }
}
