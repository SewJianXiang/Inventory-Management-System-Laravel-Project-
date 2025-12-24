<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
      display: none;
    }
  </style>
</head>
<body>
  <div class="min-h-screen bg-gray-100">
    <!-- Auth Pages -->
    <div class="min-h-screen flex">

    <!-- Left Side - Image -->
      <div
        class="hidden lg:block lg:w-3/5 bg-cover bg-center"
        style="background-image: url('https://images.pexels.com/photos/4277794/pexels-photo-4277794.jpeg')"
      >
        <div class="h-full bg-black bg-opacity-50 flex items-center justify-center">
          <div class="text-center text-white px-12">
            <h2 class="text-4xl font-bold mb-6">Stock Management</h2>
            <p class="text-xl">Manage your inventory efficiently and effectively.</p>
          </div>
        </div>
      </div>

      <!-- Right Side - Auth Forms -->
      <div class="w-full bg-white lg:w-2/5 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
          <!-- Form Container -->
            <div class="text-center mb-4">
              <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
                <i class="fas fa-user-plus text-red-600 fa-xl"></i>
              </div>
              <h2 class="text-3xl font-bold text-gray-800">
                Create Account
              </h2>
              <p class="text-gray-600 mt-2">
                Get started with your account
              </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <!-- Name Field -->
              <div class="mb-6">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                  <div class="relative">
                      <input
                          type="text"
                          name="name"
                          id="name"
                          value="{{ old('name') }}"
                          required
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-600 focus:border-transparent transition-colors @error('name') border-red-600 @enderror"
                          placeholder="John Doe"
                      />
                  </div>
                  @error('name')
                      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Email Field -->
              <div class="mb-6">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                  <div class="relative">
                      <input
                          type="email"
                          name="email"
                          id="email"
                          value="{{ old('email') }}"
                          required
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-600 focus:border-transparent transition-colors @error('email') border-red-600 @enderror"
                          placeholder="you@example.com"
                      />
                      <i class="fas fa-envelope absolute right-2 top-4 w-6 h-6 text-gray-400"></i>
                  </div>
                  @error('email')
                      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Password Field -->
              <div class="mb-6">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                  <div class="relative">
                      <input
                          type="password"
                          name="password"
                          id="password"
                          required
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-600 focus:border-transparent transition-colors @error('password') border-red-600 @enderror"
                          placeholder="••••••••"
                      />
                      <button
                          type="button"
                          class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
                          onclick="togglePassword()"
                      >
                          <i id="password-icon" class="fas fa-eye w-6 h-6"></i>
                      </button>
                  </div>
                  @error('password')
                      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Confirm Password Field -->
              <div class="mb-6">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                  <div class="relative">
                      <input
                          type="password"
                          name="password_confirmation"
                          id="password_confirmation"
                          required
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-600 focus:border-transparent transition-colors @error('password_confirmation') border-red-600 @enderror"
                          placeholder="••••••••"
                      />
                      <button
                          type="button"
                          class="absolute right-3 top-3 text-gray-400 hover:text-gray-600"
                          onclick="toggleConfirmPassword()"
                      >
                          <i id="confirm-password-icon" class="fas fa-eye w-6 h-6"></i>
                      </button>
                  </div>
                  @error('password_confirmation')
                      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 focus:ring-4 focus:ring-red-600 focus:ring-opacity-50 transition-colors"
              >
                Create Account
              </button>

              <!-- Form Switch -->
              <p class="mt-6 text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="ml-1 text-red-600 hover:text-red-700 font-semibold focus:outline-none">
                  Sign in
                </a>
              </p>
            </form>
        </div>
      </div>

    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const icon = document.getElementById('password-icon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.className = 'fas fa-eye-slash w-6 h-6';
      } else {
        passwordInput.type = 'password';
        icon.className = 'fas fa-eye w-6 h-6';
      }
    }

    function toggleConfirmPassword() {
      const confirmPasswordInput = document.getElementById('password_confirmation');
      const icon = document.getElementById('confirm-password-icon');
      if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        icon.className = 'fas fa-eye-slash w-6 h-6';
      } else {
        confirmPasswordInput.type = 'password';
        icon.className = 'fas fa-eye w-6 h-6';
      }
    }
  </script>
</body>
</html>
