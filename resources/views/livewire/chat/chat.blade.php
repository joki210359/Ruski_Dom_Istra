<div
    x-data="{
    height:0,
    conversationElement: document.getElementById('conversation'),
 }"

    x-init="
    height=conversationElement.scrollHeight;
    $nextTick(()=> conversationElement.scrollTop=height);

    Echo.private('users.{{auth()->user()->id}}')
    .notification((notification) => {

        if(
            notification['type']=='App\\Notifications\\MessageSentNotification' &&
            notification['conversation_id']=={{$conversation->id}}
        )
        {

            $wire.listenBroadcastedMessage(notification);
        }

    });
 "

    @scroll-bottom.window="
 $nextTick(()=> conversationElement.scrollTop= conversationElement.scrollHeight );

 "


    class=" w-full overflow-hidden  h-full ">

    <div class="  border-r   flex flex-col overflow-y-scroll grow  h-full">

        {{-----Header---}}

        <header class="w-full  sticky inset-x-0 flex pb-[5px] pt-[7px] top-0 z-10 bg-white border-b">

            <div class="  flex  w-full items-center   px-2   lg:px-4 gap-2 md:gap-5 ">
                {{-- Return --}}
                <a href="{{route('chat')}}" class=" shrink-0 lg:hidden  dark:text-white" id="chatReturn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>

                {{--Avatar --}}
                <div class="shrink-0">
                    <a href="{{ route('profile.home', auth()->user()->username) }}">
                        <x-avatar
                            wire:ignore
                            class="h-8 w-8 lg:w-10 lg:h-10"
                            src="{{ asset('storage/' . auth()->user()->avatar) }}" />
                    </a>
                </div>
                {{--User Name --}}
                <a href="{{ route('profile.home', auth()->user()->username) }}">
                    <h6 class="font-bold truncate">{{ auth()->user()->name }}</h6>
                </a>

                {{-- Actions --}}
                <div class="flex gap-4 items-center ml-auto">
                    {{-- Phone --}}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </span>

                    {{-- video --}}
                    <!-- <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span> -->

                    <div x-data="{ showVideoCall: false }">
                        <!-- Dugme za video -->
                        <span @click="showVideoCall = true" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </span>

                        <!-- Video prozor -->
                        <div x-show="showVideoCall" class="fixed inset-0 z-50 bg-black/60 flex items-center justify-center">
                            <div class="bg-white rounded-xl p-5 relative w-[90%] max-w-xl">
                                <button @click="showVideoCall = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>

                                <h2 class="text-lg font-semibold mb-4">Video razgovor</h2>

                                <!-- WebRTC ili drugi video sadržaj -->
                                <video id="localVideo" autoplay muted class="w-full rounded-md shadow mb-2"></video>
                                <video id="remoteVideo" autoplay class="w-full rounded-md shadow"></video>
                            </div>
                        </div>
                    </div>

                    {{-- Info --}}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>

                    </span>
                </div>

            </div>
        </header>

        {{---Messages---}}

        <main
            id="conversation"
            x-data="{ scrollTop: 0, height: 0 }"
            @scroll="
        scrollTop = $el.scrollTop;
        if (scrollTop <= 0) {
            $wire.dispatch('loadMore');
        }
    "
            @update-height.window="
        $nextTick(() => {
            const newHeight = $el.scrollHeight;
            $el.scrollTop = newHeight - height;
            height = newHeight;
        });
    "
            class="flex flex-col gap-5 p-2.5 overflow-y-auto overflow-x-hidden flex-grow w-full my-auto overscroll-contain">
            @foreach ($loadedMessages as $message)
            @php
            $belongsToAuth = $message->sender_id === auth()->id();
            $extension = $message->image ? pathinfo($message->image, PATHINFO_EXTENSION) : null;
            $ext = strtolower($extension);
            $isVideo = in_array($ext, ['mp4', 'mov', 'quicktime']);
            $isAudio = in_array($ext, ['webm', 'mp3', 'ogg']);
            @endphp

            <div class="max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2 {{ $belongsToAuth ? 'ml-auto' : '' }}">
                {{-- Avatar (prikazuj samo ako poruka nije tvoja) --}}
                <div @class([ 'shrink-0' , 'visible'=>$belongsToAuth //SET true if belongs to auth
                    ])>
<x-avatar
    wire:ignore
    class="h-8 w-8 lg:w-10 lg:h-10"
    src="{{ asset('storage/' . $message->sender->avatar) }}" />
                </div>

                {{-- Poruka --}}
                <div
                    @class([ 'flex flex-wrap text-[15px] border border-gray-200/40 rounded-xl pt-1 pb-2 pl-2 pr-2 flex-col' , 'text-black bg-[#f6f6f8fb]' , 'bg-blue-500/20 text-white'=> $belongsToAuth,
                    ])
                    >
                    {{-- Tekst --}}
                    @if ($message->body)
                    <p class="whitespace-normal truncate text-sm md:text-base tracking-wide lg:tracking-normal">
                        {{ $message->body }}
                    </p>
                    @endif

                    {{-- Audio --}}
                    @if ($isAudio)
                    <audio controls class="w-full mt-2 rounded shadow">
                        <source src="{{ asset('storage/' . $message->image) }}" type="audio/{{ $ext }}">
                        Your browser does not support audio display.
                    </audio>
                    @endif

                    {{-- Video --}}
                    @if ($isVideo)
                    <video controls class="w-48 rounded shadow mt-2" preload="metadata">
                        <source src="{{ asset('storage/' . $message->image) }}" type="video/{{ $ext }}">
                        Your browser does not support video display.
                    </video>
                    @endif

                    {{-- Slika --}}
                    @if (!$isVideo && !$isAudio && $message->image)
                    <!-- <img src="{{ asset('storage/' . $message->image) }}" class="w-48 rounded shadow mt-2" /> -->
                    <img src="{{ asset('storage/' . $message->image) }}" class="w-48 rounded shadow mt-2" />

                    @endif
                </div>
            </div>
            @endforeach
        </main>

        {{--Send Message -----}}
        <footer class="shrink-0 z-10 bg-white dark:bg-inherit inset-x-0 py-2">
            <div class="  border px-3 py-1.5 rounded-3xl grid grid-cols-12 gap-4 items-center overflow-hidden w-full max-w-[95%] mx-auto">

                {{-- Emoji icon --}}
                <div
                    x-data="{ showPicker: false, body: '' }"
                    class="col-span-1 ml-auto flex justify-end text-right relative">
                    <!-- Emoji button -->
                    <button
                        type="button"
                        @click="showPicker = !showPicker"
                        class="p-2 rounded-md hover:bg-gray-300 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>
                    </button>

                    <!-- Emoji picker element -->
                    <div
                        x-show="showPicker"
                        @click.outside="showPicker = false"
                        class="relative bottom-full left-0 z-50"
                        x-cloak>
                        <emoji-picker
                            @emoji-click="e => {
        const input = document.getElementById('sendMessage');
        if (input) {
            const emoji = e.detail.unicode;
            
            // Pozicija kursora
            const start = input.selectionStart;
            const end = input.selectionEnd;
            const value = input.value;

            // Ubacivanje emojija na poziciju kursora
            input.value = value.substring(0, start) + emoji + value.substring(end);

            // Postavi novi kursor odmah iza emojija
            const newPos = start + emoji.length;
            input.selectionStart = input.selectionEnd = newPos;

            // Trigger input event za Livewire/Alpine sync
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }

        showPicker = false;
    }" />

                    </div>
                </div>

                <form wire:submit='sendMessage' method="POST" autocapitalize="off" class="col-span-11 md:col-span-9 ">
                    @csrf
                    <input type="hidden" autocomplete="false" style="display: none">
                    <div class="grid grid-cols-12">
                        <input autocomplete="off" wire:model='body' id="sendMessage"
                            autofocus type="text" name="message"
                            placeholder="Message" maxlength="1700"
                            class="col-span-10  border-0  outline-0 focus:border-0 focus:ring-0  hover:ring-0 rounded-lg   dark:text-gray-300     focus:outline-none   " />

                        <button
                            type="button"
                            @click="
        $wire.sendMessage().then(() => {
            // Očisti model i input nakon slanja
            body = '';
            
            // Dodatno, resetiraj vrijednost inputa (ako nije bindan preko x-model)
            const input = document.getElementById('sendMessage');
            if (input) input.value = '';
        })" class="col-span-2    ml-[-7rem]  text-blue-500 font-bold">Send

                        </button>


                    </div>
                </form>

                {{-- Actions --}}
                <div class="col-span-2 ml-auto hidden md:flex items-center gap-3">

                    {{-- Voice Recorder --}}
                    <div x-data="voiceRecorder()" class="flex flex-col gap-2">
                        <!-- Audio messages preview -->
                        {{-- <div class="border p-3 rounded w-[20rem] ml-[-20rem] bg-gray-50 text-sm" x-show="messages.length">--}}
                        <div class="p-3 rounded w-[20rem] ml-[-20rem] text-sm" x-show="messages.length">
                            <template x-for="(msg, i) in messages" :key="i">
                                <div class="mb-2">
                                    <template x-if="msg.type === 'audio'">
                                        <audio :src="msg.src" controls class="w-full"></audio>
                                    </template>
                                </div>
                            </template>
                        </div>
                        <!-- Record button -->
                        <div class="flex items-center mb-[0.25rem] ml-[-5rem] gap-2">
                            <!-- <button
                                @click="toggleRecording"
                                :class="recording ? 'bg-red-500' : 'bg-blue-600'"
                                class="p-2 rounded-full text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                                </svg>
                            </button> -->

                            <button
                                @click="startRecording"
                                @dblclick="
                                    stopRecording();
                                    // Pošalji poruku nakon zaustavljanja snimanja
                                    setTimeout(() => {
                                        if (messages.length) {
                                            const lastMsg = messages[messages.length - 1];
                                            if (lastMsg.type === 'audio') {
                                                fetch(lastMsg.src)
                                                    .then(res => res.blob())
                                                    .then(blob => {
                                                        const formData = new FormData();
                                                        formData.append('voice', blob, 'voice-message.webm');
                                                        formData.append('_token', '{{ csrf_token() }}');

                                                        fetch('{{ route('chat.sendVoice', ['conversation' => $conversation->id]) }}', {
                                                            method: 'POST',
                                                            body: formData,
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            messages = [];
                                                            window.dispatchEvent(new CustomEvent('scroll-bottom'));
                                                        })
                                                        .catch(error => {
                                                            alert('Greška pri slanju poruke.');
                                                        });
                                                    });
                                            }
                                        }
                                    }, 500); // Pričekaj da se snimanje završi i poruka doda u messages
                                "
                                @touchstart="startRecording"
                                @touchend="stopRecording"
                                :class="recording ? 'bg-red-500' : 'bg-blue-600'"
                                class="p-2 mt-[0rem] ml-[2rem] rounded-full text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                                </svg>
                            </button>

                            <!-- <span x-text="recording ? 'Snimanje...' : 'Klikni za snimanje poruke'"></span> -->
                        </div>

                        {{-- Gumb za slanje --}}
                        <button
                            type="button"
                            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            x-show="messages.length"
                            @click="
                                if (messages.length) {
                                    // Pretpostavljamo da je zadnja poruka audio
                                    const lastMsg = messages[messages.length - 1];
                                    if (lastMsg.type === 'audio') {
                                        fetch(lastMsg.src)
                                            .then(res => res.blob())
                                            .then(blob => {
                                                const formData = new FormData();
                                                formData.append('voice', blob, 'voice-message.webm');
                                                formData.append('_token', '{{ csrf_token() }}');

                                                fetch('{{ route('chat.sendVoice', ['conversation' => $conversation->id]) }}', {
                                                    method: 'POST',
                                                    body: formData,
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Očisti poruke nakon slanja
                                                    messages = [];
                                                    // Eventualno možeš emitovati Livewire event za refresh
                                                    window.dispatchEvent(new CustomEvent('scroll-bottom'));
                                                })
                                                .catch(error => {
                                                    alert('Greška pri slanju poruke.');
                                                });
                                            });
                                    }
                                }
                            ">
                            Pošalji
                        </button>
                    </div>
                    <script>
                        function voiceRecorder() {
                            return {
                                recording: false,
                                recorder: null,
                                audioChunks: [],
                                messages: [],

                                async startRecording() {
                                    if (this.recording) return;
                                    try {
                                        const stream = await navigator.mediaDevices.getUserMedia({
                                            audio: true
                                        });
                                        this.recorder = new MediaRecorder(stream);
                                        this.audioChunks = [];

                                        this.recorder.ondataavailable = event => {
                                            if (event.data.size > 0) this.audioChunks.push(event.data);
                                        };

                                        this.recorder.onstop = () => {
                                            const audioBlob = new Blob(this.audioChunks, {
                                                type: 'audio/webm'
                                            });
                                            const audioURL = URL.createObjectURL(audioBlob);

                                            this.messages.push({
                                                type: 'audio',
                                                src: audioURL
                                            });

                                            // Clean up
                                            this.audioChunks = [];
                                            this.recorder = null;
                                            this.recording = false;

                                            // Stop all tracks to release the mic
                                            stream.getTracks().forEach(track => track.stop());

                                            this.$nextTick(() => {
                                                const container = document.getElementById('conversation');
                                                if (container) container.scrollTop = container.scrollHeight;
                                            });
                                        };

                                        this.recorder.start();
                                        this.recording = true;
                                    } catch (e) {
                                        this.recording = false;
                                        alert('Nije moguće pristupiti mikrofonu.');
                                    }
                                },

                                stopRecording() {
                                    if (this.recording && this.recorder && this.recorder.state === 'recording') {
                                        this.recorder.stop();
                                    }
                                }
                            };
                        }
                    </script>



                    {{-- Upload Image/Video --}}
                    <div x-data="{
                        showImageForm: false,
                        previews: [],
                        maxFiles: 5,
                        allowedTypes: ['image/jpeg', 'image/png', 'image/webp', 'video/mp4', 'video/quicktime'],
                        handleFiles(files) {
                            this.previews = [];
                            Array.from(files).slice(0, this.maxFiles).forEach(file => {
                                if (!this.allowedTypes.includes(file.type)) return;
                                const reader = new FileReader();
                                reader.onload = e => {
                                    this.previews.push({
                                        src: e.target.result,
                                        type: file.type.startsWith('video/') ? 'video' : 'image'
                                    });
                                };
                                reader.readAsDataURL(file);
                            });
                        },
                        removePreview(index) { this.previews.splice(index, 1); },
                        resetInput() { this.previews = []; $refs.imageInput.value = null; }
                    }"
                        x-on:reset-image-input.window="resetInput()"
                        x-on:hide-image-form.window="showImageForm = false"
                        class="relative">
                        <!-- Open form button -->
                        <button @click="showImageForm = !showImageForm" class="p-2 hover:bg-gray-200 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor"
                                class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </button>
                        <!-- Image/video upload form -->
                        <div x-show="showImageForm" x-transition x-cloak class="relative top-full left-[-300px] bg-white p-3 mt-2 rounded shadow-md z-50">
                            <form wire:submit.prevent="sendImages" enctype="multipart/form-data" class="flex flex-col gap-3">
                                <div class="flex flex-col gap-2">
                                    <label for="images" class="text-sm font-semibold text-gray-700">
                                        Select images and video (max. 5, jpeg/jpg/jfif/png/webp, mp4/mov, avi, mp3 max 1GB each)
                                    </label>
                                    <input
                                        id="images"
                                        name="images"
                                        type="file"
                                        wire:model="images"
                                        accept="image/jpeg,image/png,image/jfif,image/webp,video/mp4,video/quicktime"
                                        multiple
                                        x-ref="imageInput"
                                        @change="handleFiles($refs.imageInput.files)"
                                        class="w-80 block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white 
            focus:outline-none focus:ring-2 focus:ring-blue-300 file:bg-blue-600 file:text-white 
            file:rounded-lg file:border-0 file:px-3 file:py-2 hover:file:bg-blue-700 transition" />
                                    @error('images.*')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Preview -->
                                <div class="grid grid-cols-3 items-center mt-1 overflow-x-scroll p-2 bg-white">
                                    <template x-for="(preview, idx) in previews" :key="idx">
                                        <div class="relative w-24 h-32 flex-shrink-0 inline-block">
                                            <template x-if="preview.type === 'image'">
                                                <img :src="preview.src" class="rounded shadow w-full h-full object-cover" />
                                            </template>
                                            <template x-if="preview.type === 'video'">
                                                <video :src="preview.src" controls class="rounded shadow w-full h-full object-cover"></video>
                                            </template>
                                            <button
                                                type="button"
                                                @click="removePreview(idx)"
                                                class="absolute top-1 right-1 bg-white text-red-500 rounded-full p-1 hover:bg-red-100">
                                                &times;
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <div wire:loading wire:target="images" class="text-sm text-gray-500">
                                    Učitavanje datoteka...
                                </div>

                                <button type="submit"
                                    wire:loading.attr="disabled"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 flex items-center justify-center">
                                    <span class="text-[15px]">Pošalji datoteke</span>
                                </button>
                            </form>

                        </div>
                    </div>

                    {{-- Heart --}}
                    <button type="button" @click="$dispatch('send-heart')" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="currentColor" class="w-7 h-7 text-red-500 hover:scale-110 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </button>


                </div>
                <script>
                    Livewire.on('sendHeart', () => {
                        const form = document.querySelector('form[wire\\:submit]');
                        if (form) {
                            form.dispatchEvent(new Event('submit', {
                                bubbles: true
                            }));
                        }
                    });
                </script>
            </div>
            @error('body') <p> {{$message}} </p> @enderror
        </footer>
    </div>

</div>