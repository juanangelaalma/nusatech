<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::user() && Auth::user()->isAdmin())
                    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white py-1 px-2">Tambah User</a>
                    @endif
                    <table class="w-full text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Role</th>
                                @if (!Auth::user() || (Auth::user() && !Auth::user()->isFinance()))
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="py-2">{{ $user->id }}</td>
                                    <td class="py-2">{{ $user->email }}</td>
                                    <td class="py-2">{{ $user->active }}</td>
                                    <td class="py-2">{{ $user->role }}</td>
                                    @if (!Auth::user() || (Auth::user() && !Auth::user()->isFinance()))
                                    <td class="py-2">
                                        @if (Auth::user() && Auth::user()->isAdmin())
                                        <a href="{{ route('users.editPassword', $user) }}" class="text-white py-1 px-2 bg-green-500">Update</a>
                                        @endif
                                        @if (Auth::user() && (Auth::user()->isAdmin() || Auth::user()->isSupport()))
                                        @if ($user->active == 1)
                                        <form action="{{ route('users.deactive', $user) }}" method="POST" class="inline-block">
                                            @method("PUT")
                                            @csrf
                                            <button type="submit" class="text-white py-1 px-2 bg-orange-500">Deactive</button>
                                        </form>
                                        @else
                                        <form action="{{ route('users.active', $user) }}" method="POST" class="inline-block">
                                            @method("PUT")
                                            @csrf
                                            <button type="submit" class="text-white py-1 px-2 bg-orange-500">Active</button>
                                        </form>
                                        @endif
                                        @endif
                                        @if (Auth::user() && Auth::user()->isAdmin())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit" class="text-white py-1 px-2 bg-red-500">Delete</button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
