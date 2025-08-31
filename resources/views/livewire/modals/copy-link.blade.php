<div x-data x-show="$wire.show" x-cloak
     x-init="$watch('$wire.show', value => {
        if (value) document.body.classList.add('overflow-hidden');
        else document.body.classList.remove('overflow-hidden')
     })"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <h2 class="text-lg font-semibold mb-4">Copy Link</h2>

<input
    type="text"
    readonly
    x-data
    x-init="$el.value = @js($url)"
    class="w-full border border-gray-300 bg-gray-100 px-3 py-2 rounded mb-4"
/>


        <button wire:click="copy"
                x-data @click="navigator.clipboard.writeText('{{ $url }}')"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Copy
        </button>

        @if ($copied)
            <div class="text-green-600 text-sm mt-2">Link successfully copied!</div>
        @endif

        <button wire:click="close"
                class="absolute top-2 right-2 text-gray-500 hover:text-black text-lg">×</button>
    </div>

    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.on('close-after-delay', () => {
                setTimeout(() => {
                    Livewire.dispatch('close');
                }, 3000);
            });
        });
    </script>
</div>
