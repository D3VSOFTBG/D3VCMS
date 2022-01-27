<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    function admin_get()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(setting('PAGINATION_ADMIN'));

        $data = [
            'posts' => $posts,
        ];

        return view('admin.pages.posts', $data);
    }
    function admin_delete(Request $request)
    {
        Post::findOrFail($request->id)->delete();
        return back();
    }
    function admin_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'text' => 'required',
        ]);

        $post = new Post();
        $post->name = $request->name;
        $post->text = $request->text;
        $post->save();

        return back();
    }
    function admin_edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'text' => 'required',
        ]);

        $post = Post::findOrFail($request->id);
        $post->name = $request->name;
        $post->text = $request->text;
        $post->save();

        return back();
    }
}
