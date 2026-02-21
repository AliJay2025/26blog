@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary">
                    &larr; Back to Posts
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Main Post Content -->
            <div class="card mb-4">
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $post->title }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <small>
                                By <strong>{{ $post->user->name }}</strong> | 
                                {{ $post->created_at->format('F j, Y \a\t g:i a') }}
                                @if($post->created_at != $post->updated_at)
                                    <span class="ms-2">(Updated: {{ $post->updated_at->format('M d, Y') }})</span>
                                @endif
                            </small>
                        </div>
                        @can('update', $post)
                            <div>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <div class="card-text">
                        {!! nl2br(e($post->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 mb-0">Comments</h3>
                </div>
                <div class="card-body">
                    @auth
                        <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" rows="3" class="form-control" placeholder="Add a comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>
                    @else
                        <p class="mb-4">
                            <a href="{{ route('login') }}">Login</a> to comment.
                        </p>
                    @endauth

                    @forelse($post->comments()->latest()->get() as $comment)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $comment->user->name }}</strong>
                                <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2 mb-2">{{ $comment->content }}</p>
                            
                            @can('delete', $comment)
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="mt-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Delete this comment?')">Delete</button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection