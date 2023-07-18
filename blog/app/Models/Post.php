<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image',
    ];

    public function getAllPosts()
    {
      $posts = Post::with('author')->get();
      

      $data = $posts->map(function ($post) {
          return [
              'id' => $post->id,
              'title' => $post->title,
              'content' => $post->content,
              'user_id' => $post->user->name,
          ];
      });

      return $data;
    }
  //
  //   public function getPostById($id)
  //   {       
  //     $post = $this->with('author')->find($id);
  //    
  //     return [
  //     'id' => $post->id,
  //     'title' => $post->title,
  //     'content' => $post->content,
  //     'author_name' => $post->author->name,
  //     ];
  //   }
  //
  //   public function createPost($data)
  //   {
  //       return $this->create($data);
  //   }
  //
  //   public function updatePost($id, $data)
  //   {
  //     if (! Gate::allows('update-post', $post)) {
  //           abort(403);
  //     }
  // 
  //     $item = $this->findOrFail($id);
  //     $item->update($data);
  //     return $item;
  //   }
  //
  //   public function deletePost($id)
  //   {
  //       $item = $this->findOrFail($id);
  //       $item->delete();
  //   }
  //
    /*  Database Relationshpis */


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
