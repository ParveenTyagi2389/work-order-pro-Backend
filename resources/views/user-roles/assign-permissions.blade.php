<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Permissions to User') }}
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
                            <h3 class="text-lg font-semibold">Assign Permissions to: <span class="text-purple-600">{{ $user->name }}</span></h3>
                            <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                        </div>
                        <a href="{{ route('user-roles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            ← Back
                        </a>
                    </div>
                    
                    <form action="{{ route('user-roles.store-permissions', $user->id) }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Select Direct Permissions
                            </label>
                            @if(isset($permissions) && $permissions->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2 p-4 border border-gray-200 rounded-lg max-h-80 overflow-y-auto">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center p-1 hover:bg-gray-50 rounded">
                                            <input type="checkbox" 
                                                   id="permission_{{ $permission->id }}" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->id }}"
                                                   {{ in_array($permission->id, $userPermissions ?? []) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500">
                                            <label for="permission_{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-gray-500 text-xs mt-1">
                                    Direct permissions are assigned directly to the user (not through roles)
                                </small>
                            @else
                                <p class="text-sm text-gray-500">No permissions available. <a href="{{ route('permissions.index') }}" class="text-blue-500 hover:underline">Create permissions first</a></p>
                            @endif
                        </div>

                        <!-- Current Permissions Info -->
                        <div class="mb-6 p-4 bg-purple-50 rounded-lg">
                            <h4 class="font-medium text-sm text-gray-700 mb-2">Current Direct Permissions:</h4>
                            @if($user->permissions->count() > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($user->permissions as $permission)
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No direct permissions assigned to this user.</p>
                            @endif
                        </div>

                        <!-- Roles-based Permissions Info -->
                        <div class="mb-6 p-4 bg-green-50 rounded-lg">
                            <h4 class="font-medium text-sm text-gray-700 mb-2">Permissions from Roles:</h4>
                            @if($user->roles->count() > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($user->roles as $role)
                                        @foreach($role->permissions as $permission)
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                                {{ $permission->name }}
                                                <span class="text-xs text-gray-500">(via {{ $role->name }})</span>
                                            </span>
                                        @endforeach
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No roles assigned, so no role-based permissions.</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Save Permissions
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