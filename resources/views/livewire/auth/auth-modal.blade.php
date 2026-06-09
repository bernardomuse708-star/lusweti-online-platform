{{-- Root wrapper div prevents Livewire DOM-diffing drops --}}
<div>
    <div
        x-cloak
        x-data="{ open: $wire.entangle('isOpen').live }"
        x-show="open"
        x-transition.opacity.duration.200ms
        class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
    >
        {{-- Stark BBC Dimmer Overlay --}}
        <div 
            class="fixed inset-0 bg-black/75 transition-opacity" 
            @click="$wire.closeModal()"
        ></div>

        {{-- BBC Geometric Rigid Box Panel --}}
        <div 
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative w-full max-w-md bg-white border-4 border-black p-6 md:p-8 shadow-2xl z-10 rounded-none"
        >
            {{-- Close Action --}}
            <button 
                type="button"
                wire:click="closeModal"
                class="absolute right-4 top-4 text-gray-500 hover:text-black focus:outline-none focus:ring-4 focus:ring-yellow-400 p-1"
                aria-label="Funga"
            >
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- BBC Header Ribbon --}}
            <div class="mb-6">
                <div class="inline-block bg-[#B80000] text-white font-black px-2.5 py-0.5 tracking-tighter text-sm uppercase rounded-none mb-3">
                    Akaunti
                </div>
            </div>

            {{-- Component Tab Selector --}}
            @if($tab !== 'forgot')
                <div class="flex border-b-2 border-gray-200 mb-6 text-sm font-bold uppercase tracking-wider">
                    <button 
                        type="button"
                        wire:click="switchTab('login')"
                        class="flex-1 pb-3 text-center border-b-4 transition-all {{ $tab === 'login' ? 'border-black text-black' : 'border-transparent text-gray-500 hover:text-black' }}"
                    >
                        Ingia (Sign In)
                    </button>
                    <button 
                        type="button"
                        wire:click="switchTab('register')"
                        class="flex-1 pb-3 text-center border-b-4 transition-all {{ $tab === 'register' ? 'border-black text-black' : 'border-transparent text-gray-500 hover:text-black' }}"
                    >
                        Jiunge (Register)
                    </button>
                </div>
            @endif

            {{-- Encapsulated Inner Sub-components (wire:key isolates hydration footprints) --}}
            <div class="min-h-[250px]">
                @if($tab === 'login')
                    <livewire:auth.login-form wire:key="sub-login-form" />
                @elseif($tab === 'register')
                    <livewire:auth.register-form wire:key="sub-register-form" />
                @elseif($tab === 'forgot')
                    <livewire:auth.forgot-password-form wire:key="sub-forgot-form" />
                @endif
            </div>

        </div>
    </div>
</div>





{{-- Wrap in a root div to protect Alpine/Livewire DOM diffing 
<div>
    <div
    x-data="{ open: @entangle('isOpen').live }"
    x-show="open"
    x-transition.opacity
    x-cloak
    class="fixed inset-0 z-[9999] flex items-center justify-center"
    >
        
        {{-- Stark dark backdrop overlay 
        <div class="fixed inset-0 bg-black/75 transition-opacity" @click="$wire.closeModal()"></div>

        {{-- BBC Rigid Box Wrapper 
        <div class="relative w-full max-w-md bg-white border-4 border-black p-8 shadow-2xl z-10 mx-4 rounded-none" @click.stop>
            
            {{-- Close Modal button 
            <button type="button" 
                    @click="$wire.closeModal()"
                    class="absolute right-4 top-4 text-gray-400 hover:text-black transition-colors focus:outline-none focus:ring-4 focus:ring-yellow-400 bg-white"
                    aria-label="Funga">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- BBC Branding Header 
            <div class="mb-6">
                <div class="inline-block bg-black text-white font-black px-2 py-0.5 tracking-tighter text-lg uppercase mb-4 rounded-none">
                    Mwanzo
                </div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight leading-none mb-1">
                    @if($step === 'email')
                        Ingia kwa akaunti yako
                    @elseif($step === 'register')
                        Tengeneza akaunti mpya
                    @else
                        Weka neno lako la siri
                    @endif
                </h2>
                
                @if($step === 'password')
                    <p class="text-sm text-gray-600 mt-2 flex items-center gap-1 border-l-4 border-red-600 pl-2 bg-gray-50 py-1">
                        <span class="font-medium text-gray-900 truncate">{{ $data['email'] ?? '' }}</span>
                        <button type="button" wire:click="$set('step', 'email')" class="text-red-600 hover:underline hover:text-black text-xs font-bold ml-2 uppercase">Badili</button>
                    </p>
                @endif
            </div>

            {{-- Filament Form Engine 
            <form wire:submit="submit" class="space-y-5">
                {{ $this->form }}

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-[#B80000] hover:bg-black text-white font-bold py-3 px-4 text-base uppercase tracking-widest transition-colors duration-150 focus:outline-none focus:ring-4 focus:ring-yellow-400 rounded-none">
                        @if($step === 'email')
                            Endelea
                        @elseif($step === 'register')
                            Jiunge Sasa
                        @else
                            Ingia
                        @endif
                    </button>
                </div>
            </form>

            {{-- Context Actions & Socialite 
            <div class="mt-6 pt-6 border-t-2 border-black space-y-4">
                
                {{-- Socialite Google Button 
                @if($step === 'email' || $step === 'register')
                    <a href="{{ url('/auth/google') }}" 
                       class="w-full flex items-center justify-center gap-3 border-2 border-black bg-white hover:bg-gray-100 text-black font-bold py-3 px-4 text-sm uppercase tracking-wider transition-colors duration-150 focus:outline-none focus:ring-4 focus:ring-yellow-400 rounded-none">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Endelea na Google
                    </a>
                @endif

                {{-- Flow Switcher 
                <div class="text-sm font-medium text-gray-900 text-center">
                    @if($step === 'email')
                        <p>Huna akaunti? <button type="button" wire:click="$set('step', 'register')" class="text-[#B80000] font-bold hover:underline hover:text-black">Jiunge hapa</button></p>
                    @elseif($step === 'register')
                        <p>Una akaunti tayari? <button type="button" wire:click="$set('step', 'email')" class="text-[#B80000] font-bold hover:underline hover:text-black">Ingia hapa</button></p>
                    @else
                        <p><a href="/password/reset" class="text-[#B80000] font-bold hover:underline hover:text-black">Umesahau neno la siri?</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>--}}