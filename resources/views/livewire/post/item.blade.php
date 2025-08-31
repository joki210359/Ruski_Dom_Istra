{{-- vezana je sa App\Livewire\Post\Item --}}

<div class="max-w-lg mx-auto">
    {{-- Header --}}
    <header class="flex items-center gap-3">
        <a href="{{ $post->user ? route('profile.home', $post->user->username) : '#' }}">
            <x-avatar
                src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . basename($post->user->avatar)) : asset('storage/avatars/default.png') }}"
                alt="{{ $post->user ? $post->user->name : 'Unknown' }}"
                class="w-12 h-12 rounded-full"/>
        </a>
        <div class="grid grid-cols-7 w-full gap-2">
            <div class="col-span-5 mt-2">
                <h5 class="font-semibold truncate text-sm">
                    {{ $post->user->name ?? 'Unknown' }}
                    {{ $post->user->familyname ?? '' }}
                </h5>
            </div>
            <div class="relative flex items-center p-2">
                <div class="relative inline-block text-left">
                    <!-- Dugme s tri točkice -->
                    <div x-data="{ dropdownOpen: false, showAccountModal: false }"
                         class="relative inline-block text-left ml-[5rem] mb-6">

                        {{-- Post content --}}
                        <!-- <p class="text-gray-800">{{ $post->content }}</p> -->

                        {{-- Dropdown trigger --}}
                        <button @click="dropdownOpen = !dropdownOpen"
                                class="absolute top-2 left-3 w-4 h-10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="40"
                                 height="40"
                                 fill="currentColor"
                                 :class="dropdownOpen ? 'rotate-270 text-green-600 animate-ping transition-all duration-300':'rotate-0 text-black transition-all duration-300'"
                                 class="bi bi-three-dots-vertical text-black">
                                <path
                                    d="M9.5 13a1.725 1.725 0 1 1-3.45 0 1.725 1.725 0 0 1 3.45 0zm0-5a1.725 1.725 0 1 1-3.45 0 1.725 1.725 0 0 1 3.45 0zm0-5a1.725 1.725 0 1 1-3.45 0 1.725 1.725 0 0 1 3.45 0z"/>
                            </svg>

                        </button>

                        </button>

                        {{-- Dropdown menu --}}
                        <div
                            x-show="dropdownOpen"
                            x-cloak
                            x-transition
                            @click.away="dropdownOpen = false"
                            @openModal.window="dropdownOpen = false"
                            class="absolute right-2 top-10 w-56 bg-white border border-gray-200 rounded-md shadow-xl z-50">

                            <ul class="py-1 text-sm text-gray-700">

                                {{-- Report --}}
                                <li>
                                    <button
                                        wire:click="$dispatch('openModal', {component: 'report-post', arguments: {postId: '{{ $post->id }}'}})"
                                        @click="dropdownOpen = false"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 font-semibold">
                                        Report
                                    </button>
                                </li>
                                <hr class="border-t-2 border-blue-500 mx-4 my-1">

                                {{-- Not interested --}}
                                <li>
                                    <button
                                        wire:click="$dispatch('openModal', {component: 'post.not-interested', arguments: {postId: '{{ $post->id }}'}})"
                                        @click="dropdownOpen = false"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">Not interested
                                    </button>
                                </li>
                                <hr class="border-t border-gray-200 mx-4 my-1">

                                {{-- Go to post --}}
                                <li>
                                    <button
                                        onclick="window.location.href='{{ url('/post/' . $post->id) }}'"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                        Go to post
                                    </button>

                                </li>
                                <hr class="border-t border-gray-200 mx-4 my-1">
                                                                {{-- Share to... --}}
                                <li>
                                    <div x-data="shareComponent({{ $post->id }})" class="relative">
                                        <button
                                            @click="openShare"
                                            class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                            Share to...
                                        </button>

                                        <!-- Modal -->
                                        <div
                                            x-show="modalOpen"
                                            x-transition
                                            class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50"
                                            @click.self="close"
                                            style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">
                                            <div
                                                x-show="modalOpen"
                                                x-transition.scale
                                            <div class="bg-white rounded-2xl shadow-2xl w-full overflow-hidden" style="max-width: 30rem;">


                                            <!-- Header -->
                                                <div class="flex items-center gap-1 px-6 py-1 border-b border-gray-200">
                                                    <svg width="1rem" height="1.5rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6495 0.799565C18.4834 -0.72981 16.0093 0.081426 16.0093 1.99313V3.91272C12.2371 3.86807 9.65665 5.16473 7.9378 6.97554C6.10034 8.9113 5.34458 11.3314 5.02788 12.9862C4.86954 13.8135 5.41223 14.4138 5.98257 14.6211C6.52743 14.8191 7.25549 14.7343 7.74136 14.1789C9.12036 12.6027 11.7995 10.4028 16.0093 10.5464V13.0069C16.0093 14.9186 18.4834 15.7298 19.6495 14.2004L23.3933 9.29034C24.2022 8.2294 24.2022 6.7706 23.3933 5.70966L19.6495 0.799565ZM7.48201 11.6095C9.28721 10.0341 11.8785 8.55568 16.0093 8.55568H17.0207C17.5792 8.55568 18.0319 9.00103 18.0319 9.55037L18.0317 13.0069L21.7754 8.09678C22.0451 7.74313 22.0451 7.25687 21.7754 6.90322L18.0317 1.99313V4.90738C18.0317 5.4567 17.579 5.90201 17.0205 5.90201H16.0093C11.4593 5.90201 9.41596 8.33314 9.41596 8.33314C8.47524 9.32418 7.86984 10.502 7.48201 11.6095Z" fill="#0F0F0F"/>
                                                        <path d="M7 1.00391H4C2.34315 1.00391 1 2.34705 1 4.00391V20.0039C1 21.6608 2.34315 23.0039 4 23.0039H20C21.6569 23.0039 23 21.6608 23 20.0039V17.0039C23 16.4516 22.5523 16.0039 22 16.0039C21.4477 16.0039 21 16.4516 21 17.0039V20.0039C21 20.5562 20.5523 21.0039 20 21.0039H4C3.44772 21.0039 3 20.5562 3 20.0039V4.00391C3 3.45162 3.44772 3.00391 4 3.00391H7C7.55228 3.00391 8 2.55619 8 2.00391C8 1.45162 7.55228 1.00391 7 1.00391Z" fill="#0F0F0F"/>
                                                    </svg>
                                                    <h2 class="text-lg font-semibold text-gray-900">
                                                    Share link
                                                    </h2>

                                                    <div class="flex items-center space-x-2">
                                                        <!-- Dropdown korisnika -->
                                                        <div x-data="{ open: false }" class="relative">
                                                            <button @click="open = !open" class="flex items-center px-2 py-1 focus:outline-none"   style="margin-left: 15rem;">

                                                                <x-avatar
                                                                    src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . basename($post->user->avatar)) : asset('storage/avatars/default.png') }}"
                                                                    alt="{{ $post->user ? $post->user->name : 'Unknown' }}"
                                                                    class="w-8 h-8 rounded-full"/>

                                                            </button>

                                                        </div>

                                                        <!-- Gumb za zatvaranje -->
                                                        <button @click="close" class="text-gray-500 hover:text-gray-700"   style="margin-left: 1rem;">
                                                            ✕
                                                        </button>
                                                    </div>
                                                </div>


                                                <!-- Link & Copy -->
                                                <div class="flex items-center h-18 space-x-4 px-6 py-1 border-b border-gray-200">

                                                    <div class="p-2 rounded-md border hover:bg-gray-100"
                                                            :class="{'bg-green-100': copied}"
                                                            title="Copy link">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <!-- Lijevi i desni "luk" -->
                                                            <path d="M17 7H15V9H17C18.1 9 19 9.9 19 11C19 12.1 18.1 13 17 13H15V15H17C19.21 15 21 13.21 21 11C21 8.79 19.21 7 17 7ZM9 7H7C4.79 7 3 8.79 3 11C3 13.21 4.79 15 7 15H9V13H7C5.9 13 5 12.1 5 11C5 9.9 5.9 9 7 9H9V7Z" fill="black"/>

                                                            <!-- Središnja crta (centar) -->
                                                            <line x1="9.5" y1="11" x2="14.5" y2="11"
                                                                  stroke="black"
                                                                  stroke-width="2"
                                                                  stroke-linecap="round"/>
                                                        </svg>
                                                    </div>

                                                    <a :href="postUrl" class="text-blue-600 hover:underline text-sm" x-text="postUrl"></a>

                                                    <div
                                                        x-data="{
        showPopup: false,
        postUrl: '{{ url('/post/' . $post->id) }}',
        generateQR() {
            this.$nextTick(() => {
                document.getElementById('qrcode').innerHTML = '';
                new QRCode(document.getElementById('qrcode'), {
                    text: this.postUrl,
                    width: 400,
                    height: 400
                });
            });
        }
    }"
                                                    >
                                                        <!-- Gumb za otvaranje QR koda -->
                                                        <button
                                                            @click="showPopup = true; generateQR()"
                                                            class="ml-12 mt-4 p-2 rounded-md border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400 transition shadow-sm hover:shadow-md"
                                                            title="Generate QR code">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h4v4H3zM7 7h4v4H7zM3 15h4v4H3zM15 3h4v4h-4zM15 15h4v4h-4z" />
                                                            </svg>

                                                        </button>

                                                        <!-- Popup -->
                                                        <div
                                                            x-show="showPopup"
                                                            @click.away="showPopup = false"
                                                            x-transition
                                                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                                            style="display: none;"
                                                        >
                                                            <div
                                                                class="bg-white rounded-lg p-6 shadow-lg max-w-md w-full"
                                                                @click.stop
                                                            >
                                                                <h2 class="text-lg font-semibold mb-4">QR Code</h2>
                                                                <div id="qrcode" class="mx-auto"></div>

                                                                <button
                                                                    @click="showPopup = false"
                                                                    class="mt-4 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition"
                                                                >
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function qrComponent() {
                                                            return {
                                                                postUrl: '{{ url("/post/".$post->id) }}',
                                                                showPopup: false,
                                                                generateQr() {
                                                                    this.showPopup = true;
                                                                    const container = document.getElementById('qrcode');
                                                                    container.innerHTML = ''; // očisti prethodni QR ako postoji

                                                                    QRCode.toCanvas(
                                                                        this.postUrl,
                                                                        {
                                                                            width: 1200,  // širina canvasa
                                                                            height: 1200  // visina (nije obavezno jer je QR kvadratan, ali možeš postaviti)
                                                                        },
                                                                        (error, canvas) => {
                                                                            if (error) {
                                                                                console.error(error);
                                                                                alert('QR code generation failed');
                                                                                this.showPopup = false;
                                                                                return;
                                                                            }
                                                                            container.innerHTML = ''; // očisti stari sadržaj
                                                                            container.appendChild(canvas);
                                                                        }
                                                                    );

                                                            }
                                                        }
                                                    </script>

                                                    <d x-data="{ copied: false, link: 'https://example.com/your-link' }">
                                                        <button
                                                            onclick="showCopyLinkModal(window.location.origin + '/post/{{ $post->id }}')"
                                                            class="ml-[0rem] p-1 rounded-md border hover:bg-gray-100"
                                                            :class="{'bg-green-100': copied}"
                                                            title="Copy link">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17 7H15V9H17C18.1 9 19 9.9 19 11C19 12.1 18.1 13 17 13H15V15H17C19.21 15 21 13.21 21 11C21 8.79 19.21 7 17 7ZM9 7H7C4.79 7 3 8.79 3 11C3 13.21 4.79 15 7 15H9V13H7C5.9 13 5 12.1 5 11C5 9.9 5.9 9 7 9H9V7Z" fill="black"/>
                                                                <line x1="9.5" y1="11" x2="14.5" y2="11" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                                            </svg>
                                                        </button>

                                                        <script>
                                                            function copyLink() {
                                                                navigator.clipboard.writeText(this.link).then(() => {
                                                                    this.copied = true;
                                                                    setTimeout(() => this.copied = false, 2000);
                                                                }).catch(err => {
                                                                    console.error('Copy failed:', err);
                                                                });
                                                            }
                                                        </script>
                                                    </d>

                                                </div>

                                                <!-- Services -->
                                                <div class="px-6 py-4 max-w-xl">
                                                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Share using</h3>
                                                    <div class="flex flex-wrap gap-6">
                                                        <template x-for="service in services" :key="service.id">
                                                            <button @click="openService(service)"
                                                                    class="flex flex-col items-center hover:bg-gray-100 rounded-lg p-2 w-[25%]">
                                                                <img :src="service.icon" class="w-8 h-8" />
                                                                <span class="text-xs" x-text="service.name"></span>
                                                            </button>
                                                        </template>

                                                     </div>
                                                </div>
                                                <!-- Toast -->
                                                <div x-show="copied" x-transition
                                                     class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg text-sm">
                                                    Link copied!
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        const currentPostId = {{ $post->id ?? 1 }}

                                        function shareComponent(postId = currentPostId) {
                                            const baseUrl = window.location.origin + '/post/' + postId;

                                            return {
                                                modalOpen: false,
                                                nearbyModalOpen: false,
                                                copied: false,
                                                postUrl: baseUrl,
                                                services: [
                                                    { id: 3, name: "WhatsApp", icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png", url: "https://api.whatsapp.com/send?text=" + encodeURIComponent("Check this out: " + baseUrl) },
                                                    { id: 11, name: "Viber",   icon: "https://cdn0.iconfinder.com/data/icons/social-network-24/512/Viber-1024.png", url: "viber://forward?text=" + encodeURIComponent("Check this out: " + baseUrl) },
                                                    { id: 9, name: "Telegram", icon: "https://cdn-icons-png.flaticon.com/512/2111/2111646.png", url: "https://telegram.me/share/url?url=" + encodeURIComponent(baseUrl) },
                                                    { id: 6, name: "Facebook", icon: "https://cdn-icons-png.flaticon.com/512/733/733547.png", url: "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(baseUrl) },
                                                    { id: 7, name: "X / Twitter", icon: "https://cdn4.iconfinder.com/data/icons/social-media-black-white-2/1227/X-512.png", url: "https://x.com/intent/tweet?url=" + encodeURIComponent(baseUrl) },
                                                    { id: 8, name: "LinkedIn", icon: "https://cdn-icons-png.flaticon.com/512/733/733561.png", url: "https://www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(baseUrl) },
                                                    { id: 1, name: "Nearby Sharing", icon: "https://cdn-icons-png.flaticon.com/512/2630/2630789.png", url: "#" },
                                                    { id: 2, name: "Phone Link", icon: "https://cdn-icons-png.flaticon.com/512/565/565547.png", url: "ms-phone://connect" },
                                                    { id: 4, name: "Email", icon: "https://cdn1.iconfinder.com/data/icons/unicons-line-vol-3/24/fast-mail-alt-1024.png", url: "mailto:?subject=Check out this post&body=" + encodeURIComponent(baseUrl) },
                                                    //{ id: 5, name: "Adobe Acrobat Share", icon: "https://cdn-icons-png.flaticon.com/512/888/888857.png", url: "#" },
                                                    // { id: 10, name: "Quick Share", icon: "https://cdn-icons-png.flaticon.com/512/1077/1077114.png", url: "#" }
                                                     ],

                                                openShare() {
                                                    if (navigator.share) {
                                                        navigator.share({
                                                            title: 'Check out this post!',
                                                            text: 'Pogledaj ovaj post koji sam našao.',
                                                            url: this.postUrl
                                                        }).catch(() => {
                                                            this.modalOpen = true;
                                                        });
                                                    } else {
                                                        this.modalOpen = true;
                                                    }
                                                },

                                                close() {
                                                    this.modalOpen = false;
                                                },

                                                copyLink() {
                                                    navigator.clipboard.writeText(this.postUrl)
                                                        .then(() => {
                                                            this.copied = true;
                                                            setTimeout(() => this.copied = false, 2000);
                                                        });
                                                },

                                                generateQr() {
                                                    alert('QR code generation not implemented in this demo.');
                                                },

                                                openNearbySharingModal() {
                                                    alert("To share nearby, use Windows 'Nearby Sharing' from your system tray or file explorer.");
                                                },
                                                openNearbySharingModal() {
                                                    this.nearbyModalOpen = true;
                                                },

                                                openService(service) {
                                                    if (!service.url) return;

                                                    // Poseban tretman za Nearby Sharing
                                                    if (service.id === 1) {
                                                        this.openNearbySharingModal();
                                                        return;
                                                    }

                                                    // Poseban tretman za ms-phone protokol
                                                    if (service.url.startsWith('ms-phone://')) {
                                                        window.location.href = service.url;
                                                        return;
                                                    }

                                                    // Ako je URL # ili prazan, ne otvaraj ništa
                                                    if (service.url === '#') {
                                                        return;
                                                    }

                                                    // Otvori link u novom tabu
                                                    window.open(service.url, '_blank');
                                                }
                                            }
                                        }

                                        function quickShare() {
                                            if (navigator.share) {
                                                navigator.share({
                                                    title: 'Check this out!',
                                                    text: 'Pogledaj ovo!',
                                                    url: baseUrl // tvoja trenutna URL varijabla
                                                })
                                                    .then(() => console.log('Uspješno podijeljeno'))
                                                    .catch((error) => console.log('Greška pri dijeljenju', error));
                                            } else {
                                                alert('Dijeljenje nije podržano na ovom uređaju. Kopirajte link: ' + baseUrl);
                                            }
                                        }

                                    </script>

                                </li>
                                <hr class="border-t border-gray-200 mx-4 my-1">

                                {{-- Copy link --}}
                                <div x-data="linkHandler()" class="relative">
                                    <div x-data="linkHandler()" class="relative">

                                        <li>
                                            <button
                                                onclick="showCopyLinkModal(window.location.origin + '/post/{{ $post->id }}')"
                                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                                Copy link
                                            </button>

                                        </li>
                                        <hr class="border-t border-gray-200 mx-4 my-1">
                                        {{-- Copy Link Modal --}}
                                        <div id="copyLinkModal"
                                             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                            <div class="bg-white rounded-lg p-6 w-80 text-center">
                                                <h5 class="font-semibold mb-2">Copy Link</h5>
                                                <input id="copyLinkInput" type="text"
                                                       class="w-full border rounded px-2 py-1 mb-4" readonly>
                                                <button onclick="copyLinkToClipboard()"
                                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">
                                                    Copy
                                                </button>
                                                <br>
                                                <button onclick="closeCopyLinkModal()"
                                                        class="text-gray-600 px-4 py-2 rounded hover:bg-gray-200">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Link Copied Notification Modal -->
                                <div id="linkCopiedPopup"
                                     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-md text-center w-72">
                                        <h2 class="text-lg font-semibold text-green-600">✅ The link has been copied!</h2>
                                        <p class="text-sm text-gray-600 mt-2">The link has been successfully saved in clipboard.</p>
                                    </div>
                                </div>

                                <script>
                                    function showCopyLinkModal(url) {
                                        document.getElementById('copyLinkInput').value = url;
                                        document.getElementById('copyLinkModal').classList.remove('hidden');
                                    }

                                    function closeCopyLinkModal() {
                                        document.getElementById('copyLinkModal').classList.add('hidden');
                                    }

                                    function copyLinkToClipboard() {
                                        const input = document.getElementById('copyLinkInput');
                                        input.select();
                                        input.setSelectionRange(0, 99999); // Za mobilne uređaje

                                        if (navigator.clipboard && window.isSecureContext) {
                                            // Secure context → HTTPS ili localhost
                                            navigator.clipboard.writeText(input.value).then(() => {
                                                showCopiedPopup();
                                            }).catch(() => {
                                                alert('Kopiranje nije uspjelo.');
                                            });
                                        } else {
                                            // Fallback za HTTP vanjsku mrežu
                                            try {
                                                document.execCommand('copy');
                                                showCopiedPopup();
                                            } catch (err) {
                                                alert('Kopiranje nije uspjelo.');
                                            }
                                        }
                                    }

                                    function showCopiedPopup() {
                                        const popup = document.getElementById('linkCopiedPopup');
                                        popup.classList.remove('hidden');

                                        setTimeout(() => {
                                            popup.classList.add('hidden');
                                        }, 2000); // 2 sekunde
                                    }
                                </script>

                                {{-- About this account --}}
                                <div x-data="{ showAccountModal: false, dropdownOpen: false }"></div>
                                <li>
                                    <button
                                        @click="showAccountModal = true; dropdownOpen = false"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                        About this account
                                    </button>
                                </li>
                                <hr class="border-t border-gray-200 mx-4 my-1">

                                {{-- Cancel --}}
                                <li>
                                    <button
                                        @click="dropdownOpen = false"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">Cancel
                                    </button>
                                </li>
                            </ul>
                        </div>

                        {{-- Modal: About this account --}}
                        <div
                            x-show="showAccountModal"
                            x-cloak
                            x-transition
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                            <div class="bg-white rounded-lg p-6 w-96 relative">
                                <div class="flex flex-col items-center text-center">
                                    <a href="{{ $post->user ? route('profile.home', $post->user->username) : '#' }}">
                                        <img
                                            src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . basename($post->user->avatar)) : asset('storage/avatars/default.png') }}"
                                            class="w-20 h-20 rounded-full"/>
                                    </a>
                                    <h5 class="font-semibold mt-2">{{ $post->user->name ?? 'Unknown' }}</h5>
                                    <p class="text-sm text-gray-500 mb-4">Info about account authenticity.</p>
                                    <div class="text-sm text-left w-full">
                                        <p><strong>Date joined:</strong> {{ $post->user->created_at->format('F Y') ??
                                            'Unknown' }}</p>
                                        <p><strong>Location:</strong> {{ $post->user->location ?? 'Unknown' }}</p>
                                        <p><strong>Former usernames:</strong> {{ isset($post->user->former_usernames) ?
                                            count($post->user->former_usernames) : 0 }}</p>
                                    </div>

                                    <button
                                        @click="window.location.href = '{{ $post->user ? route('profile.home', $post->user->username) : '#' }}'"
                                        class="mt-4 text-sm text-white bg-blue-800 px-4 py-2 rounded hover:bg-green-300 hover:text-black transition duration-150">
                                        View account
                                    </button>

                                    <button
                                        @click="showAccountModal = false"
                                        class="mt-6 text-sm text-white bg-blue-800 px-4 py-2 rounded hover:bg-green-300 hover:text-black transition duration-150">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



    </header>

    {{-- Main --}}
    <main>
        <div class="my-2">
            <div x-init="
                new Swiper($el,{
                    modules: [Navigation, Pagination],
                    loop:true,
                    pagination: { el: '.swiper-pagination' },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                });
            " class="swiper h-[30rem] border bg-white">
                <ul x-cloak class="swiper-wrapper">
                    @foreach ($post->media as $file)
                    <li class="swiper-slide">
                        @switch($file->mime)
                        @case('video')

                        <x-video source="{{ asset($file->url) }}"/>
<!--                        <x-video source="{{ asset($file->url) }}"/>-->

                        @break
                        @case('image')
                        <img src="{{ asset($file->url) }}" alt="" class="h-[30rem] w-full block object-scale-down">
<!--                        <img src="{{ url($file->url) }}" alt="" class="h-[30rem] w-full block object-scale-down">-->
<!--                        <img src="{{ url('storage/' . $file->url) }}" alt="" class="h-[30rem] w-full block object-scale-down">-->
<!--                        <img src="{{ asset($file->url) }}" alt="" class="h-[30rem] w-full block object-scale-down">-->

                        @break
                        @endswitch
                    </li>

                    @endforeach
                </ul>
                <div class="swiper-pagination"></div>
                @if (count($post->media) > 1)
                <div class="swiper-button-prev absolute top-1/2 z-10 p-2">
                    <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                        </svg>
                    </div>
                </div>
                <div class="swiper-button-next absolute right-0 top-1/2 z-10 p-2">
                    <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </div>
                </div>
                @endif
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer>
        <div class="flex gap-4 items-center my-2">
            {{-- Like --}}
            <button wire:click='togglePostLike()' aria-label="Like">
                @if ($post->isLikedBy(auth()->user()))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-6 h-6 text-rose-500">
                    <title>Unlike</title>
                    <path
                        d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                     stroke="currentColor" class="w-6 h-6">
                    <title>Like</title>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                </svg>
                @endif
            </button>
            {{-- Comment --}}
            @if ($post->allow_commenting)
            <button
                onclick="Livewire.dispatch('openModal',{component:'post.view.modal',arguments:{post:'{{ $post->id }}'}})">
                <svg aria-label="Comment" fill="currentColor" height="24" viewBox="0 0 24 24" width="24">
                    <title>Comment</title>
                    <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor"
                          stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </button>
            @endif

            {{-- Share --}}
            <!-- Gumb za dijeljenje -->
            <button
                type="button"
                data-url="{{ route('post.view', $post->id) }}"
                class="hover:text-blue-500 text-gray-700 dark:text-gray-300 transition-colors duration-200"
                title="Share the post"
                aria-label="Share the post">

                <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                    <title>Share</title>
                    <line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2" x1="22" x2="9.218" y1="3" y2="10.083"></line>
                    <polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334"
                             stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon>
                </svg>
            </button>

            <!-- Modal -->
            <div id="shareModal" class="hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                <<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 w-30 relative"
                      style="margin-left: 34rem; margin-bottom: 6rem;">
                <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 dark:hover:text-white">&times;</button>
                    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Share the post</h2>

                    <div class="space-y-2">
                        <a id="shareFacebook" href="#" target="_blank" class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Facebook</a>
                        <a id="shareTwitter" href="#" target="_blank" class="block w-full bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded">X / Twitter</a>
                        <a id="shareLinkedIn" href="#" target="_blank" class="block w-full bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded">LinkedIn</a>
                        <a id="shareWhatsApp" href="#" target="_blank" class="block w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">WhatsApp</a>
                        <a id="shareViber" href="#" target="_blank" class="block w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">Viber</a>
                        <a id="shareEmail" href="#" target="_blank" class="block w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Email</a>
<!--                        <button id="copyLink" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded">Kopiraj link</button>-->
                           </div>
                </div>

                <script>
                    const shareButtons = document.querySelectorAll('button[aria-label="Share the post"]');
                    const modal = document.getElementById('shareModal');
                    const closeModal = document.getElementById('closeModal');
                    const copyBtn = document.getElementById('copyLink');

                    shareButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const url = button.dataset.url;

                            if (navigator.share) {
                                // Ako browser podržava Web Share API, koristi ga
                                navigator.share({
                                    title: 'Pogledaj ovu objavu!',
                                    url: url
                                }).catch(() => {
                                    openCustomModal(url);
                                });
                            } else {
                                openCustomModal(url);
                            }
                        });
                    });

                    function openCustomModal(url) {
                        document.getElementById('shareFacebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                        document.getElementById('shareTwitter').href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}`;
                        document.getElementById('shareLinkedIn').href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                        document.getElementById('shareWhatsApp').href = `https://api.whatsapp.com/send?text=${encodeURIComponent(url)}`;
                        document.getElementById('shareViber').href = `viber://forward?text=${encodeURIComponent(url)}`;
                        document.getElementById('shareEmail').href = `mailto:?subject=${encodeURIComponent('Pogledaj ovu objavu!')}&body=${encodeURIComponent(url)}`;

                        // copyBtn.onclick = () => {
                        //     navigator.clipboard.writeText(url).then(() => {
                        //         alert('Link je kopiran!');
                        //     }).catch(() => {
                        //         alert('Kopiranje linka nije uspjelo.');
                        //     });
                        // };uspjelo

                        modal.classList.remove('hidden');
                    }

                    closeModal.addEventListener('click', () => {
                        modal.classList.add('hidden');
                    });

                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) modal.classList.add('hidden');
                    });
                </script>









                {{-- Bookmark/favorites --}}
                <span class="ml-auto">
                <button wire:click='toggleFavorite()'>
    @if ($post->hasBeenFavoritedBy(auth()->user()))
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-label="Remove"
             class="w-6 h-6" color="green">
            <title>Remove</title>
            <path fill-rule="evenodd"
                  d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z"
                  clip-rule="evenodd"/>
        </svg>
    @else
        <svg aria-label="Save" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.8"
             stroke="currentColor" class="w-6 h-6" color="blue">
            <title>Save</title>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
        </svg>
    @endif
</button>

            </span>
            </div>








            {{-- Bookmark/favorites --}}
            <span class="ml-auto">
                <button wire:click='toggleFavorite()'>
    @if ($post->hasBeenFavoritedBy(auth()->user()))
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-label="Remove"
             class="w-6 h-6" color="green">
            <title>Remove</title>
            <path fill-rule="evenodd"
                  d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z"
                  clip-rule="evenodd"/>
        </svg>
    @else
        <svg aria-label="Save" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.8"
             stroke="currentColor" class="w-6 h-6" color="blue">
            <title>Save</title>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
        </svg>
    @endif
</button>

            </span>
        </div>
        {{-- Likes and views --}}
        @if ($post->totalLikers > 0 && !$post->hide_like_view)
        <p class="font-bold text-sm">{{$post->totalLikers}} {{$post->totalLikers > 1 ? 'likes' : 'like'}}</p>
        @endif
        {{-- Name and comment --}}
        <div class="flex text-sm gap-2 font-medium">
            <p>
                <strong class="font-bold">
                    {{ $post->user ? $post->user->name : 'Unknown' }}
                </strong>
                {{ $post->description }}
            </p>
        </div>
        @if ($post->allow_commenting)
        {{-- View post modal --}}
        <button
            onclick="Livewire.dispatch('openModal',{component:'post.view.modal',arguments:{post:'{{ $post->id }}'}})"
            class="text-slate-500/90 text-sm font-medium"> View all {{$post->comments->count()}} comments
        </button>
        @auth
        {{-- Show comments for auth --}}
        <ul class="my-2">
            @foreach ($post->comments()->where('user_id',auth()->id())->get() as $comment )
            <li class="grid grid-cols-12 text-sm items-center">
                <span class="font-bold col-span-3 mb-auto">
                    {{ auth()->user()->name }} {{ auth()->user()->familyname }}
                </span>
                <span class="col-span-8">{{$comment->body}} </span>
                <button class="col-span-1 mb-auto flex justify-end pr-px">
                    @if ($comment->isLikedBy(auth()->user()))
                    <span wire:click='toggleCommentLike({{$comment->id}})'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             class="w-3 h-3 text-rose-500">
                            <path
                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                        </svg>
                    </span>
                    @else
                    <span wire:click='toggleCommentLike({{$comment->id}})'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                             stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                    </span>
                    @endif
                </button>
            </li>
            @endforeach
        </ul>
        @endauth
        {{-- Leave comment --}}
        <form wire:key="{{ time() }}" @submit.prevent="$wire.addComment()"
              x-data="{ body: @entangle('body'), showPicker: false }"
              class="grid grid-cols-12 items-center w-full">
            @csrf

            <!-- Input za komentar -->
            <input x-model="body" type="text" placeholder="Leave a comment"
                   class="border-0 col-span-10 placeholder:text-sm outline-none focus:outline-none px-0 rounded-lg hover:ring-0 focus:ring-0">

            <!-- Dugme za prikaz emoji pickera -->
            <div class="col-span-1 ml-auto flex justify-end text-right relative">
                <button type="button" @click="showPicker = !showPicker"
                        class="p-2 rounded-md hover:bg-gray-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/>
                    </svg>
                </button>

                <!-- Emoji picker element -->
                <emoji-picker x-show="showPicker" class="absolute bottom-full right-0 z-50"
                              @emoji-click="(e) => {
                body += e.detail.unicode;
                showPicker = false;
            }">
                </emoji-picker>
            </div>

            <!-- Submit dugme -->
            <div class="col-span-1 ml-auto flex justify-end text-right">
                <button type="submit" x-cloak x-show="body.length > 0"
                        class="text-sm font-semibold text-blue-500">
                    Post
                </button>
            </div>
        </form>

        @endif
    </footer>


</div>
