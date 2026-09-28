<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Roles & Permissions Management') }}
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

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Users</div>
                        <div class="text-2xl font-bold">{{ \App\Models\User::count() }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Roles</div>
                        <div class="text-2xl font-bold">{{ \Spatie\Permission\Models\Role::count() }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Permissions</div>
                        <div class="text-2xl font-bold">{{ \Spatie\Permission\Models\Permission::count() }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Admins</div>
                        <div class="text-2xl font-bold">{{ \App\Models\User::role('admin')->count() }}</div>
                    </div>
                </div>
            </div>

            <!-- Users List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Users with Roles & Permissions') }}</h3>
                    
                    @if(isset($users) && $users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Direct Permissions</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                @if($user->roles->count() > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($user->roles as $role)
                                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                                {{ $role->name }}
                                                                @can('manage-user-roles')
                                                                    <button onclick="removeRole({{ $user->id }}, {{ $role->id }})" 
                                                                            class="ml-1 text-red-500 hover:text-red-700">
                                                                        ×
                                                                    </button>
                                                                @endcan
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-400">No roles</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                @if($user->permissions->count() > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($user->permissions as $permission)
                                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                                {{ $permission->name }}
                                                                @can('manage-user-permissions')
                                                                    <button onclick="removePermission({{ $user->id }}, {{ $permission->id }})" 
                                                                            class="ml-1 text-red-500 hover:text-red-700">
                                                                        ×
                                                                    </button>
                                                                @endcan
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-400">No direct permissions</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex flex-col space-y-1">
                                                    <a href="{{ route('user-roles.assign-roles', $user->id) }}" 
                                                       class="text-indigo-600 hover:text-indigo-900 text-xs">
                                                        Assign Roles
                                                    </a>
                                                    {{-- <a href="{{ route('user-roles.assign-permissions', $user->id) }}" 
                                                       class="text-purple-600 hover:text-purple-900 text-xs">
                                                        Assign Permissions
                                                    </a>
                                                    <button onclick="viewPermissions({{ $user->id }})" 
                                                            class="text-green-600 hover:text-green-900 text-xs text-left">
                                                        View All Permissions
                                                    </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- View Permissions Modal -->
    <div id="permissionsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">User Permissions</h3>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
            </div>
            <div id="permissionsContent">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    function removeRole(userId, roleId) {
        if (!confirm('Are you sure you want to remove this role from the user?')) return;
        
        fetch('{{ route("user-roles.remove-role") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                user_id: userId,
                role_id: roleId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removePermission(userId, permissionId) {
        if (!confirm('Are you sure you want to remove this permission from the user?')) return;
        
        fetch('{{ route("user-roles.remove-permission") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                user_id: userId,
                permission_id: permissionId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function viewPermissions(userId) {
        fetch('/user-roles/' + userId + '/permissions')
            .then(response => response.json())
            .then(data => {
                let html = '<div class="mb-4">';
                html += '<p><strong>User:</strong> ' + data.user.name + '</p>';
                html += '</div>';
                
                html += '<div class="mb-4">';
                html += '<h4 class="font-semibold">Roles:</h4>';
                if (data.roles.length > 0) {
                    html += '<div class="flex flex-wrap gap-1 mt-1">';
                    data.roles.forEach(role => {
                        html += '<span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">' + role.name + '</span>';
                    });
                    html += '</div>';
                } else {
                    html += '<p class="text-sm text-gray-500">No roles assigned</p>';
                }
                html += '</div>';
                
                html += '<div>';
                html += '<h4 class="font-semibold">All Permissions:</h4>';
                if (data.all_permissions.length > 0) {
                    html += '<div class="flex flex-wrap gap-1 mt-1">';
                    data.all_permissions.forEach(permission => {
                        html += '<span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">' + permission.name + '</span>';
                    });
                    html += '</div>';
                } else {
                    html += '<p class="text-sm text-gray-500">No permissions available</p>';
                }
                html += '</div>';
                
                document.getElementById('permissionsContent').innerHTML = html;
                document.getElementById('permissionsModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    }

    function closeModal() {
        document.getElementById('permissionsModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('permissionsModal');
        if (event.target == modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endpush