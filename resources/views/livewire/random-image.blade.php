<?php

use \App\Services\ZenQuotesService;
use function Livewire\Volt\{state, layout};

layout('layouts.app');

state([
    'image' => fn(ZenQuotesService $service) => $service->getImage()
]);

?>
<div>
    <h1 class="text-xl font-bold mb-5">Random Inspirational Image</h1>
    <x-image :image="$image"/>
</div>
