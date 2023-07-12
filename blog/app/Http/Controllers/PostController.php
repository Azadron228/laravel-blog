<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->getAllPosts();
        return response()->json($posts);
        // $post = Post::all();
        // return response()->json($post);
    }

    public function store(Request $request)
    {
        $post = $this->post->createPost($request->all());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = $this->post->getPostById($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
      if (! Gate::allows('update-post', $post)) {
            abort(403);
      }

      $post = $this->post->updatePost($id, $request->all());
      return response()->json($post);
    }

    public function destroy($id)
    {
        $this->post->deletePost($id);
        return response()->json(null, 204);
    }
}

