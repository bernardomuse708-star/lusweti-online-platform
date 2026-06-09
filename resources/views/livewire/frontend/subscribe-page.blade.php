<x-slot name="title">
    Subscribe - Lusweti Online Center
</x-slot>

<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-red-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Subscribe to Lusweti Online Center</h1>
                <p class="text-red-100 mt-1">Get the latest news and updates delivered to your inbox</p>
            </div>

            <div class="px-6 py-8">
                @if ($subscribed)
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                            <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Thank You for Subscribing!</h2>
                        <p class="text-gray-600 mb-6">You have been successfully added to our mailing list.</p>
                        <a href="/" wire:navigate class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Return to Home
                        </a>
                    </div>
                @else
                    <form wire:submit="subscribe">
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name (Optional)</label>
                                <input
                                    type="text"
                                    wire:model="name"
                                    id="name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                    placeholder="Your name"
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address *</label>
                                <input
                                    type="email"
                                    wire:model="email"
                                    id="email"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                    placeholder="you@example.com"
                                    required
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                            >
                                Subscribe Now
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-xs text-gray-500">
                            By subscribing, you agree to receive our newsletter. You can unsubscribe at any time.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@script
<script>
    @listen('subscription-success')
    function () {
        // Optional: Add any JavaScript handling for subscription success
    }
</script>
@endscript
