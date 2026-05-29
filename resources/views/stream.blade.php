<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @fonts

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <div
        x-data="livekitRoom({ token: @js($token), url: @js($livekitUrl), isHost: @js($isHost) })"
        x-cloak
        class="relative min-h-screen bg-slate-950 text-slate-100 font-sans antialiased selection:bg-red-500 selection:text-white">

        <!-- Premium Minimalist Status Header -->
        <header class="max-w- mx-auto px-4 sm:px-6 py-4 flex justify-between items-center border-b border-white/10">
            <div class="flex items-center gap-2.5 sm:gap-4">
                <h1 class="text-base sm:text-xl font-bold text-white tracking-tighter italic select-none">
                    ANDABWA<span class="text-red-500 drop-shadow-[0_0_10px_rgba(239,68,68,0.3)]">LIVE</span>
                </h1>
                <div class="h-4 w-[1px] bg-white/10"></div>
                <div class="flex items-center gap-1.5 px-2 py-0.5 sm:px-2.5 sm:py-1 bg-white/[0.02] border border-white/[0.05] rounded-full">
                    <div :class="{
                    'bg-emerald-500 drop-shadow-[0_0_6px_rgba(16,185,129,0.5)]': connectionState === 'connected',
                    'bg-amber-500 animate-pulse': connectionState === 'connecting',
                    'bg-red-500 drop-shadow-[0_0_6px_rgba(239,68,68,0.5)]': connectionState === 'disconnected'
                }" class="w-1.5 h-1.5 rounded-full transition-all duration-300"></div>
                    <span class="text-[8px] sm:text-[9px] font-bold uppercase tracking-widest text-slate-400" x-text="connectionState"></span>
                </div>
            </div>

            <button @click="window.location.reload()" class="text-[9px] sm:text-[10px] font-black tracking-wider text-slate-400 hover:text-slate-200 transition-colors duration-200 uppercase bg-white/[0.02] hover:bg-white/[0.06] border border-white/[0.05] px-2.5 py-1.5 rounded-lg screen-xs:hidden">
                RE-SYNC
            </button>
        </header>

        <!-- Master Stage / Mobile Stack to Desktop Grid Layout -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 lg:gap-8 pt-4 pb-32 sm:pb-36">

            <!-- PRIMARY BROADCAST STAGE -->
            <div class="lg:col-span-8 flex flex-col gap-3">
                <div class="group relative aspect-video bg-slate-900 rounded-xl sm:rounded-[2rem] overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.7)] ring-1 ring-white/[0.08] transition-all duration-300">

                    <!-- Video Containers (Maintained Script-Matched IDs) -->
                    <div id="localVideo" x-show="isHost" class="w-full h-full bg-slate-950"></div>

                    <div id="remoteVideos" x-show="!isHost" class="w-full h-full bg-slate-950 flex items-center justify-center">
                        <!-- Premium Native-Feeling Loading State -->
                        <div id="remote-placeholder" class="text-center z-10 p-4 sm:p-6 backdrop-blur-sm rounded-xl bg-slate-950/40 border border-white/[0.08] max-w-[85%]">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 border-2 border-red-500/10 border-t-red-500 rounded-full animate-spin mx-auto mb-3"></div>
                            <p class="text-slate-400 text-[11px] sm:text-xs font-semibold tracking-wide">Awaiting incoming broadcast signal...</p>
                        </div>
                    </div>

                    <!-- HUD Context Overlay -->
                    <div class="absolute top-2.5 left-2.5 sm:top-5 sm:left-5 z-20 pointer-events-none select-none">
                        <div class="px-2.5 py-1 sm:px-3 sm:py-1.5 bg-slate-950/70 backdrop-blur-md border border-white/[0.08] rounded-full flex items-center gap-1.5 sm:gap-2 shadow-lg">
                            <div class="w-1.5 h-1.5 rounded-full" :class="isLive ? 'bg-red-500 animate-pulse drop-shadow-[0_0_6px_rgba(239,68,68,0.8)]' : 'bg-slate-500'"></div>
                            <span class="text-[8px] sm:text-[9px] font-black uppercase tracking-widest text-slate-200" x-text="isLive ? 'Live Feed' : 'Standby Mode'"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LIVE STREAM SIDEBAR (Integrated Chat Container) -->
            <div class="lg:col-span-4 flex flex-col h-[380px] lg:h-auto lg:flex-1">
                <div class="flex-1 bg-slate-900/30 rounded-xl sm:rounded-[2rem] border border-white/[0.05] overflow-hidden flex flex-col backdrop-blur-md shadow-xl">

                    <!-- Chat View Header Component -->
                    <div class="px-4 py-3 sm:px-5 sm:py-4 border-b border-white/[0.05] bg-white/[0.01] flex justify-between items-center shrink-0">
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] sm:text-[10px] font-black text-slate-400 uppercase tracking-widest">Interactive Chat</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                        <span class="px-1.5 py-0.5 bg-white/[0.04] border border-white/[0.08] rounded text-[8px] sm:text-[9px] font-mono text-slate-500">v2.0.4</span>
                    </div>

                    <!-- Livewire Component Dynamic Feed -->
                    <div class="flex-1 overflow-y-auto custom-scrollbar p-2" wire:ignore>
                        {{-- @livewire('chat', ['room' => $stream->uuid]) --}}
                    </div>
                </div>
            </div>
        </main>

        <!-- MOBILE-OPTIMIZED HOST CONSOLE CONTROL DECK -->
        <template x-if="isHost">
            <div class="fixed bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 w-full max-w-md px-3 sm:px-4 z-50">
                <div class="bg-slate-900/90 backdrop-blur-xl border border-white/[0.1] p-2 rounded-xl sm:rounded-[2rem] shadow-[0_24px_50px_-12px_rgba(0,0,0,0.9)] flex flex-col gap-2 sm:gap-3">

                    <!-- Status Row -->
                    <div class="flex items-center justify-between px-2 pt-1 pb-1.5 border-b border-white/[0.05]">
                        <span class="text-[8px] font-black uppercase text-slate-500 tracking-wider">Host Console</span>
                        <div class="flex items-center gap-1.5">
                            <div class="w-1 h-1 rounded-full" :class="isLive ? 'bg-red-500 animate-ping' : 'bg-slate-500'"></div>
                            <p class="text-[10px] font-bold text-slate-300 tracking-wide" x-text="isLive ? 'System Live' : 'Ready to Initialize'"></p>
                        </div>
                    </div>

                    <!-- Actions Deck Layout -->
                    <div class="flex items-center gap-2 w-full">
                        <!-- Stream Action Handler -->
                        <button
                            @click="isLive ? stopPublishing() : startPublishing()"
                            :disabled="isConnecting"
                            class="flex-1 px-3 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold text-[10px] sm:text-xs uppercase tracking-wider transition-all duration-300 select-none disabled:opacity-50 disabled:cursor-not-allowed active:scale-95 min-h-[40px] flex items-center justify-center"
                            :class="isLive ? 'bg-white text-slate-950 hover:bg-slate-200 shadow-lg' : 'bg-red-600 text-white hover:bg-red-500 shadow-[0_4px_12px_rgba(220,38,38,0.2)]'">

                            <span x-show="!isLive && !isConnecting">Go Live</span>
                            <span x-show="isConnecting" class="flex items-center gap-1.5">
                                <svg class="animate-spin h-3.5 w-3.5" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Connecting...
                            </span>
                            <span x-show="isLive && !isConnecting">Stop Stream</span>
                        </button>

                        <!-- Native Internal Recorder Trigger -->
                        <button
                            @click="toggleRecording()"
                            :disabled="!isLive"
                            class="px-3 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold text-[10px] sm:text-xs uppercase tracking-wider transition-all duration-300 select-none disabled:opacity-30 disabled:cursor-not-allowed active:scale-95 min-h-[40px] flex items-center justify-center gap-1.5 border shrink-0"
                            :class="isRecording ? 'bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/30' : 'bg-slate-800/60 text-slate-300 border-white/[0.05] hover:bg-slate-800'">

                            <div class="w-1.5 h-1.5 rounded-full" :class="isRecording ? 'bg-red-500 animate-pulse' : 'bg-slate-500'"></div>
                            <span x-text="isRecording ? 'Rec On' : 'Record'"></span>
                        </button>
                    </div>

                </div>
            </div>
        </template>
    </div>



    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.data('livekitRoom', (config) => ({

                /*
                |--------------------------------------------------------------------------
                | CORE
                |--------------------------------------------------------------------------
                */

                room: null,
                sdk: null,

                token: config.token,
                url: config.url,
                isHost: Boolean(config.isHost),

                /*
                |--------------------------------------------------------------------------
                | UI STATE
                |--------------------------------------------------------------------------
                */

                connectionState: 'disconnected',

                isConnecting: false,
                isLive: false,
                isRecording: false,

                reconnecting: false,

                /*
                |--------------------------------------------------------------------------
                | TRACKS
                |--------------------------------------------------------------------------
                */

                videoTrack: null,
                audioTrack: null,

                /*
                |--------------------------------------------------------------------------
                | RECORDING
                |--------------------------------------------------------------------------
                */

                mediaRecorder: null,
                recordedChunks: [],

                /*
                |--------------------------------------------------------------------------
                | INIT
                |--------------------------------------------------------------------------
                */

                async init() {

                    try {

                        this.sdk = await import(
                            'https://cdn.jsdelivr.net/npm/livekit-client/dist/livekit-client.esm.mjs'
                        );

                        const {
                            Room,
                            RoomEvent,
                            ConnectionState,
                            VideoPresets
                        } = this.sdk;

                        this.ConnectionState = ConnectionState;

                        this.room = new Room({

                            adaptiveStream: true,

                            dynacast: true,

                            stopLocalTrackOnUnpublish: false,

                            publishDefaults: {

                                videoSimulcast: true,

                                videoCodec: 'vp8',

                                videoEncoding: VideoPresets.h720.encoding,
                            }
                        });

                        /*
                        |--------------------------------------------------------------------------
                        | ROOM EVENTS
                        |--------------------------------------------------------------------------
                        */

                        this.room.on(
                            RoomEvent.ConnectionStateChanged,
                            async (state) => {

                                this.connectionState = state;

                                console.log(
                                    'Connection:',
                                    state
                                );

                                /*
                                |--------------------------------------------------------------------------
                                | AUTO RECOVERY
                                |--------------------------------------------------------------------------
                                */

                                if (
                                    state ===
                                    ConnectionState.Connected
                                ) {

                                    if (
                                        this.reconnecting &&
                                        this.isHost &&
                                        this.videoTrack
                                    ) {

                                        await this.republishTracks();
                                    }

                                    this.reconnecting = false;
                                }

                                if (
                                    state ===
                                    ConnectionState.Reconnecting
                                ) {

                                    this.reconnecting = true;
                                }

                                if (
                                    state ===
                                    ConnectionState.Disconnected
                                ) {

                                    this.isConnecting = false;
                                }
                            }
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | REMOTE TRACKS
                        |--------------------------------------------------------------------------
                        */

                        this.room.on(
                            RoomEvent.TrackSubscribed,
                            (track) => {

                                this.attachRemoteTrack(track);
                            }
                        );

                        this.room.on(
                            RoomEvent.TrackUnsubscribed,
                            (track) => {

                                track.detach()
                                    .forEach(el => el.remove());

                                this.checkRemoteState();
                            }
                        );

                        this.room.on(
                            RoomEvent.ParticipantDisconnected,
                            () => {

                                this.checkRemoteState();
                            }
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | CONNECT
                        |--------------------------------------------------------------------------
                        */

                        await this.room.connect(
                            this.url,
                            this.token
                        );

                        console.log(
                            '✅ Connected'
                        );

                    } catch (error) {

                        console.error(
                            'INIT FAILED:',
                            error
                        );
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | START STREAM
                |--------------------------------------------------------------------------
                */

                async startPublishing() {

                    if (
                        this.isConnecting ||
                        this.isLive
                    ) {
                        return;
                    }

                    this.isConnecting = true;

                    try {

                        const {
                            createLocalVideoTrack,
                            createLocalAudioTrack
                        } = this.sdk;

                        /*
                        |--------------------------------------------------------------------------
                        | CLEANUP OLD
                        |--------------------------------------------------------------------------
                        */

                        await this.stopPublishing(true);

                        /*
                        |--------------------------------------------------------------------------
                        | CREATE TRACKS
                        |--------------------------------------------------------------------------
                        */

                        this.videoTrack =
                            await createLocalVideoTrack({

                                resolution: {
                                    width: 1280,
                                    height: 720,
                                    frameRate: 30
                                }
                            });

                        this.audioTrack =
                            await createLocalAudioTrack();

                        /*
                        |--------------------------------------------------------------------------
                        | LOCAL PREVIEW
                        |--------------------------------------------------------------------------
                        */

                        this.attachLocalPreview();

                        /*
                        |--------------------------------------------------------------------------
                        | ENSURE CONNECTED
                        |--------------------------------------------------------------------------
                        */

                        if (
                            this.room.state !==
                            this.ConnectionState.Connected
                        ) {

                            await this.room.connect(
                                this.url,
                                this.token
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | PUBLISH
                        |--------------------------------------------------------------------------
                        */

                        await this.room
                            .localParticipant
                            .publishTrack(
                                this.videoTrack
                            );

                        await this.room
                            .localParticipant
                            .publishTrack(
                                this.audioTrack
                            );

                        this.isLive = true;

                        console.log(
                            '✅ LIVE'
                        );

                    } catch (error) {

                        console.error(
                            'START FAILED:',
                            error
                        );

                        await this.stopPublishing(true);

                    } finally {

                        this.isConnecting = false;
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | STOP STREAM
                |--------------------------------------------------------------------------
                */

                async stopPublishing(silent = false) {

                    try {

                        if (
                            this.videoTrack
                        ) {

                            try {

                                await this.room
                                    .localParticipant
                                    .unpublishTrack(
                                        this.videoTrack
                                    );

                            } catch (e) {}

                            this.videoTrack.stop();

                            this.videoTrack.detach()
                                .forEach(el => el.remove());

                            this.videoTrack = null;
                        }

                        if (
                            this.audioTrack
                        ) {

                            try {

                                await this.room
                                    .localParticipant
                                    .unpublishTrack(
                                        this.audioTrack
                                    );

                            } catch (e) {}

                            this.audioTrack.stop();

                            this.audioTrack = null;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | RECORDING
                        |--------------------------------------------------------------------------
                        */

                        if (
                            this.mediaRecorder &&
                            this.mediaRecorder.state !==
                            'inactive'
                        ) {

                            this.mediaRecorder.stop();
                        }

                        this.isRecording = false;

                        this.clearLocalVideo();

                        this.isLive = false;

                        if (!silent) {

                            console.log(
                                '✅ STREAM STOPPED'
                            );
                        }

                    } catch (error) {

                        console.error(
                            'STOP FAILED:',
                            error
                        );
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | REPUBLISH AFTER RECONNECT
                |--------------------------------------------------------------------------
                */

                async republishTracks() {

                    try {

                        if (this.videoTrack) {

                            await this.room
                                .localParticipant
                                .publishTrack(
                                    this.videoTrack
                                );
                        }

                        if (this.audioTrack) {

                            await this.room
                                .localParticipant
                                .publishTrack(
                                    this.audioTrack
                                );
                        }

                        this.isLive = true;

                        console.log(
                            '✅ TRACKS REPUBLISHED'
                        );

                    } catch (e) {

                        console.error(
                            'REPUBLISH FAILED',
                            e
                        );
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | LOCAL PREVIEW
                |--------------------------------------------------------------------------
                */

                attachLocalPreview() {

                    const container =
                        document.getElementById(
                            'localVideo'
                        );

                    if (!container || !this.videoTrack) {
                        return;
                    }

                    container.innerHTML = '';

                    const el =
                        this.videoTrack.attach();

                    el.className =
                        'w-full h-full object-cover';

                    el.autoplay = true;

                    el.playsInline = true;

                    el.muted = true;

                    container.appendChild(el);
                },

                clearLocalVideo() {

                    const container =
                        document.getElementById(
                            'localVideo'
                        );

                    if (container) {
                        container.innerHTML = '';
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | REMOTE TRACKS
                |--------------------------------------------------------------------------
                */

                attachRemoteTrack(track) {

                    if (
                        track.kind !== 'video'
                    ) {
                        return;
                    }

                    const container =
                        document.getElementById(
                            'remoteVideos'
                        );

                    if (!container) {
                        return;
                    }

                    container.innerHTML = '';

                    const el =
                        track.attach();

                    el.className =
                        'w-full h-full object-cover';

                    el.autoplay = true;

                    el.playsInline = true;

                    container.appendChild(el);

                    this.isLive = true;
                },

                checkRemoteState() {

                    if (this.isHost) {
                        return;
                    }

                    let hasVideo = false;

                    this.room.participants.forEach(
                        participant => {

                            participant.trackPublications
                                .forEach(pub => {

                                    if (
                                        pub.kind === 'video'
                                    ) {

                                        hasVideo = true;
                                    }
                                });
                        }
                    );

                    this.isLive = hasVideo;

                    if (!hasVideo) {

                        const container =
                            document.getElementById(
                                'remoteVideos'
                            );

                        if (container) {

                            container.innerHTML = `
                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                            Waiting for live stream...
                        </div>
                    `;
                        }
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | RECORDING
                |--------------------------------------------------------------------------
                */

                async toggleRecording() {

                    if (
                        !this.videoTrack ||
                        !this.audioTrack
                    ) {

                        alert(
                            'Start stream first.'
                        );

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | START RECORDING
                    |--------------------------------------------------------------------------
                    */

                    if (!this.isRecording) {

                        try {

                            this.recordedChunks = [];

                            const stream =
                                new MediaStream();

                            stream.addTrack(
                                this.videoTrack.mediaStreamTrack
                            );

                            stream.addTrack(
                                this.audioTrack.mediaStreamTrack
                            );

                            this.mediaRecorder =
                                new MediaRecorder(
                                    stream, {
                                        mimeType: 'video/webm'
                                    }
                                );

                            this.mediaRecorder
                                .ondataavailable =
                                (event) => {

                                    if (
                                        event.data.size > 0
                                    ) {

                                        this.recordedChunks.push(
                                            event.data
                                        );
                                    }
                                };

                            this.mediaRecorder.onstop =
                                () => {

                                    const blob =
                                        new Blob(
                                            this.recordedChunks, {
                                                type: 'video/webm'
                                            }
                                        );

                                    const url =
                                        URL.createObjectURL(
                                            blob
                                        );

                                    const a =
                                        document.createElement(
                                            'a'
                                        );

                                    a.href = url;

                                    a.download =
                                        `recording-${Date.now()}.webm`;

                                    document.body.appendChild(
                                        a
                                    );

                                    a.click();

                                    a.remove();

                                    URL.revokeObjectURL(
                                        url
                                    );
                                };

                            this.mediaRecorder.start(
                                1000
                            );

                            this.isRecording = true;

                            console.log(
                                '✅ RECORDING'
                            );

                        } catch (error) {

                            console.error(
                                'RECORD FAILED:',
                                error
                            );
                        }

                    } else {

                        /*
                        |--------------------------------------------------------------------------
                        | STOP RECORDING
                        |--------------------------------------------------------------------------
                        */

                        if (
                            this.mediaRecorder &&
                            this.mediaRecorder.state !==
                            'inactive'
                        ) {

                            this.mediaRecorder.stop();
                        }

                        this.isRecording = false;

                        console.log(
                            '✅ RECORD STOPPED'
                        );
                    }
                }

            }));
        });
    </script>

</body>

</html>