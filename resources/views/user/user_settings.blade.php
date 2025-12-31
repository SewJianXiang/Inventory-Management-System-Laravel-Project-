@extends('layouts.userlayout')

@section('title', 'StockSys Malaysia')
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Change Password</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('settings.password.update') }}">
        @csrf

        <div class="mb-4">
            <label for="current_password" class="block mb-1">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="w-full border rounded p-2">
            @error('current_password') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="new_password" class="block mb-1">New Password</label>
            <input type="password" name="new_password" id="new_password" class="w-full border rounded p-2">
            @error('new_password') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="new_password_confirmation" class="block mb-1">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Password</button>
    </form>
</div>
@endsection