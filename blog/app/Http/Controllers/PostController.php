<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    
    
    public function create()
    {
        return view('posts.create');
    }

    public function index()
    {
        // $posts = $this->post->getAllPosts();
        //
        // return response()->json($posts);
        // $post = Post::all();
      // return response()->json($post);
      $user = Auth::user();
    if (!$user) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    // $posts = $user->posts()->latest()->get();
    $posts = Post::where('author_id', $user->id)->latest()->get();

    return response()->json($posts);


    }

    // public function store(Request $request)
    // {
    //     $post = $this->post->createPost($request->all());
    //
    //     return response()->json($post, 201);
    // }
    
    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'content' => 'required',
    ]);

    // Create a new post
    $post = new Post;
    $post->title = $validatedData['title'];
    $post->description = $validatedData['description'];
    $post->author_id = Auth::id();
    $post->content = $validatedData['content'];
    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}

    public function show($id)
    {
        // $post = $this->post->getPostById($id);
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // public function update(Request $request, $id)
    // {
    //   if (! Gate::allows('update-post', $post)) {
    //         abort(403);
    //   }
    //
    //   $post = $this->post->updatePost($id, $request->all());
    //   return response()->json($post);
    // }
    //

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user owns the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }

        return view('profile.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user owns the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.edit', $id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $this->post->deletePost($id);

        return response()->json(null, 204);
    }
}
