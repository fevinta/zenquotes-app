<?php

namespace App\Http\Controllers\Api;

class QuotesController extends ApiController
{
    public function Index(bool $new = false)
    {
        $data = $this->service->requestQuotes(
            quantity: 5,
            refresh: $new
        );

        return $this->parseListOfQuotes($data);
    }
}
