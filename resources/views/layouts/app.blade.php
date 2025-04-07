<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/61b10549df.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <div class="fixed top-5 right-5 z-50 space-y-2">
            {{-- Toast Success --}}
            @if (session('success'))
                <div id="toast-success"
                    class="flex items-center w-full max-w-xs p-4 mb-4 text-green-600 bg-green-100 rounded-lg shadow-sm"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                    </div>
                    <div class="ms-3 me-3 text-sm font-normal">{{ session('success') }}</div>
                    <button type="button"
                        class="ms-auto p-1.5 text-gray-400 hover:text-gray-900 bg-white rounded-lg focus:ring-2 focus:ring-gray-300"
                        onclick="closeToast('toast-success')">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Toast Error --}}
            @if (session('error'))
                <div id="toast-danger"
                    class="flex items-center w-full max-w-xs p-4 mb-4 text-red-500 bg-red-100 rounded-lg shadow-sm"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                        </svg>
                    </div>
                    <div class="ms-3 me-3 text-sm font-normal">{{ session('error') }}</div>
                    <button type="button"
                        class="ms-auto p-1.5 text-gray-400 hover:text-gray-900 bg-white rounded-lg focus:ring-2 focus:ring-gray-300"
                        onclick="closeToast('toast-danger')">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Toast Warning --}}
            @if (session('warning'))
                <div id="toast-warning"
                    class="flex items-center w-full max-w-xs p-4 text-orange-500 bg-orange-100 rounded-lg shadow-sm "
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                        </svg>
                    </div>
                    <div class="ms-3 me-3 text-sm font-normal">{{ session('warning') }}</div>
                    <button type="button"
                        class="ms-auto p-1.5 text-gray-400 hover:text-gray-900 bg-white rounded-lg focus:ring-2 focus:ring-gray-300"
                        onclick="closeToast('toast-warning')">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <div>
            {{ $slot }}
        </div>
    </div>

    <script>
        // Fungsi untuk menutup toast secara manual
        function closeToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.style.transition = "opacity 0.5s";
                toast.style.opacity = "0";
                setTimeout(() => toast.remove(), 500);
            }
        }

        // Auto close toast setelah 5 detik
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                closeToast('toast-success');
                closeToast('toast-error');
            }, 5000); // 5000 ms = 5 detik
        });
    </script>
</body>

</html>
