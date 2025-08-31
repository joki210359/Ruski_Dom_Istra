
<div x-data="{
  canLoadMore: @entangle('canLoadMore')
}" @scroll.window.throttle="{
  const scrollTop = window.scrollY || window.scrollTop;
  const divHeight = window.innerHeight || document.documentElement.clientHeight;
  const scrollHeight = document.documentElement.scrollHeight;

  const isScrolled = scrollTop + divHeight >= scrollHeight - 1;
  canLoadMore = window.innerWidth > 768 ? @entangle('canLoadMore') : false;
  if (isScrolled && canLoadMore) {
    @this.loadMore();
  }
}" class="w-full h-full">

  {{-- Header --}}
  <header class="md:hidden sticky top-0 z-50 bg-white">
    <div class="grid grid-cols-12 gap-2 items-center">
      <div class="col-span-3 flex items-center">
        @auth
        <img src="{{ asset('assets/RDI.png') }}" class="h-10 w-auto ml-2" alt="RDI.log" style="display: block;">
        @endauth
      </div>

      <div class="col-span-8 flex justify-center px-2">
        <input type="text" placeholder="Search" class="border-0 outline-none w-full focus:outline-none bg-gray-100 rounded-lg focus:ring-0 hover:ring-0">
      </div>

      <div class="col-span-1 flex justify-center">
        <a href="#">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
          </span>
        </a>
      </div>
    </div>
  </header>

  {{-- Main --}}
  <main class="grid lg:grid-cols-12 gap-8 md:mt-10">



    <aside class="lg:col-span-8 overflow-hidden">
      {{-- Stories --}}
      <section>
        <ul class="flex overflow-x-auto scrollbar-hide items-center ml-12 gap-[0.12rem]">
          @foreach ($posts->take(10) as $post) {{-- Get only the first 10 posts --}}
          <div class="post flex items-center space-x-4">
            <li class="flex flex-col justify-center w-29 gap-1 p-2">
              <x-avatar
                src="{{ $post->user && $post->user->avatar ? asset('storage/avatars/' . basename($post->user->avatar)) : asset('storage/avatars/default.png') }}"
                alt="{{ $post->user ? $post->user->name : 'Unknown' }}"
                class="ml-6 w-10 h-10 rounded-full" />
              <p class="font-semibold truncate text-sm">
                {{ $post->user ? $post->user->name : 'Unknown' }} {{ $post->user ? $post->user->familyname : '' }}
              </p>
              <p class="mt-2">{{ $post->content }}</p>
            </li>
          </div>
          <!-- <p class="mt-2">{{ $post->content }}</p> -->
          @endforeach
        </ul>
      </section>

      {{-- Posts --}}
      <section class="mt-5 space-y-4 p-2">
        @if ($posts)
        @foreach ($posts as $post)
        <livewire:post.item wire:key="post-{{$post->id}}" :post="$post" />
        @endforeach
        @else
        <p class="font-bold text-center">No posts</p>
        @endif
      </section>
    </aside>

    {{-- Suggestions --}}
    <aside class="lg:col-span-4 hidden lg:block p-4">
        @php
        $recommendedUser = \App\Models\User::where('id', '!=', Auth::id()) // isključujemo prijavljenog
        ->where('interested', Auth::user()->interested) // isti interes
        ->first(); // uzimamo prvog korisnika koji zadovoljava uvjet
        @endphp

        @if($recommendedUser)


      <div class="flex items-center gap-2">
        <x-avatar
          src="{{ $recommendedUser->avatar ? asset('storage/avatars/' . basename($recommendedUser->avatar)) : asset('storage/avatars/default.png') }}"
          alt="{{ $recommendedUser->name }}"
          class="w-20 h-20 rounded-full" />
        <h3 class="font-semibold truncate text-lg">
          {{ $recommendedUser->name }} {{ $recommendedUser->familyname }}
        </h3>
      </div>
        @else
        <p>There are no recommended users.</p>
      @endif



      {{-- Suggestions --}}
      <section class="mt-4">
        <h4 class="font-bold text-gray-700/95">Suggestions for you</h4>
        <ul class="my-2 space-y-3">
          @foreach ($suggestedUsers as $user)
          <li class="flex items-center gap-3">
            <a href="{{ route('profile.home', $user->username) }}">
              <x-avatar
                src="{{ $user->avatar ? asset('storage/avatars/' . basename($user->avatar)) : asset('storage/avatars/default.png') }}"
                alt="{{ $user->name }}"
                class="w-10 h-10 rounded-full" />
            </a>
            <div class="grid grid-cols-7 w-full gap-2">
              <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm">
                  {{ $user->name }} {{ $user->familyname }}
                </h5>
              </div>
              <div class="col-span-2 flex justify-end">
                @if (auth()->user()->isFollowing($user))
                <button wire:click="toggleFollow({{ $user->id }})" class="font-bold text-blue-500 ml-auto text-sm">Following</button>
                @else
                <button wire:click="toggleFollow({{ $user->id }})" class="font-bold text-blue-500 ml-auto text-sm">Follow</button>
                @endif
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </section>

      {{-- App Links --}}
      <section class="mt-10">
        <ol class="flex gap-2 flex-wrap">
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">About</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Help</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">API</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Jobs</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Privacy</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Terms</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Locations</a></li>
        </ol>
        <h3 class="text-gray-800/90 mt-6 text-sm">© 2023 INSTAGRAM COURSE</h3>
      </section>
    </aside>
  </main>
    <img id="background" class="absolute -bottom-0 right-[-5px] max-w-[520px] pointer-events-none"

         src="{{asset('assets/home_svgimage.svg')}}"/>
</div>
