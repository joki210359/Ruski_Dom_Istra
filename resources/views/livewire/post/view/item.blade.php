

    {{-- vezana je sa app\Livewire\Post\View\Item.php --}}

<div class="grid lg:grid-cols-12 gap-3 h-full w-full overflow-hidden">

    <aside class=" hidden lg:flex lg:col-span-7 m-auto items-center w-full overflow-scroll">


        {{-- Css snap scroll --}}
        <div
            class="relative flex overflow-x-scroll overscroll-contain w-[500px] selection:snap-x snap-mandatory gap-2 px-2">


            @foreach ($post->media as $key =>$file)

            <div class="w-full h-full shrink-0 snap-always snap-center">

                @switch($file->mime)
                @case('video')

                <x-video source="{{$file->url}}" />

                @break
                @case('image')

                <img src="{{$file->url}}" alt="image" class="h-full w-full block object-scale-down">

                @break
                @default

                @endswitch

            </div>

            @endforeach



        </div>

    </aside>

    <aside class="lg:col-span-5 h-full scrollbar-hide relative flex gap-4 flex-col overflow-hidden overflow-y-scroll">

        <header class="flex  items-center gap-3 border-b py-2  sticky  top-0 bg-white z-10 ">

            <x-avatar wire:ignore story src="{{ asset('storage/' . $post->user->avatar) }}" class="h-9 w-9" />

            <div class="grid grid-cols-7 w-full gap-2">

                <div class="col-span-5">
                    <h5 class="font-semibold truncate text-sm">{{$post->user->username}} </h5>
                </div>

                <div class="flex col-span-2 text-right justify-end">
                    <button @click="$dispatch('close')" class="text-gray-500 ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>


            </div>

        </header>

        <main>

            @if ($comments)

            @foreach ($comments as $comment)

            <section class="flex flex-col gap-2">

                {{-- main comment --}}
                @include('livewire.post.view.partials.comment')

                @if ($comment->replies)

                @foreach ($comment->replies as $reply )

                {{-- Reply --}}
                @include('livewire.post.view.partials.reply')
                @endforeach

                @endif


            </section>
            @endforeach

            @else

            No comments

            @endif
        </main>

        {{-- footer --}}
        <footer class="mt-auto sticky border-t bottom-0 z-10 bg-white">

            {{-- actions --}}
            <div class="flex gap-4 items-center my-2">

                {{-- heart --}}
                @if ($post->isLikedBy(auth()->user()))
{{--                  <button wire:click='togglePostLike()'> 

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-rose-500">
                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                    </svg>
                </button> --}}

                @else
                <button wire:click='togglePostLike()'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>

                </button>
                @endif

                @if ($post->allow_commenting)

                {{-- comment --}}
                
{{--                  <span> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>

                </span> --}}
                @endif

                {{-- forward --}}
{{--              <button 
                onclick="sharePost(@js(route('post.view', $post->id)))"
                class="hover:text-blue-500 text-gray-700 dark:text-gray-300 transition-colors duration-200"
                title="Podijeli objavu"
                aria-label="Podijeli objavu">

                <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                    <title>Share</title>
                    <line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2" x1="22" x2="9.218" y1="3" y2="10.083"></line>
                    <polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334"
                        stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon>
                </svg>
            </button> --}}

{{--                          <script> 
                function sharePost(url) {
                    if (navigator.share) {
                        navigator.share({
                            title: 'Pogledaj ovu objavu!',
                            url: url
                        }).catch(err => console.error('Dijeljenje nije uspjelo:', err));
                    } else {
                        navigator.clipboard.writeText(url).then(() => {
                            alert('Link je kopiran!');
                        }).catch(() => {
                            alert('Kopiranje linka nije uspjelo.');
                        });
                    }
                }
            </script> --}}

            {{-- Bookmark/favorites
            <span class="ml-auto">
                <button wire:click='toggleFavorite()'>
                    
                    @if ($post->hasBeenFavoritedBy(auth()->user()))
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-label="Save"
                        class="w-6 h-6" color="green">
                        <title>Remove</title>
                        <path fill-rule="evenodd"
                            d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <svg aria-label="Save" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-6 h-6" color="blue">
                        <title>Save</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>
                    @endif
                </button>
            </span> --}}

            </div>

            {{-- likes and views --}}
            @if ($post->totalLikers>0 && !$post->hide_like_view)
            <p class="font-bold text-sm">{{$post->totalLikers}} {{$post->totalLikers>1? 'likes':'like'}}</p>
            @endif

            {{-- name and comment --}}
            <div class="flex text-sm gap-2 font-medium">
                <p> <strong class="font-bold">{{$post->user->name}} </strong>
                    {{$post->description}}
                </p>
            </div>

            @if ($post->allow_commenting)

            {{-- view post modal --}}
            <button
                class="text-slate-500/90 text-sm font-medium"> Total {{$post->comments->count()}} comments
            </button>

            {{-- leave comment --}}
            <form
                wire:key="{{time()}}"
                x-data="{body:@entangle('body')}"
                @submit.prevent="$wire.addComment()"
                class="grid grid-cols-12 items-center w-full">
                @csrf

                <input x-model="body" type="text" placeholder=" Leave a comment "
                    class="border-0 col-span-10 placeholder:text-sm outline-none focus:outline-none px-0 rounded-lg hover:ring-0 focus:ring-0">


                {{-- <span class="col-span-1 ml-auto"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                    </svg>
                </span> --}}

                <!-- Emoji dugme + picker -->
                <div class="col-span-1 relative flex justify-end" x-data="{ showPicker: false }">
                    <button type="button" @click="showPicker = !showPicker"
                        class="p-1 rounded-md hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>
                    </button>

                    <!-- Emoji picker -->
                    <emoji-picker
                        x-show="showPicker"
                        x-transition
                        class="absolute bottom-full right-0 z-50"
                        @emoji-click="(e) => { body += e.detail.unicode; showPicker = false; }">
                    </emoji-picker>
                </div>
                <div class="col-span-1 ml-2rem flex justify-end text-right">
                    <button type="submit" x-cloak x-show="body.length >0"
                        class="text-sm font-semibold flex justify-end text-blue-500">
                        Post
                    </button>
                </div>


            </form>
{{--              <form 
                wire:key="{{ time() }}"
                @submit.prevent="$wire.addComment()"
                x-data="{ body: @entangle('body').defer || '', showPicker: false }"
                class="grid grid-cols-12 gap-2 items-center w-full">
                @csrf

                <!-- Input polje -->
                <input x-model="body" type="text" placeholder="Leave a comment"
                    class="col-span-9 text-sm border-0 outline-none focus:ring-0 rounded-lg">

                <!-- Emoji dugme + picker -->
                <div class="col-span-2 relative flex justify-end">
                    <button type="button" @click="showPicker = !showPicker"
                        class="p-2 rounded-md hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>
                    </button>

                    <!-- Emoji picker -->
                    <emoji-picker
                        x-show="showPicker"
                        x-transition
                        class="absolute bottom-full right-0 z-50"
                        @emoji-click="(e) => { body += e.detail.unicode; showPicker = false; }"></emoji-picker>
                </div>

                <!-- Submit dugme -->
                <div class="col-span-1 flex justify-end">
                    <button type="submit" x-cloak x-show="body.length > 0"
                        class="text-sm font-semibold text-blue-500">
                        Post
                    </button>
                </div>
            </form> --}}

            @endif

        </footer>







    </aside>

</div>