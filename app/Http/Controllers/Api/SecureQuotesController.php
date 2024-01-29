<?php

namespace App\Http\Controllers\Api;

class SecureQuotesController extends ApiController
{
    public function Index(bool $new = false)
    {
        $data = $this->service->requestQuotes(
            quantity: 10,
            refresh: $new
        );

        return $this->parseListOfQuotes($data);
    }
}
