<div>
    <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900 mb-2">Rejesha Neno la Siri</h3>
    <p class="text-xs text-gray-600 mb-4 leading-relaxed">Weka barua pepe uliyosajili, tutakutumia kiungo kwa ajili ya kutengeneza neno jipya la siri.</p>

    @if($statusMessage)
        <div class="bg-green-50 border-l-4 border-green-600 p-3 text-xs font-bold text-green-800 mb-4 rounded-none">
            {{ $statusMessage }}
        </div>
    @endif

    <form wire:submit="sendResetLink" class="space-y-4">
        <div>
            <input 
                type="email" 
                wire:model="email" 
                placeholder="Weka barua pepe yako..."
                class="w-full border-2 border-black p-2.5 text-sm focus:ring-4 focus:ring-yellow-400 focus:outline-none rounded-none shadow-none" 
                required
            >
            @error('email') <span class="block text-xs font-bold text-[#B80000] mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between gap-4">
            <button 
                type="button" 
                wire:click="$parent.switchTab('login')" 
                class="text-xs font-bold uppercase tracking-wider text-black hover:underline"
            >
                Rudi Nyuma
            </button>
            
            <button 
                type="submit" 
                class="bg-black hover:bg-gray-800 text-white font-bold px-4 py-2.5 text-xs uppercase tracking-wider rounded-none"
            >
                Tuma Kiungo
            </button>
        </div>
    </form>
</div>