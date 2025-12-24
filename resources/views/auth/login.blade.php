<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
        style="background-image: url('https://images.pexels.com/photos/29454378/pexels-photo-29454378.jpeg')"
      >
        <div class="h-full bg-gray-900 bg-opacity-[.65] flex items-center justify-center">
          <div class="text-center text-white px-12">
            <h2 class="text-4xl font-bold mb-6">Stock Management</h2>
            <p class="text-xl">Manage your inventory efficiently and effectively.</p>
          </div>
        </div>
      </div>

      <!-- Right Side - Auth Forms -->
      <div class="w-full lg:w-2/5 flex justify-center bg-white p-8 ">
          <div class="w-full max-w-md mt-[15%]">
              <!-- Form Container -->
              <!-- Logo -->
              <div class="text-center mb-8">
                  <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
                      <i class="fas fa-sign-in-alt text-red-600 fa-2xl"></i>
                  </div>
                  <h2 class="text-3xl font-bold text-gray-800">
                      Welcome Back!
                  </h2>
                  <p class="text-gray-600 mt-2">
                      Please sign in to continue
                  </p>
              </div>

              <!-- Form -->
              <form method="POST" action="{{ route('login') }}">
                  @csrf

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
                          <p class="mt-1 text-sm text-red-600"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Password Field -->
                  <div class="mb-4">
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
                          <p class="mt-1 text-sm text-red-600"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Submit Button -->
                  <button
                      type="submit"
                      class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 focus:ring-4 focus:ring-red-600 focus:ring-opacity-50 transition-colors"
                  >
                      Sign In
                  </button>

                  <!-- Form Switch -->
                  <p class="mt-6 text-center text-gray-600">
                      Don't have an account?
                      <a href="{{ route('register') }}" class="ml-1 text-red-600 hover:text-red-700 font-semibold focus:outline-none">
                          Sign up
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
  </script>
</body>
