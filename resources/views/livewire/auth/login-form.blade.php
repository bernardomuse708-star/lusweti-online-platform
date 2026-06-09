<form wire:submit="login" class="space-y-4">
    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Barua Pepe</label>
        <input type="email" wire:model="email" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none" required>
        @error('email') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Neno la Siri</label>
        <input type="password" wire:model="password" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none" required>
        @error('password') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
    </div>

    <div class="flex items-center justify-between mt-2">
        <label class="flex items-center">
            <input type="checkbox" wire:model="remember" class="form-checkbox border-2 border-black text-[#B80000] focus:ring-yellow-400 rounded-none h-4 w-4">
            <span class="ml-2 text-xs font-bold text-gray-700">Nikumbuke</span>
        </label>
        <button type="button" @click="$dispatch('open-auth-modal', { tab: 'forgot' })" class="text-xs font-bold text-[#B80000] hover:text-black hover:underline uppercase">Umesahau?</button>
    </div>

    <button type="submit" class="w-full bg-[#B80000] hover:bg-black text-white font-bold py-3 text-sm uppercase tracking-widest transition-colors rounded-none mt-4">
        Ingia
    </button>

    {{-- Google Socialite Hook --}}
    <div class="mt-6 pt-6 border-t-2 border-black">
        <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center gap-3 border-2 border-black bg-white hover:bg-gray-100 text-black font-bold py-2.5 px-4 text-xs uppercase tracking-wider transition-colors focus:outline-none focus:ring-4 focus:ring-yellow-400 rounded-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Endelea na Google
        </a>
    </div>
</form>