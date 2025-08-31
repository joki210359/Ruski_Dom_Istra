<div
    x-data="{ visible: true, closing: false }"
    x-show="visible"
    x-transition:enter="transition-opacity duration-1000"
    x-transition:enter-start="opacity-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-1000"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-20"
    x-init="
    window.addEventListener('reportSubmitted', () => {
        console.log('✅ Event received: reportSubmitted');

        setTimeout(() => {
            closing = true;

            setTimeout(() => {
                visible = false;
                window.dispatchEvent(new CustomEvent('close'));
                console.log('✅ Modal closed after 5 seconds');

                // Redirect na početnu stranicu
                window.location.href = '/';
            }, 1000); // trajanje fade-out animacije
        }, 2000); // čekanje 2 sekunde pre zatvaranja
    });
"

    class="p-4">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Report a post</h2>

    <form wire:submit.prevent="sendApplicationMethod" class="bg-white rounded-lg shadow-none">
        @if ($flashMessage)
        <div class="mb-4 px-4 py-3 rounded relative
                {{ $flashMessageType === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}"
            role="alert">
            {{ $flashMessage }}
        </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Why are you reporting this post?</label>
            <div class="space-y-2">
                @foreach([
                "I just don't like it",
                "Bullying or unwanted contact",
                "Suicide, self-injury or eating disorders",
                "Violence, hate or exploitation",
                "Selling or promoting restricted items",
                "Nudity or sexual activity",
                "Scam, fraud or spam",
                "False information",
                "Report as unlawful"
                ] as $option)
                <label class="flex items-center space-x-3">
                    <input type="radio" wire:model.defer="reason" value="{{ $option }}" class="form-radio text-red-600">
                    <span class="text-gray-700">{{ $option }}</span>
                </label>
                @endforeach
            </div>
            @error('reason') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
            <input type="text" id="name" wire:model.defer="name"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
            <input type="email" id="email" wire:model.defer="email"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            @error('email') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Send Feedback
            </button>
        </div>
    </form>
</div>