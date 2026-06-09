<form wire:submit="register" class="space-y-3">
    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Jina Kamili</label>
        <input type="text" wire:model="name" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none shadow-none" required>
        @error('name') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Barua Pepe</label>
        <input type="email" wire:model="email" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none shadow-none" required>
        @error('email') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Namba ya Simu</label>
        <input type="tel" wire:model="phone_number" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none shadow-none" required>
        @error('phone_number') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Neno la Siri</label>
        <input type="password" wire:model="password" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none shadow-none" required>
        @error('password') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-900 mb-1">Thibitisha Neno la Siri</label>
        <input type="password" wire:model="password_confirmation" class="w-full border-2 border-black p-2 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none shadow-none" required>
    </div>

    <button type="submit" class="w-full bg-[#B80000] hover:bg-black text-white font-bold py-3 text-sm uppercase tracking-widest transition-colors rounded-none mt-2">
        Jiunge Sasa
    </button>
</form>