<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
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

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ __('Edit Role:') }} <span class="text-blue-600">{{ $role->name }}</span></h3>
                        <a href="{{ route('roles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            ← Back to Roles
                        </a>
                    </div>
                    
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Role Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $role->name) }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror" 
                                       required />
                                @error('name')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>   
                                @enderror
                            </div>

                            <div>
                                <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Guard Name
                                </label>
                                <input type="text" 
                                       id="guard_name" 
                                       name="guard_name" 
                                       value="{{ old('guard_name', $role->guard_name) }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                       placeholder="web" />
                            </div>
                        </div>

                        <!-- Permissions Selection -->
                        <div class="mt-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Assign Permissions
                            </label>
                            @if(isset($permissions) && $permissions->count() > 0)
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 p-3 border border-gray-200 rounded-lg max-h-60 overflow-y-auto">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   id="permission_{{ $permission->id }}" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->id }}"
                                                   {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="permission_{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-gray-500 text-xs mt-1">Select permissions to assign to this role</small>
                            @else
                                <p class="text-sm text-gray-500">No permissions available. <a href="{{ route('permissions.index') }}" class="text-blue-500 hover:underline">Create permissions first</a></p>
                            @endif
                        </div>

                        <!-- Current Users with this Role -->
                        <div class="mt-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Users with this role
                            </label>
                            @if($role->users->count() > 0)
                                <div class="flex flex-wrap gap-2 p-3 border border-gray-200 rounded-lg">
                                    @foreach($role->users as $user)
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                                            {{ $user->name ?? $user->email }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No users assigned to this role.</p>
                            @endif
                        </div>

                        <div class="mt-6 flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Update Role
                            </button>
                            <a href="{{ route('roles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Cancel
                            </a>
                            @if($role->name !== 'admin')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline ml-auto" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                        Delete Role
                                    </button>
                                </form>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>