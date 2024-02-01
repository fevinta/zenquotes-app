<?php

use function Livewire\Volt\{layout, state, form, rules};
use GuzzleHttp\Client;

layout('layouts.app');

state([
    'user'   => fn() => auth()->user(),
    'method' => 'GET',
    'path'   => 'quotes',
    'code'   => '',
    'body'   => ''
]);

rules([
    'method' => ['required', 'string', 'in:GET,POST'],
    'path'   => ['required', 'string', 'in:quotes,secure-quotes'],
    'body'   => ['sometimes', 'string'],
]);

$makeRequest = function () {
    $this->code = "";
    $this->body = "";

    $validated = $this->validate();

    $client = new Client();

    $url = config('app.url') . '/api/' . $this->path;

    $options = [
        'headers' => [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ],
    ];

    if ($this->method === 'POST') {
        $options['body'] = $this->body;
    }

    if (auth()->check()) {
        $options['headers']['Authorization'] = $this->getApiToken();
    }

    try {
        $response = $client->request($this->method, $url, $options);
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        $response = $e->getResponse();
    }

    $this->code = $response->getStatusCode();
    $this->body = json_decode($response->getBody()->getContents(), true);
};

?>
<div>
    <div class="mb-5 flex flex-row justify-between">
        <h1 class="text-xl font-bold">API Test</h1>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
        @if($this->user)
            <div class="mb-4">
                <x-input-label for="authenticated_as" :value="__('Authenticated as')"/>
                <x-text-input value="{{$this->user->name}}"
                              id="authenticated_as"
                              name="authenticated_as"
                              class="block mt-1 w-full bg-gray-100"
                              type="text"
                              disabled/>
            </div>
        @endif

        <form wire:submit="makeRequest">
            <div>
                <x-input-label for="method" :value="__('Method')"/>
                <select wire:model="method" id="method" name="method"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                        required autofocus>
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                </select>
                <x-input-error :messages="$errors->get('method')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="path" :value="__('Method')"/>
                <select wire:model="path" id="path" name="path"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                        required>
                    <option value="quotes">/quotes</option>
                    <option value="secure-quotes">/secure-quotes</option>
                </select>
                <x-input-error :messages="$errors->get('path')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Test') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @if($this->code !== "" && $this->body !== "")
        <div class="mt-5">
            <div class="flex flex-row justify-between items-center mb-5">
                <h2 class="text-xl font-bold">Response</h2>
                <span class="text-base text-gray-500">Response Code: {{ $this->code }}</span>
            </div>
            <div class="mt-5 p-5 bg-gray-800 rounded-lg shadow text-white overflow-scroll max-h-[500px]">
                <pre><code>{{ json_encode($this->body, JSON_PRETTY_PRINT) }}</code></pre>
            </div>
        </div>
    @endif
</div>


