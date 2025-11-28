@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="text-7xl mb-4 bounce-animation">👥</div>
        <h1 class="text-5xl font-bold text-gray-800 mb-2">
            Manage Users
        </h1>
        <p class="text-2xl text-gray-600 font-semibold">View & manage all users</p>
    </div>

    <!-- Users Table -->
    <div class="toca-card p-8 bg-gradient-to-br from-white to-toca-sky/20">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-gray-800">
                        <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Name</th>
                        <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Email</th>
                        <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Role</th>
                        <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Status</th>
                        <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Registered</th>
                        <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b-2 border-gray-200 hover:bg-toca-lavender/20 transition-all">
                        <td class="py-4 px-4 text-gray-800 font-bold">{{ $user->name }}</td>
                        <td class="py-4 px-4 text-gray-700 font-semibold">{{ $user->email }}</td>
                        <td class="py-4 px-4">
                            <span class="toca-badge
                                {{ $user->role === 'admin' ? 'bg-red-500 text-white border-gray-800' : '' }}
                                {{ $user->role === 'organizer' ? 'toca-badge-purple' : '' }}
                                {{ $user->role === 'user' ? 'toca-badge-blue' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="toca-badge text-xs
                                {{ $user->status === 'approved' ? 'toca-badge-green' : '' }}
                                {{ $user->status === 'pending' ? 'toca-badge-yellow' : '' }}
                                {{ $user->status === 'rejected' ? 'toca-badge-red' : '' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-gray-700 font-semibold text-sm">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex gap-2">
                                @if($user->role === 'organizer' && $user->status === 'pending')
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-700 font-bold text-sm">
                                            ✅ Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-bold text-sm">
                                            ❌ Reject
                                        </button>
                                    </form>
                                @endif
                                
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this user? 🗑️')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-bold text-sm">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
