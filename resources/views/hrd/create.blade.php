<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Isi Data HRD') }}
        </h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
            Silakan lengkapi form berikut untuk mengisi data HRD Anda.
        </p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 text-red-700 dark:text-red-300 rounded-lg">
                    <div class="font-medium">{{ __('Terjadi kesalahan:') }}</div>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 text-yellow-700 dark:text-yellow-300 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Container -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('hrd.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIP -->
                            <div>
                                <x-input-label for="nip" :value="__('NIP')" />
                                <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip')" required />
                                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                            </div>

                            <!-- Name -->
                            <div>
                                <x-input-label for="nama" :value="__('Nama Lengkap')" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama')" required />
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div>
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat')" required />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>

                            <!-- Birth Place -->
                            <div>
                                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" :value="old('tempat_lahir')" required />
                                <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                            </div>

                            <!-- Birth Date -->
                            <div>
                                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                                <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir')" required />
                                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                            </div>

                            <!-- Department -->
                            <div>
                                <x-input-label for="departemen" :value="__('Departemen')" />
                                <x-text-input id="departemen" name="departemen" type="text" class="mt-1 block w-full" :value="old('departemen')" required />
                                <x-input-error :messages="$errors->get('departemen')" class="mt-2" />
                            </div>

                            <!-- Position Details -->
                            <div>
                                <x-input-label for="detail_jabatan" :value="__('Detail Jabatan')" />
                                <x-text-input id="detail_jabatan" name="detail_jabatan" type="text" class="mt-1 block w-full" :value="old('detail_jabatan')" required />
                                <x-input-error :messages="$errors->get('detail_jabatan')" class="mt-2" />
                            </div>

                            <!-- Education -->
                            <div>
                                <x-input-label for="edukasi" :value="__('Pendidikan')" />
                                <x-text-input id="edukasi" name="edukasi" type="text" class="mt-1 block w-full" :value="old('edukasi')" required />
                                <x-input-error :messages="$errors->get('edukasi')" class="mt-2" />
                            </div>

                            <!-- Gender -->
                            <div>
                                <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                                <select id="gender" name="gender" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <x-input-label for="no_telepon" :value="__('Nomor Telepon')" />
                                <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full" :value="old('no_telepon')" required />
                                <x-input-error :messages="$errors->get('no_telepon')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Simpan Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
