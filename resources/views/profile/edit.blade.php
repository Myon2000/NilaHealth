@extends('frontend.layouts.app')

@section('extraCSS')
<style>
  /* Custom fade-in animation (inherited from homepage) */
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .fade-in {
    opacity: 0;
    animation: fadeIn 1s ease-in-out forwards;
  }
  .fade-delay-1 { animation-delay: 0.3s; }
  .fade-delay-2 { animation-delay: 0.6s; }
  .fade-delay-3 { animation-delay: 0.9s; }
</style>
@endsection

@section('content')
<!-- Profile Hero Section -->
<section class="relative pt-16 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 text-white fade-in fade-delay-1">
  <div class="relative max-w-screen-md mx-auto px-4 py-24 text-center">
    <h1 class="text-4xl sm:text-5xl font-bold mb-4">Update Profile</h1>
    <p class="mb-8 max-w-xl mx-auto">Kelola informasi akun Anda di sini, seperti nama, email, dan password.</p>
    <div class="flex justify-center space-x-4">
      <a href="{{ route('home') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg transition transform hover:scale-105">
        Kembali ke Home
      </a>
      <form method="POST" action="{{ route('logout') }}" class="inline-block">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg transition transform hover:scale-105">
          Logout
        </button>
      </form>
    </div>
  </div>
</section>

<!-- Profile Form Section -->
<section class="py-16 bg-white fade-in fade-delay-2">
  <div class="max-w-screen-md mx-auto px-4 space-y-8">
    @if (session('status') === 'profile-updated')
      <div class="p-4 bg-green-100 text-green-800 rounded-lg">
        {{ __('Profile berhasil diperbarui.') }}
      </div>
    @endif

    <!-- Update Profile Information -->
    <div class="bg-gray-50 p-6 rounded-2xl shadow-lg">
      <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
          <label for="name" class="block text-gray-700 font-medium mb-1">{{ __('Name') }}</label>
          <input id="name" name="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name', $user->name) }}" required autofocus />
          @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-gray-700 font-medium mb-1">{{ __('Email') }}</label>
          <input id="email" name="email" type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email', $user->email) }}" required />
          @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition transform hover:scale-105">
            {{ __('Simpan Perubahan') }}
          </button>
        </div>
      </form>
    </div>

    <!-- Update Password -->
    <div class="bg-gray-50 p-6 rounded-2xl shadow-lg">
      <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
          <label for="current_password" class="block text-gray-700 font-medium mb-1">{{ __('Current Password') }}</label>
          <input id="current_password" name="current_password" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          @error('current_password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- New Password -->
        <div>
          <label for="password" class="block text-gray-700 font-medium mb-1">{{ __('New Password') }}</label>
          <input id="password" name="password" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">{{ __('Confirm Password') }}</label>
          <input id="password_confirmation" name="password_confirmation" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition transform hover:scale-105">
            {{ __('Ganti Password') }}
          </button>
        </div>
      </form>
    </div>

    <!-- Delete Account -->
    <div class="bg-gray-50 p-6 rounded-2xl shadow-lg">
      <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
        @csrf
        @method('delete')

        <h2 class="text-xl font-semibold text-red-600">{{ __('Hapus Akun') }}</h2>
        <p class="text-sm text-gray-600">{{ __('Sekali dihapus, semua data akun Anda akan hilang.') }}</p>

        <div class="flex justify-end">
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg transition transform hover:scale-105">
            {{ __('Hapus Akun') }}
          </button>
        </div>
      </form>
    </div>

  </div>
</section>
@endsection