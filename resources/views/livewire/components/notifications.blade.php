<div
    x-init="
Echo.private('users.{{ auth()->id() }}')
    .notification((notification) => {
        @this.$refresh();
    });"
    class="w-full p-3">

    <h3 class="font-bold ml-[-1.3rem] text-3xl">
        <!-- Notifications -->
          {{ __('notification.Notifications') }}
    </h3>

    <main class="my-7 w-full">
        <div class="space-y-5">
            @foreach ($notifications as $notification)
            @switch($notification->type)

            @case('App\Notifications\NewFollowerNotification')
            @php
            $user = \App\Models\User::find($notification->data['user_id']);
            @endphp

            @if($user)
            <div class="grid grid-cols-12 gap-2 w-full">


                <div class="col-span-7 font-medium">
                    <a href="{{ route('profile.home', $user->username) }}"> <strong>{{ $user->name }}</strong> </a>
                    Started Following you
                    <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                </div>

                <div class="col-span-3">
                    @if (auth()->user()->isFollowing($user))
                    <button wire:click="toggleFollow({{ $user->id }})" class="font-bold text-sm bg-gray-100 text-black/90 px-3 py-1 rounded-lg">Following</button>
                    @else
                    <button wire:click="toggleFollow({{ $user->id }})" class="font-bold text-sm bg-blue-500 text-white px-3 py-1 rounded-lg">Follow</button>
                    @endif
                </div>
            </div>
            @endif
            @break

            @case('App\Notifications\PostLikedNotification')
            @php
            $user = \App\Models\User::find($notification->data['user_id']);
            $post = \App\Models\Post::find($notification->data['post_id']);
            @endphp

            @if($user && $post)
            <div class="grid grid-cols-12 gap-2 w-full">
                <a href="{{ route('profile.home', $user->username) }}" class="col-span-2">
                    <x-avatar
                        class="w-10 h-10 rounded-full"
                        style="border: 2px solid transparent; border-radius: 9999px; background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box; background-clip: border-box; box-decoration-break: clone;"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) . '?' . rand(0,10) : asset('assets/default.png') }}" />
                </a>

                <div class="col-span-7 font-medium">
                    <a href="{{ route('profile.home', $user->username) }}">
                        <strong>{{ $user->name }}</strong>
                    </a>
                    <div>
                        <a href="{{ route('post', $post->id) }}">
                            Liked your post
                            <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('post', $post->id) }}" class="col-span-3 ml-auto">
                    @php
                    $cover = $post->media->first();
                    @endphp

                    @if($cover)
                    @switch($cover->mime)
                    @case('video')
                    <div class="h-11 w-10">
                        <x-video :controls="false" source="{{ $cover->url }}" />
                    </div>
                    @break

                    @case('image')
                    <img src="{{ $cover->url }}" alt="image" class="h-11 w-10 object-cover">
                    @break
                    @endswitch
                    @endif
                </a>
            </div>
            @endif
            @break

            @case('App\Notifications\NewCommentNotification')
            @php
            $user = \App\Models\User::find($notification->data['user_id']);
            $comment = \App\Models\Comment::find($notification->data['comment_id']);
            @endphp

            @if($user && $comment && $comment->commentable)
            <div class="grid grid-cols-12 gap-2 w-full">
                <x-avatar
                    class="w-10 h-10 rounded-full"
                    style="border: 2px solid transparent; border-radius: 9999px; background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet) border-box; background-clip: border-box; box-decoration-break: clone;"
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) . '?' . rand(0,10) : asset('assets/default.png') }}" />

                <div class="col-span-7 font-medium ml-8">
                    <a href="{{ route('profile.home', $user->username) }}">
                        <strong>{{ $user->name }}</strong>
                    </a>
                    <a href="{{ route('post', $comment->commentable->id) }}" class="block">
                        <span class="font-semibold">Commented:</span>
                        <div class="mt-1 text-sm text-gray-800">{{ $comment->body }}</div>
                        <span class="text-gray-400 text-xs block mt-1">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                    </a>
                </div>

                <a href="{{ route('post', $comment->commentable->id) }}" class="col-span-3 ml-auto">
                    @php
                    $cover = $comment->commentable?->media->first();
                    @endphp

                    @if($cover)
                    @switch($cover->mime)
                    @case('video')
                    <div class="h-11 w-10">
                        <x-video :controls="false" source="{{ $cover->url }}" />
                    </div>
                    @break

                    @case('image')
                    <img src="{{ $cover->url }}" alt="image" class="h-11 w-10 object-cover">
                    @break
                    @endswitch
                    @endif
                </a>
            </div>
            @endif
            @break

            @endswitch
            @endforeach
        </div>
    </main>
</div>