<div>
    {{-- Sve što želite da komponenta prikaže, mora biti unutar ovog jednog div-a --}}

    <!-- <div class="p-6">
        <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
        <p class="mb-4">{{ $post->content }}</p>
    </div> -->

                                <button
                                    onclick="Livewire.dispatch('openModal', {
                                     component: 'post.view-modal',
                                    arguments: { post: {{ $post->id }} }
                                    })"
                                    class="block px-4 py-2 hover:bg-gray-100">
                                    Copy Link...
                                </button>

                            </li>

                            <!-- Copy Link Modal -->
                            <div id="copyLinkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                <div class="bg-white rounded-lg p-6 w-80 text-center">
                                    <h5 class="font-semibold mb-2">Copy Link</h5>
                                    <input id="copyLinkInput" type="text" class="w-full border rounded px-2 py-1 mb-4" readonly>
                                    <button onclick="copyLinkToClipboard()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Copy</button>
                                    <br>
                                    <button onclick="closeCopyLinkModal()" class="text-gray-600 px-4 py-2 rounded hover:bg-gray-200">Close</button>
                                </div>
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

                                    navigator.clipboard.writeText(input.value).then(() => {
                                        alert('Link je kopiran!');
                                    }).catch(() => {
                                        alert('Kopiranje nije uspjelo.');
                                    });
                                }
                            </script>




<!-- <div id="copyLinkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                <div class="bg-white rounded-lg p-6 w-80 text-center">
                                    <h5 class="font-semibold mb-2">Copy Link</h5>
                                    <input id="copyLinkInput" type="text" class="w-full border rounded px-2 py-1 mb-4" readonly>
                                    <button onclick="copyLinkToClipboard()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Copy</button>
                                    <br>
                                    <button onclick="closeCopyLinkModal()" class="text-gray-600 px-4 py-2 rounded hover:bg-gray-200">Close</button>
                                </div>
                            </div> -->