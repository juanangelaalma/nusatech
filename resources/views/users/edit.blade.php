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
                <form action="{{ route('users.updatePassword', $user) }}" class="flex" method="POST">
                @method('PUT')
                @csrf
                  <div class="flex-1">
                    <input type="password" placeholder="New Password" name="new_password">
                    <button type="submit" class="bg-blue-500 px-2 py-1 text-white">Update</button>
                    @error('new_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
