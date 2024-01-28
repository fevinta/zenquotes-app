<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
        $path = 'today';
        if ($refresh) {
            Cache::forget('today-quote');
            $path .= '/new';
        }

        return [
            'cached' => Cache::has('today-quote'),
            'data'   => Cache::remember('today-quote', 60 * 60 * 24, function () use ($path) {
                $quote = $this->parseResponse($this->get($path))[0];

                if ($quote['q'] === 'Too many requests. Obtain an auth key for unlimited access.') {
                    Cache::forget('today-quote');
                }

                return $quote;
            })
        ];
    }

    public function getRandomQuotes(int $quantity = 1, bool $forceNew = false): array
    {
        $cachedQuotes = $this->getCachedQuotes();

        if ($forceNew) {
            $quotes = $this->fetchNewQuotes($quantity);
            $this->updateCache($cachedQuotes->merge($quotes));

            return $quotes->all();
        } else {
            if ($cachedQuotes->count() < $quantity) {
                $newQuotes = $this->fetchNewQuotes($quantity - $cachedQuotes->count());
                $cachedQuotes = $cachedQuotes->merge($newQuotes);
                $this->updateCache($cachedQuotes);
            }

            return $this->getRandomizedQuotes($cachedQuotes, $quantity);
        }
    }

    private function getCachedQuotes(): Collection
    {
        return collect(Cache::get('random-quotes', []));
    }

    private function fetchNewQuotes(int $quantity): Collection
    {
        $quotes = collect();
        while ($quotes->count() < $quantity) {
            $newQuote = $this->parseResponse($this->get('random'))[0];
            if ($newQuote['q'] === 'Too many requests. Obtain an auth key for unlimited access.') {
                break;
            }
            $quotes->push($newQuote);
        }

        return $quotes;
    }

    private function updateCache(Collection $quotes): void
    {
        Cache::put('random-quotes', $quotes->toArray());
    }

    private function getRandomizedQuotes(Collection $quotes, int $quantity): array
    {
        if ($quotes->count() < $quantity) {
            return $quotes->all();
        }

        return $quotes->random($quantity)->all();
    }

    public function getImage(): string
    {
        $response = $this->get('image', ['stream' => true]);
        $base64 = base64_encode($response->getBody()->getContents());

        // Todo save image locally
        //Storage::put('public/zen-quotes.jpg', $base64)

        return 'data:image/jpeg;base64,' . $base64;
    }

    private function get($url, array $options = []): ResponseInterface
    {
        Log::info("Requested $url at " . now()->toDateTimeString());

        return $this->client->get($url, $options);
    }

    private function parseResponse($response): ?array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
