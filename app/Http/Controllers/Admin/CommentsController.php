<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    function admin_get(string $post_id)
    {
        $post = Post::findOrFail($post_id);
        $comments = Comment::where('post_id', $post->id)->orderBy('id', 'DESC')->paginate(setting('PAGINATION_ADMIN'));

        $data = [
            'comments' => $comments,
        ];

        return view('admin.pages.post.comments', $data);
    }
}
