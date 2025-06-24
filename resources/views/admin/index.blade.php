<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Role User') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                    <!-- Search and Filter -->
                    <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
                        <form method="GET" class="w-full md:w-auto">
                            @foreach (['sort', 'direction', 'role_filter'] as $param)
                                @if (request($param))
                                    <input type="hidden" name="{{ $param }}" value="{{ request($param) }}">
                                @endif
                            @endforeach

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-magnifying-glass class="h-5 w-5 text-gray-400" />
                                </div>
                                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Search users..." onchange="this.form.submit()">
                            </div>
                        </form>

                        <!-- Ganti bagian form filter role dengan ini -->
                        <form method="GET" class="w-full md:w-auto">
                            @foreach (['search', 'sort', 'direction'] as $param)
                                @if (request($param))
                                    <input type="hidden" name="{{ $param }}" value="{{ request($param) }}">
                                @endif
                            @endforeach

                            <select name="role_filter" onchange="this.form.submit()"
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Semua Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->slug }}"
                                        {{ request('role_filter') == $role->slug ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach ([
        'name' => 'Name',
        'email' => 'Email',
        'role_id' => 'Role',
    ] as $field => $label)
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('admin.index', [
                                                'sort' => $field,
                                                'direction' => $filters['sort'] === $field && $filters['direction'] === 'asc' ? 'desc' : 'asc',
                                                'search' => $filters['search'] ?? '',
                                                'role_filter' => $filters['role_filter'] ?? '',
                                            ]) }}"
                                                class="flex items-center group">
                                                {{ $label }}
                                                @if ($filters['sort'] === $field)
                                                    <x-heroicon-s-chevron-up
                                                        class="w-4 h-4 ml-1 {{ $filters['direction'] === 'desc' ? 'transform rotate-180' : '' }} text-gray-400 group-hover:text-gray-500" />
                                                @else
                                                    <x-heroicon-s-chevron-up
                                                        class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 text-gray-400" />
                                                @endif
                                            </a>
                                        </th>
                                    @endforeach
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <form method="POST" action="{{ route('admin.update', $user) }}"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="role_id" onchange="this.form.submit()"
                                                    class="rounded-md border-gray-300 py-1 pl-2 pr-8 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Tidak ada role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('users.edit', $user) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                                    title="Edit">
                                                    <x-heroicon-o-pencil-square class="h-5 w-5" />
                                                </a>

                                                <form method="POST" action="{{ route('users.destroy', $user) }}"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                                        class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                        title="Delete">
                                                        <x-heroicon-o-trash class="h-5 w-5" />
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($users->hasPages())
                        <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
