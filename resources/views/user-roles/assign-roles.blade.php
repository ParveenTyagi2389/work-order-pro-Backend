<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Roles to User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
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
                        <div>
                            <h3 class="text-lg font-semibold">Assign Roles to: <span class="text-blue-600">{{ $user->name }}</span></h3>
                            <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                        </div>
                        <a href="{{ route('user-roles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            ← Back
                        </a>
                    </div>
                    
                    <form action="{{ route('user-roles.store-roles', $user->id) }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Select Roles <span class="text-red-500">*</span>
                            </label>
                            @if(isset($roles) && $roles->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-gray-200 rounded-lg">
                                    @foreach($roles as $role)
                                        <div class="flex items-center p-2 hover:bg-gray-50 rounded">
                                            <input type="checkbox" 
                                                   id="role_{{ $role->id }}" 
                                                   name="roles[]" 
                                                   value="{{ $role->id }}"
                                                   {{ in_array($role->id, $userRoles ?? []) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="role_{{ $role->id }}" class="ml-2 text-sm text-gray-700">
                                                <span class="font-medium">{{ $role->name }}</span>
                                                <span class="text-xs text-gray-500">
                                                    ({{ $role->permissions->count() }} permissions)
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-gray-500 text-xs mt-1">Select one or more roles to assign to this user</small>
                            @else
                                <p class="text-sm text-gray-500">No roles available. <a href="{{ route('roles.index') }}" class="text-blue-500 hover:underline">Create roles first</a></p>
                            @endif
                        </div>

                        <!-- Current Roles Info -->
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-medium text-sm text-gray-700 mb-2">Current Roles:</h4>
                            @if($user->roles->count() > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($user->roles as $role)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No roles assigned to this user.</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Save Roles
                            </button>
                            <a href="{{ route('user-roles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>