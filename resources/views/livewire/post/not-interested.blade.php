<div class="p-4"
    x-data="{ open: @entangle('showSuccessPopup'), visible: true, closing: false }"
    x-init="
        window.addEventListener('close-modal-with-delay', () => {
            setTimeout(() => {
                closing = true;

                setTimeout(() => {
                    visible = false;
                    window.dispatchEvent(new CustomEvent('close'));
                    console.log('✅ Modal closed after 5 seconds');

                    window.location.href = '/';
                }, 1000);
            }, 3000);
        });
    ">
    <h2 class="text-lg font-semibold mb-4">Not interested?</h2>
    <p class="mb-4 text-gray-600">Mark this post as 'Not interested'.</p>

    <div class="flex justify-end space-x-2">
        <button wire:click="markNotInterested"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Confirm
        </button>

        <button @click="$dispatch('close')"
            class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </button>
    </div>

    <!-- Ispravljen prikaz s x-show -->
    <div
        x-show="open"
        x-transition:enter="transition duration-700 ease-out transform"
        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"

        x-transition:leave="transition transform duration-700 ease-in transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-4"
        x-transition:leave-end="opacity-20 scale-90 translate-y-0"

        {{--x-transition:enter="transition-opacity duration-1000"
        x-transition:enter-start="opacity-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-20" --}}


        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30">
        <div class="w-30 bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl text-lg font-semibold">
            Successfully Confirmed ✅
        </div>
    </div>
</div>