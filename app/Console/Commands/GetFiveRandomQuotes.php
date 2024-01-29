<?php

namespace App\Console\Commands;

use App\Services\ZenQuotesService;
use Illuminate\Console\Command;

class GetFiveRandomQuotes extends Command
{
    protected $signature = 'Get-FiveRandomQuotes {--new}';

    public function handle(ZenQuotesService $service): void
    {
        $data = $service->requestQuotes(
            quantity: 5,
            refresh: $this->option('new')
        );

        foreach ($data['quotes'] as $quote) {
            $this->info(
                ($data['cached'] ? "[Cached] " : "") .
                $quote['q'] . " - " .
                $quote['a']
            );
        }
    }
}
