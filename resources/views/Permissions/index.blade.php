<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Create Permission Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Create New Permission') }}</h3>
                    
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Permission Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror" 
                                       placeholder="e.g., manage-users" 
                                       required />
                                @error('name')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>   
                                @enderror
                                <small class="text-gray-500 text-xs">Use lowercase and hyphens (e.g., manage-users)</small>
                            </div>

                            <div>
                                <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Guard Name
                                </label>
                                <input type="text" 
                                       id="guard_name" 
                                       name="guard_name" 
                                       value="{{ old('guard_name', 'web') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                       placeholder="web" />
                                <small class="text-gray-500 text-xs">Default is 'web' for most cases</small>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Create Permission
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Permissions List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('All Permissions') }}</h3>
                    
                    @if(isset($permissions) && $permissions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permission Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guard</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $permission->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $permission->guard_name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $permission->created_at->format('d-m-Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @can('edit permissions')
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                @endcan
                                                @can('delete permissions')
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this permission?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $permissions->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No permissions found. Create your first permission above!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>