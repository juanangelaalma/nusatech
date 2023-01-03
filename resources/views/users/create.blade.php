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
                <form action="{{ route('users.store') }}" class="flex" method="POST">
                @csrf
                  <div class="flex-1">
                    <input type="text" placeholder="Email" name="email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="flex-1">
                    <input type="password" placeholder="Password" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="flex-1">
                    <select name="role">
                      <option value="finance" selected>Finance</option>
                      <option value="admin">Admin</option>
                      <option value="support">Support</option>
                    </select>
                    @error('role')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="flex-1">
                    <button type="submit" class="bg-blue-500 px-2 py-1 text-white">Tambah</button>
                  </div>
              </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
