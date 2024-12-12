<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-80">
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                            <div class="flex justify-between items-center">
                                <h1 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Detail Akun</h1>
                                <span
                                class="inline-flex items-center capitalize text-sm font-medium px-2.5 py-0.5 rounded-full
                                {{ $user->status == 'aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                <span
                                    class="w-2 h-2 me-1 rounded-full
                                    {{ $user->status == 'aktif' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $user->status }}
                            </span>

                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 font-medium">Nama :</label>
                                <p class="text-gray-900 dark:text-white">{{ $user->nama }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 font-medium">Email :</label>
                                <p class="text-gray-900 dark:text-white">{{ $user->email }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 font-medium">Role :</label>
                                <p class="text-gray-900 dark:text-white">{{ ucfirst($user->role) }}</p>
                            </div>

                            <div class="mb-4">

                            </div>
                            <div class="flex justify-end items-center gap-2">
                                @if ($user->role !== 'admin')
                                <!-- Button Aktif/Nonaktif -->
                                <form action="{{ route('account.updateStatus', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $user->status == 'aktif' ? 'tidak_aktif' : 'aktif' }}">
                                    <button type="submit"
                                        class="text-xs px-10 py-2.5 font-medium rounded-lg border focus:ring-4 focus:outline-none text-center
                                        {{ $user->status == 'aktif' ? 'text-red-700 hover:text-white border-red-700 hover:bg-red-800 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-800' : 'text-green-800 hover:text-white border-green-800 hover:bg-green-800 focus:ring-green-300 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800' }}">
                                        {{ $user->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                            @else
                                <!-- Disabled Button -->
                                <button type="button" disabled
                                    class="text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                    Tidak Dapat Diubah
                                </button>
                            @endif
                                <a href="{{ route('admin.dashboard') }}">
                                    <button type="button"
                                        class="px-10 py-2.5 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kembali</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
