<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Permission') }}
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
                        <h3 class="text-lg font-semibold">{{ __('Edit Permission') }}</h3>
                        <a href="{{ route('permissions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            ← Back to Permissions
                        </a>
                    </div>
                    
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Permission Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $permission->name) }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror" 
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
                                       value="{{ old('guard_name', $permission->guard_name) }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                       placeholder="web" />
                                <small class="text-gray-500 text-xs">Default is 'web' for most cases</small>
                            </div>
                        </div>

                        <!-- Assigned Roles (Optional) -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Assigned to Roles
                            </label>
                            @if($permission->roles->count() > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($permission->roles as $role)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">This permission is not assigned to any role.</p>
                            @endif
                        </div>

                        <div class="mt-6 flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Update Permission
                            </button>
                            <a href="{{ route('permissions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Cancel
                            </a>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline ml-auto" onsubmit="return confirm('Are you sure you want to delete this permission?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                    Delete Permission
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>