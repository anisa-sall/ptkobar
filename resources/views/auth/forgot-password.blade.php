<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>PT Kobar Indonesia - Forgot Password</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Force light mode */
            body {
                background-color: #f9fafb !important;
                color: #374151 !important;
            }
            
            .bg-white {
                background-color: #ffffff !important;
            }
            
            .text-gray-900 {
                color: #111827 !important;
            }
            
            .text-gray-800 {
                color: #1f2937 !important;
            }
            
            .text-gray-600 {
                color: #4b5563 !important;
            }
            
            .text-gray-400 {
                color: #9ca3af !important;
            }
            
            .border-gray-300 {
                border-color: #d1d5db !important;
            }
            
            .bg-gray-100 {
                background-color: #f3f4f6 !important;
            }
            
            /* Remove all dark mode classes */
            .dark\:bg-gray-900,
            .dark\:bg-gray-800,
            .dark\:border-gray-700,
            .dark\:text-gray-300,
            .dark\:text-gray-400,
            .dark\:text-gray-100,
            .dark\:focus\:border-indigo-600,
            .dark\:focus\:ring-indigo-600,
            .dark\:focus\:ring-offset-gray-800 {
                /* These will be ignored as we force light mode */
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                
                <!-- Logo PT Kobar -->
                <div class="mb-6 text-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/ptkobarnobgnew.png') }}" 
                             alt="PT Kobar Indonesia" 
                             class="mx-auto h-12 w-auto">
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">PT. Kobar Indonesia</h2>
                    <p class="text-sm text-gray-600 mt-1">Forgot Password</p>
                </div>

                <!-- Instruction Text -->
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>