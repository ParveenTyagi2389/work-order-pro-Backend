<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Create Role Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Create New Role') }}</h3>
                    
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Role Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror" 
                                       placeholder="e.g., editor, manager" 
                                       required />
                                @error('name')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>   
                                @enderror
                                <small class="text-gray-500 text-xs">Use lowercase (e.g., editor, manager, admin)</small>
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

                        <!-- Permissions Selection -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Assign Permissions
                            </label>
                            @if(isset($permissions) && $permissions->count() > 0)
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 p-3 border border-gray-200 rounded-lg">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   id="permission_{{ $permission->id }}" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->id }}"
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="permission_{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No permissions available. <a href="{{ route('permissions.index') }}" class="text-blue-500 hover:underline">Create permissions first</a></p>
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Create Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Roles List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('All Roles') }}</h3>
                    
                    @if(isset($roles) && $roles->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guard</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Users</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($roles as $role)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                    {{ $role->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $role->guard_name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                @if($role->permissions->count() > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($role->permissions->take(3) as $permission)
                                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                                {{ $permission->name }}
                                                            </span>
                                                        @endforeach
                                                        @if($role->permissions->count() > 3)
                                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                                +{{ $role->permissions->count() - 3 }} more
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-400">No permissions</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                    {{ $role->users->count() }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $role->created_at->format('d-m-Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('roles.edit', $role->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" {{ $role->name === 'admin' ? 'disabled' : '' }}>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $roles->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No roles found. Create your first role above!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>