<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-bold text-lg text-gray-900 dark:text-gray-100">
                    {{ __('Daftar Akun') }}
                </div>
                <a href="{{ route('account.create') }}">
                    <x-primary-button>
                        Tambah Akun
                    </x-primary-button>
                </a>
            </div>

            <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Catatan :
                        <div class="flex items-center mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                            : Akun Aktif &nbsp;<span class="text-xs">(Bisa Digunakan)</span>
                        </div>
                        <div class="flex items-center mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                            : Akun Tidak Aktif &nbsp;<span class="text-xs">(Tidak Bisa Digunakan)</span>
                        </div>
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Akun dengan role <span
                                class="text-white font-extrabold">Admin</span> tidak dapat <span
                                class="text-white font-bold">Dinonaktifkan</span> dan <span
                                class="text-white font-bold">Dihapus</span>!</p>
                    </caption>
                    <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    @foreach ($users as $dataUser)
                        <tbody class="text-center">
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $dataUser->id }}
                                </th>
                                <th scope="row" class="flex items-center text-left px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $dataUser->name }}</div>
                                        <div class="font-normal text-gray-500">{{ $dataUser->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4 bg-gray-900">
                                    {{ $dataUser->role }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center">
                                        <!-- Cek status pengguna -->
                                        @if ($dataUser->status == 'aktif')
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                        @else
                                            <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-4">
                                        <!-- Button Groups -->
                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                            <a href="{{ route('account.show', $dataUser->id) }}">
                                                <button type="button"
                                                    class="inline-flex items-center px-2 py-2 text-xs font-medium text-indigo-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-gray-700 focus:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-indigo-300 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-500 dark:focus:text-white">
                                                    Lihat
                                                </button>
                                            </a>

                                            <a href="{{ route('account.edit', $dataUser->id) }}">
                                                <button type="button"
                                                    class="inline-flex items-center px-2 py-2 text-xs font-medium text-cyan-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-gray-700 focus:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-cyan-500 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-500 dark:focus:text-white">
                                                    Sunting
                                                </button>
                                            </a>

                                            <form action="{{ route('account.destroy', $dataUser->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-2 text-xs font-medium text-red-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-gray-700 focus:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-red-400 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-500 dark:focus:text-white">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
