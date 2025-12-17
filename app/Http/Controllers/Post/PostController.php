<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts =  Post::all();


        $posts = Cache::put('posts:all', $posts );

    }

    public function show(string $id)
    {
        $post = Cache::get("post:{$id}");
        dd($post);
    }

    public function store()
    {
       $post = Post::factory()->create();

       Cache::put("post:{$post->id}", $post);

       return Cache::get("post:{$post->id}");
    }
}
