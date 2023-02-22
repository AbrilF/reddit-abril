<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        //return $posts to json response
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->extracto = $request->extracto;
        $post->contenido = $request->contenido;
        $post->caducable = $request->caducable;
        $post->comentable = $request->comentable;
        $post->acceso = $request->acceso;
        $post->save();
        $data = [
            'message' => 'Post creado correctamente',
            'post' => $post
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->titulo = $request->titulo;
        $post->extracto = $request->extracto;
        $post->contenido = $request->contenido;
        $post->caducable = $request->caducable;
        $post->comentable = $request->comentable;
        $post->acceso = $request->acceso;
        $post->save();
        $data = [
            'message' => 'Post actualizado correctamente',
            'post' => $post
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $data = [
            'message' => 'Post eliminado correctamente',
            'post' => $post
        ];
        return response()->json($data);
    }
}
