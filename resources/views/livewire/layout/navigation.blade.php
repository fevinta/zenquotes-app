<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav x-data="{ open: false }" class="bg-white shadow border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('today') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('today')" :active="request()->routeIs('today')" wire:navigate>
                        {{ __('Today\'s Quotes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('favorite-quotes')" :active="request()->routeIs('favorite-quotes')"
                                wire:navigate>
                        {{ __('Favorites') }}
                    </x-nav-link>
                    <x-nav-link :href="route('report-favorite-quotes')"
                                :active="request()->routeIs('report-favorite-quotes')" wire:navigate>
                        {{ __('Favorites Quotes Report') }}
                    </x-nav-link>
                    @if(auth()->check())
                        <x-nav-link :href="route('secure-quotes')" :active="request()->routeIs('secure-quotes')"
                                    wire:navigate>
                            {{ __('Secure Quotes') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('quotes')" :active="request()->routeIs('quotes')" wire:navigate>
                            {{ __('Quotes') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            @if(auth()->check())
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                     x-text="name"
                                     x-on:profile-updated.window="name = $event.detail.name">
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                        {{ __('Login') }}
                    </x-nav-link>
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('today')" :active="request()->routeIs('today')" wire:navigate>
                {{ __('Today\'s Quote') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('favorite-quotes')" :active="request()->routeIs('favorite-quotes')"
                                   wire:navigate>
                {{ __('Favorites') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('report-favorite-quotes')"
                                   :active="request()->routeIs('report-favorite-quotes')" wire:navigate>
                {{ __('Favorites Quotes Report') }}
            </x-responsive-nav-link>
            @if(auth()->check())
                <x-responsive-nav-link :href="route('secure-quotes')" :active="request()->routeIs('secure-quotes')"
                                       wire:navigate>
                    {{ __('Secure Quotes') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('quotes')" :active="request()->routeIs('quotes')" wire:navigate>
                    {{ __('Quotes') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @if(auth()->check())
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800"
                         x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                         x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @else
            <div class="py-4 border-t border-gray-200">
                <x-responsive-nav-link :href="route('login')" wire:navigate>
                    {{ __('Login') }}
                </x-responsive-nav-link>
            </div>
        @endif
    </div>
</nav>
