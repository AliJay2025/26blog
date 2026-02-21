<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        $post->comments()->save($comment);

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Authorization check - only the comment owner can delete
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }
        
        $comment->delete();
        
        return back()->with('success', 'Comment deleted successfully!');
    }
}