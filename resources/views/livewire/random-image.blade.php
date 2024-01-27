<?php

use \App\Services\ZenQuotesService;
use \Illuminate\Support\Facades\Cache;
use function Livewire\Volt\{state, layout, mount};

layout('layouts.app');

state([
    'image' => null
]);

mount(function (ZenQuotesService $service) {
    $this->image = $service->getImage();
});

?>
<div>
    <h1 class="text-xl font-bold mb-5">Random Inspirational Image</h1>
    <x-image :image="$image"/>
</div>
