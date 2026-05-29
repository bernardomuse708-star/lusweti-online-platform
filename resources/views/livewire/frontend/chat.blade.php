<div class="flex flex-col h-full bg-slate-900">
    <!-- Messages -->
    <div id="chatMessages"
        x-data
        x-on:chat-message-added.window="
        $nextTick(() => {
            const el = document.getElementById('chatMessages');

            if (el) {
                el.scrollTop = el.scrollHeight;
            }
        });
    " class="flex-1 overflow-y-auto space-y-2 p-4">     
        @forelse($messages as $msg)
            <div class="bg-slate-800/80 p-2.5 rounded-lg border border-slate-700/50">
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-semibold text-blue-50">{{ $msg['user'] }}</span>
                    <span class="text-[10px] text-slate-50">{{ $msg['time'] ?? '' }}</span>
                </div>
                <p class="text-sm text-slate-50">{{ $msg['text'] }}</p>
            </div>
        @empty
            <div class="text-center text-slate-500 text-sm py-8">
                No messages yet. Be the first to chat!
            </div>
        @endforelse
    </div>

    <!-- Input -->
    <div class="p-3 border-t border-slate-50 bg-slate-800/50">
        <div class="flex gap-2">
            <input
                type="text"
                wire:model="message"
                wire:keydown.enter="sendMessage"
                class="flex-1 px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Type a message..."
            >
            <button
                wire:click="sendMessage"
                class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium transition-colors">
                Send
            </button>
        </div>
    </div>
</div>