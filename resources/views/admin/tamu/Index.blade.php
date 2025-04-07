<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang, ') }}
            <span class="text-indigo-500">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="flex justify-between items-center p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-bold text-lg text-gray-900 dark:text-gray-100">
                    {{ __('Daftar Akun') }}
                </div>
                <div class="div flex jutify-between gap-4">
                    <a href="{{ route('account.create') }}">
                        <x-primary-button>
                            Tambah Akun
                        </x-primary-button>
                    </a>
                    <a href="{{ route('tamu.create') }}">
                        <x-primary-button>
                            Tambah Tamu
                        </x-primary-button>
                    </a>
                </div>
            </div>

            <div class="mt-4">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                        data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <x-nav-link
                                class="inline-block p-4 border-b-2 rounded-t-lg text-gray-500 hover:text-indigo-500 hover:border-indigo-500 dark:text-gray-400 dark:hover:text-indigo-400 dark:hover:border-indigo-400 active:text-indigo-500 active:border-indigo-500"
                                id="users-tab" data-tabs-target="#users" type="button" role="tab"
                                aria-controls="users" aria-selected="true">
                                Users
                            </x-nav-link>
                        </li>
                        <li class="me-2" role="presentation">
                            <x-nav-link
                                class="inline-block p-4 border-b-2 rounded-t-lg text-gray-500 hover:text-indigo-500 hover:border-indigo-500 dark:text-gray-400 dark:hover:text-indigo-400 dark:hover:border-indigo-400 active:text-indigo-500 active:border-indigo-500"
                                id="tamu-tab" data-tabs-target="#tamu" type="button" role="tab"
                                aria-controls="tamu" aria-selected="false">
                                Tamu
                            </x-nav-link>
                        </li>
                    </ul>
                </div>

                <div id="default-tab-content">
                    <!-- Tab 1: Users -->
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="users" role="tabpanel"
                        aria-labelledby="users-tab">
                        <!-- Table Users (style tidak diubah) -->
                        <div class="mt-4">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <caption
                                        class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                        Catatan:
                                        <div
                                            class="flex items-center mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                            : Akun Aktif &nbsp;<span class="text-xs">(Bisa Digunakan)</span>
                                        </div>
                                        <div
                                            class="flex items-center mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                                            : Akun Tidak Aktif &nbsp;<span class="text-xs">(Tidak Bisa Digunakan)</span>
                                        </div>
                                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Akun dengan
                                            role <span class="text-white font-extrabold">Admin</span> tidak dapat <span
                                                class="text-white font-bold">Dinonaktifkan</span> dan <span
                                                class="text-white font-bold">Dihapus</span>!</p>
                                    </caption>
                                    <thead
                                        class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">No</th>
                                            <th scope="col" class="px-6 py-3">Nama</th>
                                            <th scope="col" class="px-6 py-3">Role</th>
                                            <th scope="col" class="px-6 py-3">Status</th>
                                            <th scope="col" class="px-6 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach ($users as $dataUser)
                                        <tbody class="text-center">
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <th scope="row"
                                                    class="flex items-center text-left px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="ps-3">
                                                        <div class="text-base font-semibold">{{ $dataUser->name }}</div>
                                                        <div class="font-normal text-gray-500">{{ $dataUser->email }}
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4 bg-gray-900">
                                                    {{ $dataUser->role }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex justify-center items-center">
                                                        @if ($dataUser->status == 'aktif')
                                                            <div
                                                                class="h-2.5 w-2.5 shadow-lg shadow-green-500 rounded-full bg-green-500 me-2">
                                                            </div>
                                                        @else
                                                            <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex justify-center items-center gap-4">
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
                                                            <form
                                                                action="{{ route('account.destroy', $dataUser->id) }}"
                                                                method="POST" class="inline-block">
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

                    <!-- Tab 2: Tamu -->
                    <div class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tamu" role="tabpanel"
                        aria-labelledby="tamu-tab">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">No</th>
                                        <th scope="col" class="px-6 py-3">Waktu</th>
                                        <th scope="col" class="px-6 py-3">Nama</th>
                                        <th scope="col" class="px-6 py-3">Angkatan</th>
                                        <th scope="col" class="px-6 py-3">Nomor Tempat Duduk</th>
                                        {{-- <th scope="col" class="px-6 py-3">Gambar</th> --}}
                                        <th scope="col" class="px-6 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tamus as $tamu)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4">{{ $tamu->created_at }}</td>
                                            <td class="px-6 py-4">{{ $tamu->nama }}</td>
                                            <td class="px-6 py-4 bg-gray-400 dark:bg-slate-900">{{ $tamu->angkatan }}</td>
                                            <td class="px-6 py-4">{{ $tamu->nomor_tempat_duduk }}</td>
                                            {{-- <td class="px-6 py-4">
                                                <img src="{{ asset('storage/' . $tamu->photo) }}" alt="Foto Tamu" class="w-32 h-32 rounded-lg">

                                            </td> --}}
                                            <td>
                                                <a href="{{ route('tamu.show', $tamu->id) }}">
                                                    <button type="button"
                                                        class="px-6 py-2 text-xs font-medium rounded-lg text-indigo-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-gray-700 focus:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-indigo-300 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-500 dark:focus:text-white">
                                                        Lihat
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Handle tab switching
                document.querySelectorAll('[data-tabs-target]').forEach((tabButton) => {
                    tabButton.addEventListener('click', () => {
                        const target = tabButton.getAttribute('data-tabs-target');

                        // Remove active state from all tabs
                        document.querySelectorAll('[role="tab"]').forEach((tab) => tab.classList.remove(
                            'text-blue-600', 'border-blue-600', 'dark:text-blue-500',
                            'dark:border-blue-500', 'active'));

                        // Hide all tab panels
                        document.querySelectorAll('[role="tabpanel"]').forEach((panel) => panel.classList.add(
                            'hidden'));

                        // Activate the clicked tab
                        tabButton.classList.add('text-blue-600', 'border-blue-600', 'dark:text-blue-500',
                            'dark:border-blue-500', 'active');

                        // Show the corresponding panel
                        document.querySelector(target).classList.remove('hidden');
                    });
                });

                document.addEventListener("DOMContentLoaded", function() {
                    const video = document.getElementById("video");
                    const canvas = document.getElementById("canvas");
                    const photoPreview = document.getElementById("photo-preview");
                    const captureBtn = document.getElementById("capture-btn");
                    const photoInput = document.getElementById("photo");

                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then(stream => {
                            video.srcObject = stream;
                        })
                        .catch(err => {
                            console.error("Gagal mengakses kamera", err);
                        });

                    captureBtn.addEventListener("click", function() {
                        const context = canvas.getContext("2d");
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const imageData = canvas.toDataURL("image/png");
                        photoInput.value = imageData;

                        console.log("Base64 Foto: ", photoInput.value); // Debugging

                        photoPreview.src = imageData;
                        photoPreview.classList.remove("hidden");
                    });
                });
            </script>


        </div>
    </div>
</x-app-layout>
