@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-3">Welcome to my 26Blog</h1>
        <p class="lead text-muted mx-auto" style="max-width: 600px;">
            A simple blogging website. Write posts, interact with readers, and build your community.
        </p>
        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg px-4 me-2">Browse Blog</a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">Get Started</a>
            @endguest
        </div>
    </div>

    <!-- Latest Posts Preview -->
    @php
        $latestPosts = \App\Models\Post::latest()->take(3)->get();
    @endphp
    
    @if($latestPosts->count() > 0)
        <div class="mt-5 pt-4">
            <h2 class="text-center fw-bold mb-4">Latest from the Blog</h2>
            <div class="row">
                @foreach($latestPosts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
    				<a href="{{ route('posts.show', $post) }}" style="color: #dc2626 !important; text-decoration: none;">
        			{{ $post->title }}
    				</a>
				</h5>
                                <p class="card-text text-muted small">By {{ $post->user->name }} | {{ $post->created_at->format('M d, Y') }}</p>
                                <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('posts.index') }}" class="btn btn-link">View All Posts →</a>
            </div>
        </div>
    @endif
</div>
@endsection