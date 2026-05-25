<div x-data="{
    activeModal: '{{ session('errors') ? (old('name') ? 'register' : 'login') : '' }}',
    close() {
        this.activeModal = null;
        document.body.style.overflow = 'auto';
    },
    open(type) {
        this.activeModal = type;
        document.body.style.overflow = 'hidden';
    }
}" @login-modal.window="open('login')" @register-modal.window="open('register')"
    @close-auth-modal.window="close()" @keydown.escape.window="close()" x-show="activeModal"
    class="fixed inset-0 z-[10000] overflow-y-auto" x-cloak>

    <div x-show="activeModal" x-transition.opacity.duration.300ms @click="close()"
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm">
    </div>

    <div class="flex min-h-full items-center justify-center p-4">

        <div x-show="activeModal === 'login'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-8" @click.stop>

            <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Sign in to your account</h2>
                <p class="text-sm text-gray-600 mt-2">
                    Or <button @click="activeModal = 'register'"
                        class="font-medium text-indigo-600 hover:text-indigo-500">create a new account</button>
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="login-email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="login-email" name="email" type="email" required value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="login-password" name="password" type="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-900">
                        <input name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Forgot
                        password?</a>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    Sign in
                </button>
            </form>


            @include('partials.social-auth-buttons', ['showDemo' => false])

        </div>

        <div x-show="activeModal === 'register'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-8" @click.stop>

            <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Create your account</h2>
                <p class="text-sm text-gray-600 mt-2">
                    Or <button @click="activeModal = 'login'"
                        class="font-medium text-indigo-600 hover:text-indigo-500">sign in to existing account</button>
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="modal-register-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="modal-register-name" name="name" type="text" autocomplete="name" required
                        value="{{ old('name') }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="modal-register-email" class="block text-sm font-medium text-gray-700">Email
                        address</label>
                    <input id="modal-register-email" name="email" type="email" autocomplete="email" required
                        value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="modal-register-phone_number"
                        class="block text-sm font-medium text-gray-700">phone_number </label>
                    <input id="modal-register-phone_number" name="phone_number" type="phone_number"
                        autocomplete="phone_number" required value="{{ old('phone_number') }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('phone_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="modal-register-password"
                        class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="modal-register-password" name="password" type="password" autocomplete="new-password"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="modal-register-password_confirmation"
                        class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="modal-register-password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    Create Account
                </button>
            </form>

            @include('partials.social-auth-buttons', ['showDemo' => false])

            <p class="text-xs text-center text-gray-500 mt-4">
                By creating an account, you agree to our Terms of Service and Privacy Policy
            </p>
        </div>
    </div>
</div>
