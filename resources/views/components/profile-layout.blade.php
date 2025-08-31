@props(['user'])
<div class="max-w-3xl mx-auto">

    {{-- Mobile only header --}}
    <header class="items-center py-2 px-2 border-b lg:hidden grid grid-cols-12">
        {{-- cheveron from heroicons --}}
        <button onclick="history.back()" class="col-span-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>

        </button>

        {{--profile username --}}
        <div class="col-span-8 ">
            <h2 class="font-bold mx-auto truncate">
                {{$user->username}}
            </h2>
        </div>

        <span class="col-span-2 flex justify-end ">

            {{-- Guest options bututon --}}
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path
                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                </svg>
            </button>


        </span>


    </header>


    {{-- Details --}}
<!--    <section class="grid grid-cols-12 p-4 my-5 lg:my-12 ">-->
    <section class="grid grid-cols-12 p-2 my-5 lg:my-12 ">

        {{-- Avatar --}}
        <div class="col-span-4 flex items-center">
            <x-avatar
                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png' }}"
                alt="Profile picture"
                class="w-20 h-20 lg:w-44 lg:h-44 m-auto rounded-full"
                style="
        object-fit: cover;
        border: 4px solid transparent;
        background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) padding-box, white border-box;
        padding: 4px;
    " />

        </div>

        <aside class="col-span-8 lg:max-w-2xl lg:mx-auto">
            {{-- Actions --}}
            <section class="flex items-center space-x-4 flex-wrap">

                {{-- Korisničko ime --}}
                <span class="text-lg font-medium">
      {{ $user->username }}
    </span>

                @auth
                @if (auth()->id() == $user->id)
                {{-- Edit Registration --}}
                <a
                    href="{{ route('profile.urediprofil') }}"
                    type="button"
                    class="inline-flex items-center justify-center
                 px-4 py-2 bg-blue-600 hover:bg-blue-700
                 text-white font-bold rounded-lg transition"
                >
                    Edit Registration
                </a>

                {{-- Edit Profile --}}
                <a
                    href="{{ route('profile.edit') }}"
                    type="button"
                    class="inline-flex items-center justify-center
                 px-4 py-2 bg-blue-600 hover:bg-blue-700
                 text-white font-bold rounded-lg transition"
                >
                    Edit Profile
                </a>
                @else
                {{-- Follow / Following --}}
                @if (auth()->user()->isFollowing($user))
                <button
                    wire:click="toggleFollow()"
                    type="button"
                    class="inline-flex items-center justify-center
                   px-4 py-2 bg-gray-200 hover:bg-gray-300
                   text-gray-800 font-bold rounded-lg transition"
                >
                    Following
                </button>
                @else
                <button
                    wire:click="toggleFollow()"
                    type="button"
                    class="inline-flex items-center justify-center
                   px-4 py-2 bg-blue-600 hover:bg-blue-700
                   text-white font-bold rounded-lg transition"
                >
                    Follow
                </button>
                @endif

                {{-- Message --}}
<!--                <a-->
<!--                    href="{{ url('/chat') }}"-->
<!--                    class="inline-flex items-center justify-center-->
<!--                 px-4 py-2 bg-gray-200 hover:bg-gray-300-->
<!--                 text-gray-800 font-bold rounded-lg transition"-->
<!--                >-->
<!--                    Message-->
<!--                </a>-->
                @endif
                @endauth

            </section>

            {{-- Ostali podaci (posts, followers, itd.) --}}
            <div>
                <div class="grid grid-cols-3 w-full gap-2 mb-2 mt-[1rem]">
                    <span class="font-bold">{{ $user->posts_count ?? 0 }} Posts</span>
                    <span class="font-bold">{{ $user->followers_count ?? 0 }} Followers</span>
                    <span class="font-bold ml-[1.5rem]">{{ $user->following_count ?? 0 }} Following</span>

                </div>



                {{-- Debug prikaz relacija--}}
                <h2 class="font-bold mt-4">Debug info:</h2>
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Posts:</strong> {{ $user->posts_count ?? 0 }}</p>
                <p><strong>Followers:</strong> {{ $user->followers_count ?? 0 }}</p>
                <p><strong>Following:</strong> {{ $user->following_count ?? 0 }}</p>

                <h3 class="mt-4 font-semibold">Followers list:</h3>
                <ul>
                    @foreach($user->followers as $follower)
                    <li>{{ $follower->username }} (ID: {{ $follower->id }})</li>
                    @endforeach
                </ul>

                <h3 class="mt-4 font-semibold">Following list:</h3>
                <ul>
                    @foreach($user->following as $followed)
                    <li>{{ $followed->username }} (ID: {{ $followed->id }})</li>
                    @endforeach
                </ul>

            {{-- Profilni detalji --}}
            <div class="space-y-2 mt-4">
                <div class="flex">
                    <span class="w-40 font-semibold">Name & Surname:</span>
                    <span>{{ $user->name }} {{ $user->familyname }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-semibold">Date of Birth:</span>
                    <span>{{ $user->bio }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-semibold">E-Mail:</span>
                    <a href="mailto:{{ $user->email }}" class="text-blue-500 underline">
                        {{ $user->email }}
                    </a>
                </div>
                <div class="flex">
                    <span class="w-40 font-semibold">Web Site:</span>
                    <a href="{{ $user->website }}" target="_blank" class="text-blue-500 underline">
                        {{ $user->website }}
                    </a>
                </div>
                <div class="flex">
                    <span class="w-40 font-semibold">Phone Number:</span>
                    <span>{{ $user->phone }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-semibold">Interested in:</span>
                    <span>{{ $user->interested }}</span>
                </div>
            </div>
        </aside>

    </section>


    {{-- Tabs --}}
    <section class="border-t">
        <ul class="grid grid-cols-3 gap-4 max-w-sm mx-auto pb-3 ">
            {{-- Posts --}}
            <li class="flex items-center gap-2 py-2 cursor-pointer  {{request()->routeIs('profile.home')?'border-t border-black':''}}">
                {{-- border icon from bootsrap icons --}}
                <a wire:navigate class="flex items-center gap-2 py-2 cursor-pointer"
                    href="{{route('profile.home',$user->username)}}">

                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-border-all lg:w-5 lg:h-5" viewBox="0 0 16 16">
                            <path
                                d="M0 0h16v16H0V0zm1 1v6.5h6.5V1H1zm7.5 0v6.5H15V1H8.5zM15 8.5H8.5V15H15V8.5zM7.5 15V8.5H1V15h6.5z" />
                        </svg>
                    </span>

                    <h4 class="font-bold capitalize">Posts</h4>

                </a>

            </li>

            {{-- reels --}}
            <li class="flex items-center gap-2 py-2 cursor-pointer {{request()->routeIs('profile.reels')?'border-t border-black':''}} ">
                {{-- border icon from bootsrap icons --}}

                <a wire:navigate class="flex items-center gap-2 py-2 cursor-pointer"
                    href="{{route('profile.reels',$user->username)}}">


                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" id="instagram-reel">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M1 6.5A5.5 5.5 0 0 1 6.5 1h11A5.5 5.5 0 0 1 23 6.5v11a5.5 5.5 0 0 1-5.5 5.5h-11A5.5 5.5 0 0 1 1 17.5v-11ZM6.5 3A3.5 3.5 0 0 0 3 6.5v11A3.5 3.5 0 0 0 6.5 21h11a3.5 3.5 0 0 0 3.5-3.5v-11A3.5 3.5 0 0 0 17.5 3h-11Z"
                                clip-rule="evenodd"></path>
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M9.038 10.113a1 1 0 0 1 1.035.068l5 3.5a1 1 0 0 1 0 1.638l-5 3.5A1 1 0 0 1 8.5 18v-7a1 1 0 0 1 .538-.887zm1.462 2.808v3.158l2.256-1.579-2.256-1.58zM1 8a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H2a1 1 0 0 1-1-1z"
                                clip-rule="evenodd"></path>
                            <path fill="#000" fill-rule="evenodd"
                                d="M7.684 1.051a1 1 0 0 1 1.265.633l2 6a1 1 0 0 1-1.897.632l-2-6a1 1 0 0 1 .632-1.265zm6 0a1 1 0 0 1 1.265.633l2 6a1 1 0 0 1-1.897.632l-2-6a1 1 0 0 1 .632-1.265z"
                                clip-rule="evenodd"></path>
                        </svg>

                    </span>

                    <h4 class="font-bold capitalize">Reels</h4>
                </a>
            </li>

            @auth
            @if ( auth()->user()->id==$user->id)

            {{-- Saved --}}
            <li class="flex items-center gap-2 py-2 cursor-pointer {{request()->routeIs('profile.saved')?'border-t border-black':''}}">
                {{-- Tag icon from bootsrap icons --}}

                <a wire:navigate class="flex items-center gap-2 py-2 cursor-pointer"
                    href="{{route('profile.saved',$user->username)}}">

                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bookmark lg:w-5 lg:h-5" viewBox="0 0 16 16">
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                        </svg>
                    </span>

                    <h4 class="font-bold capitalize">Saved</h4>

                </a>

            </li>
            @endif
            @endauth
        </ul>


    </section>


    <main class="my-7">
        {{$slot}}
    </main>

</div>
