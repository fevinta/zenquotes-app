<?php

use function Livewire\Volt\{on, state};

state(['message' => '']);

on(['notify' => function ($message) {
    $this->message = $message;
    $this->dispatch('open-modal', 'confirm-user-deletion');
}]);

?>

<div>
    <x-modal  name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <div class="w-full text-center text-gray-500">
            <p class="p-10">{{ $message }}</p>
        </div>
    </x-modal>
</div>
