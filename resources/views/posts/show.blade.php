<!-- Npr. u resources/views/livewire/post/show.blade.php -->

<button
    onclick="showCopyLinkModal('{{ route('post.view', $post->id) }}')"
    class="px-4 py-2 bg-blue-500 text-white rounded">
    Copy link
</button>

<!-- Modal -->
<div id="copyLinkModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded p-6">
        <input id="copyLinkInput" type="text" readonly class="w-full border p-2 mb-4">
        <button onclick="copyLinkToClipboard()">Kopiraj</button>
        <button onclick="closeCopyLinkModal()">Zatvori</button>
    </div>
</div>

<!-- Skripta -->
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
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value).then(() => {
            alert('Link je kopiran!');
        });
    }
</script>
