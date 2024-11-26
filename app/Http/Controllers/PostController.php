<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::all();

        return response([
            "data" => $data,
            "status" => true
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();

        $post->title = $request->title;
        $post->description = $request->description;
        $post->user = auth()->user->id;
        $post->image_url = $request->image;
        $post->category_id = $request->category_id;
        $post->save();

        return response([
            "message" => "Post Added Successfully",
            "status" => true
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        return response([
            "data" => $post,
            "status" => true
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->description = $request->description;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        $post->delete();

        return response([
            "message" => "Post Deleted Successfully",
            "status" => true
        ],200);
    }
}
