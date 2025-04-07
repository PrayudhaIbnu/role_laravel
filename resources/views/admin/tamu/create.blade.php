<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Tamu') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="flex justify-center items-start gap-6">
                    {{-- form --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg text-gray-900 dark:text-gray-100">
                        <form method="POST" action="{{ route('tamu.store') }}"
                            class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            @csrf

                            <!-- Nama -->
                            <div class="mb-4">
                                <label for="nama"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Nama lengkap" required>
                                @error('nama')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Angkatan -->
                            <div class="mb-4">
                                <label for="angkatan"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Angkatan</label>
                                <select name="angkatan" id="angkatan"
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 py-2 px-3 text-sm shadow-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    required>
                                    <option value="">Pilih Angkatan</option>
                                    <option value="22" {{ old('angkatan') == '22' ? 'selected' : '' }}>22</option>
                                    <option value="23" {{ old('angkatan') == '23' ? 'selected' : '' }}>23</option>
                                    <option value="24" {{ old('angkatan') == '24' ? 'selected' : '' }}>24</option>
                                    <option value="25" {{ old('angkatan') == '25' ? 'selected' : '' }}>25</option>
                                    <option value="26" {{ old('angkatan') == '26' ? 'selected' : '' }}>26</option>
                                </select>
                                @error('angkatan')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kamera -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ambil
                                    Foto</label>
                                <div class="flex flex-col items-center">
                                    <input type="file" id="file-input" accept="image/*" capture="environment"
                                        class="hidden">
                                    <button type="button" id="open-camera-btn"
                                        class="mt-2 px-6 py-2 text-xs font-medium rounded-lg text-blue-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-gray-700 focus:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-blue-300 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-500 dark:focus:text-white">
                                        <i class="fa-solid fa-camera"></i>
                                    </button>
                                    <img id="photo-preview" class="w-48 h-48 mt-2 rounded-lg hidden">
                                    <input type="hidden" name="photo" id="photo">
                                </div>
                            </div>


                            <div class="my-5 mx-3">
                                <caption
                                    class="text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                    Catatan:
                                    <div
                                        class="flex items-center mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                        : Kursi Sudah Digunakan</span>
                                    </div>
                                    <div
                                        class="flex items-center mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                                        : Kursi Belum Digunakan</span>
                                    </div>
                                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Ketentuan
                                        penempatan
                                        kursi angkatan <span class="text-white font-extrabold">26,22,25,23,24</span>,
                                        angkatan yang sama tidak diperbolehkan <span
                                            class="text-white font-bold">Duduk Bersampingan</span>!</p>
                                </caption>
                            </div>

                            <hr class="mb-3">

                            <!-- Pilih Nomor Kursi -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Nomor
                                    Kursi</label>
                                <div class="flex flex-wrap justify-center">
                                    @foreach (range(1, 20) as $number)
                                        <!-- Mengulangi untuk 20 kursi -->
                                        <div class="m-2 flex items-center justify-center">
                                            <input type="radio" id="kursi-{{ $number }}"
                                                name="nomor_tempat_duduk" value="{{ $number }}"
                                                class="hidden kursi-radio"
                                                {{ in_array($number, $usedSeats) ? 'disabled' : '' }} required>
                                            <label for="kursi-{{ $number }}"
                                                class="block w-16 h-16 border font-extrabold border-gray-300 text-center rounded-lg cursor-pointer
                                                {{ in_array($number, $usedSeats) ? 'bg-red-700 text-white cursor-not-allowed' : 'bg-gray-700 text-white' }}
                                                {{ in_array($number, $usedSeats) ? '' : 'transition duration-200 ease-in-out transform hover:scale-105 h hover:text-white' }}  flex items-center justify-center text-lg font-semibold">
                                                {{ $number }}
                                                @if (in_array($number, $usedSeats))
                                                    | {{ $angkatan[$number] }}
                                                    <!-- Menampilkan angkatan jika kursi sudah terpakai -->
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('nomor_tempat_duduk')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-green-800 rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                                Registrasi
                            </button>
                            {{-- <button type=""
                                    class="w-full mt-3 px-4 py-2 text-white bg-yellow-800 rounded-md shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-1">
                                    Ambil Foto
                                </button> --}}
                        </form>
                    </div>

                    {{-- table --}}
                    <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Angkatan</th>
                                    <th scope="col" class="px-6 py-3">Nomor Tempat Duduk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tamus as $tamu)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">{{ $tamu->nama }}</td>
                                        <td class="px-6 py-4">{{ $tamu->angkatan }}</td>
                                        <td class="px-6 py-4">{{ $tamu->nomor_tempat_duduk }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.kursi-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset semua label kursi untuk mengembalikan warna awal
                document.querySelectorAll('.kursi-radio + label').forEach(label => {
                    // Cek jika label tersebut milik kursi yang sudah terpakai
                    if (label.classList.contains('bg-red-700')) {
                        label.classList.remove('bg-blue-500',
                            'text-white'); // Reset warna untuk kursi yang sudah terpakai
                        label.classList.add('bg-red-700', 'text-white'); // Kembali ke warna asal
                    } else {
                        label.classList.remove('bg-blue-500',
                            'text-white'); // Reset warna untuk kursi yang tidak terpakai
                        label.classList.add('bg-gray-700', 'text-white'); // Kembali ke warna asal
                    }
                });

                // Ubah warna label yang dipilih
                const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                selectedLabel.classList.remove('bg-gray-700', 'text-white'); // Hapus warna asal
                selectedLabel.classList.add('bg-blue-500', 'text-white'); // Ganti warna sesuai keinginan
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("file-input");
            const openCameraBtn = document.getElementById("open-camera-btn");
            const photoPreview = document.getElementById("photo-preview");
            const photoInput = document.getElementById("photo");

            // Buka kamera bawaan saat tombol ditekan
            openCameraBtn.addEventListener("click", function() {
                fileInput.click();
            });

            // Ambil foto dari kamera bawaan
            fileInput.addEventListener("change", function(event) {
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                        photoPreview.classList.remove("hidden");
                        photoInput.value = e.target.result; // Simpan dalam format Base64
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        });
    </script>
</x-app-layout>
