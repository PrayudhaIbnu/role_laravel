<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Selamat datang, ') }}
                <span class="text-indigo-500">{{ Auth::user()->name }}</span>
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Button Section -->
                    <div class="flex justify-end mb-4 mx-5">
                        <x-primary-button>
                            Tambah Artikel
                        </x-primary-button>
                    </div>

                    <!-- Content Section -->
                    <div class="flex justify-center items-start gap-6">
                        <!-- Mini Information -->
                        <div class="flex flex-col gap-4">
                            <!-- Card 1 -->
                            <a href="#"
                                class="block w-full min-w-[300px] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="text-xl font-semibold text-gray-900 dark:text-white">Jumlah Artikel  </h5>
                                <p class="font-medium text-lg text-gray-700 dark:text-gray-400">10</p>
                            </a>

                            <!-- Card 2 -->
                            <a href="#"
                                class="block w-full min-w-[300px] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="text-xl font-semibold text-gray-900 dark:text-white">Jumlah Artikel  </h5>
                                <p class="font-medium text-lg text-gray-700 dark:text-gray-400">10</p>
                            </a>
                        </div>

                        <!-- Table Card -->
                        <a href="#"
                            class="block w-full max-w-[800px] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Artikel Terbaru</h5>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-2">Judul Artikel</th>
                                            <th scope="col" class="px-4 py-2">Kategori</th>
                                            <th scope="col" class="px-4 py-2">Hari/Tanggal</th>
                                            <th scope="col" class="px-4 py-2">Status</th>
                                            <th scope="col" class="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-2 font-medium text-gray-900 dark:text-white">Apple MacBook Pro 17"</th>
                                            <td class="px-4 py-2">Silver</td>
                                            <td class="px-4 py-2">Laptop</td>
                                            <td class="px-4 py-2">$2999</td>
                                            <td class="px-4 py-2">
                                                <a href="#"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-2 font-medium text-gray-900 dark:text-white">Microsoft Surface Pro</th>
                                            <td class="px-4 py-2">White</td>
                                            <td class="px-4 py-2">Laptop PC</td>
                                            <td class="px-4 py-2">$1999</td>
                                            <td class="px-4 py-2">
                                                <a href="#"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            </td>
                                        </tr>
                                        <tr class="bg-white dark:bg-gray-800">
                                            <th scope="row"
                                                class="px-4 py-2 font-medium text-gray-900 dark:text-white">Magic Mouse 2</th>
                                            <td class="px-4 py-2">Black</td>
                                            <td class="px-4 py-2">Accessories</td>
                                            <td class="px-4 py-2">$99</td>
                                            <td class="px-4 py-2">
                                                <a href="#"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
