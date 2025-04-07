<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang, ') }}
            <span class="text-indigo-500">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Button Section -->
                    <div class="flex justify-end mb-4 mx-5">
                        <a href="{{ route('articles.create') }}">
                            <x-primary-button>
                                Tambah Artikel
                            </x-primary-button>
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul Artikel</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Penulis</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <!-- Judul Artikel -->
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $article->title }}
                                    </th>

                                    <!-- Status Artikel -->
                                    <td class="px-6 py-4">
                                        @if ($article->is_active)
                                            <span class="text-green-600 font-medium">Aktif</span>
                                        @else
                                            <span class="text-red-600 font-medium">Tidak Aktif</span>
                                        @endif
                                    </td>

                                    <!-- Penulis -->
                                    <td class="px-6 py-4">
                                        {{ $article->user->name ?? 'Tidak Diketahui' }}
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-6 py-4 flex space-x-3">
                                        <!-- Edit Link -->
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                                        <!-- Hapus Button (Khusus Guest) -->
                                        @if(auth()->user()->hasRole('guest'))
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
