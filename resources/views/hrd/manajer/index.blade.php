<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Manajer') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 space-y-6">

                    {{-- Search and Filter --}}
                    <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
                        <form method="GET" class="w-full md:w-auto">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-magnifying-glass class="h-5 w-5 text-gray-400" />
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:text-gray-300"
                                    placeholder="Cari manajer..." onchange="this.form.submit()">
                            </div>
                        </form>

                        <form method="GET" class="w-full md:w-auto">
                            <select name="status_filter" onchange="this.form.submit()"
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md bg-white dark:bg-gray-700 dark:text-gray-300">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status_filter') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="non-aktif"
                                    {{ request('status_filter') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </form>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 dark:ring-gray-600 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    @foreach ([
        'nip' => 'NIP',
        'nama' => 'Nama',
        'departemen' => 'Departemen',
        'jabatan' => 'Jabatan',
        'detail_jabatan' => 'Detail Jabatan',
        'status' => 'Status',
    ] as $field => $label)
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <a href="{{ request()->fullUrlWithQuery([
                                                'sort' => $field,
                                                'direction' => request('sort') === $field && request('direction') === 'asc' ? 'desc' : 'asc',
                                                'search' => request('search') ?? '',
                                                'status_filter' => request('status_filter') ?? '',
                                            ]) }}"
                                                class="flex items-center group">
                                                {{ $label }}
                                                @if (request('sort') === $field)
                                                    <x-heroicon-s-chevron-up-down
                                                        class="w-4 h-4 ml-1 @if (request('direction') === 'asc') rotate-180 @endif text-gray-400 dark:text-gray-300 group-hover:text-gray-500 dark:group-hover:text-gray-400" />
                                                @else
                                                    <x-heroicon-s-chevron-up-down
                                                        class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 text-gray-400 dark:text-gray-300" />
                                                @endif
                                            </a>
                                        </th>
                                    @endforeach
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-300 dark:divide-gray-600">
                                @forelse ($manajers as $manajer)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $manajer->nip }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $manajer->nama }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $manajer->departemen }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ ucfirst($manajer->user->role->name) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $manajer->detail_jabatan }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <form action="{{ route('hrd.manajer.updateStatus', $manajer->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()"
                                                    class="rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                                    <option value="Aktif"
                                                        {{ $manajer->status === 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Non-Aktif"
                                                        {{ $manajer->status === 'Non-Aktif' ? 'selected' : '' }}>
                                                        Non-Aktif</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">

                                                <a href="{{ route('penilaian.manajer.create', ['manajer_id' => $manajer->id]) }}"
                                                    class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                    title="Buat Penilaian">
                                                    <x-heroicon-o-clipboard-document-list class="h-5 w-5" />
                                                </a>
                                                <a href="{{ route('hrd.manajer.show', $manajer->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    title="Detail">
                                                    <x-heroicon-o-eye class="h-5 w-5" />
                                                </a>

                                                <form action="{{ route('hrd.manajer.destroy', $manajer->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus manajer ini?')">
                                                        <x-heroicon-o-trash class="h-5 w-5" />
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Tidak ada data manajer.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($manajers->hasPages())
                        <div
                            class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                            {{ $manajers->withQueryString()->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
