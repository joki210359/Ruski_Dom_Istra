@extends('layouts.app') {{-- ili layout koji koristiš --}}

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $post->title ?? 'Naslov objave' }}</h1>

    <p class="mb-4">{{ $post->content ?? 'Sadržaj objave' }}</p>

    <a href="{{ route('posts.index') }}" class="text-blue-500">← Povratak na sve objave</a>
</div>
@endsection

