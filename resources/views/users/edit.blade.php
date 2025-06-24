<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profil User') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Form Card -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- User Profile Header -->
                    <div class="bg-gray-800 px-6 py-6 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                        <div class="relative">
                            <div
                                class="h-20 w-20 rounded-full bg-white flex items-center justify-center text-gray-800 text-2xl font-bold border-4 border-white shadow">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span
                                class="absolute bottom-0 right-0 bg-green-500 rounded-full h-5 w-5 border-2 border-white"></span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                            <p class="text-gray-200">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="px-6 py-6 space-y-6">
                        <!-- Basic Information Section -->
                        <section>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                Informasi Dasar
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Lengkap
                                    </label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat Email
                                    </label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <!-- Role Section -->
                        <section>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                Role
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                @foreach ($roles as $role)
                                    <label class="flex items-center text-sm text-gray-700">
                                        <input type="radio" name="role_id" value="{{ $role->id }}"
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 mr-2"
                                            {{ $user->role_id === $role->id ? 'checked' : '' }}>
                                        {{ $role->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('role_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </section>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between gap-4">
                        <div class="flex gap-3">
                            <!-- Save Button -->
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium uppercase tracking-wider hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Perubahan
                            </button>

                            <!-- Cancel Button -->
                            <a href="{{ route('admin.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-md text-sm font-medium uppercase tracking-wider hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                        </div>

                        <!-- Reset Password Button -->
                        <button type="button"
                            onclick="confirm('Reset password user ini?') && document.getElementById('reset-password-form').submit();"
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md text-sm font-medium uppercase tracking-wider hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Reset Password
                        </button>
                    </div>
                </form>

                <!-- Hidden Reset Password Form -->
                <form id="reset-password-form" method="POST" action="{{ route('users.reset-password', $user->id) }}"
                    class="hidden">
                    @csrf
                    @method('PUT')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
