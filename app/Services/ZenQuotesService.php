<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

class ZenQuotesService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://zenquotes.io/api/',
        ]);
    }

    public function getTodayQuote(bool $refresh = false): array
    {
        if ($refresh) {
            Cache::forget('today-quote');
        }

        $cached = Cache::has('today-quote');

        $quotes = Cache::remember('today-quote', 60 * 60 * 24, function () {
            return $this->parseResponse($this->get('today'));
        });

        return [
            'cached' => $cached,
            'quotes' => $quotes,
        ];
    }

    public function requestQuotes(int $quantity = 1, bool $refresh = false): array
    {
        $cacheKey = 'quotes-quantity-' . $quantity;

        if ($refresh) {
            Cache::forget($cacheKey);
        }

        $cached = Cache::has($cacheKey);

        $quotes = Cache::remember($cacheKey, 30, function () use ($quantity) {
            return array_slice($this->parseResponse($this->get('quotes')), 0, $quantity);
        });

        return [
            'cached' => $cached,
            'quotes' => $quotes,
        ];
    }

    public function getImage(): string
    {
        $response = Cache::remember('image', 30, function () {
            $response = $this->get('image', ['stream' => true]);

            return base64_encode($response->getBody()->getContents());
        });

        return 'data:image/jpeg;base64,' . $response;
    }

    private function get($url, array $options = []): ResponseInterface
    {
        return $this->client->get($url, $options);
    }

    private function parseResponse($response): ?array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
