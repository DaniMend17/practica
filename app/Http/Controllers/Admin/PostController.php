<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest('id')->paginate();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
        ]);

        //* Agregamos el ID del usuario autenticado con el guard de autenticación web.
        $data['user_id'] = auth('web')->id();

        $post = Post::create($data);

        //*Creamos una variable de sesión para mostrar un mensaje de exito.
        session()->flash('swal', [
            'title' => 'Post creado',
            'text' => 'El post se ha creado correctamente.',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            //*Excerpt unicamente es requerido cuando el valor de published es 1.
            'excerpt' => 'required_if:is_published,1|string',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            //*Tags son opcionales, pero si se envían deben ser válidos.
            // 'tags' => 'array'
        ]);

        // $data['tags'] = ['Programación', 'Desarrollo Web', 'Laravel'];
        // foreach ($data['tags'] as $tag) {
        //     //*Busca si se encuentra el registro y si existe lo crea.
        //     Tag::firstOrCreate(['name' => $tag]);
        // }



        // $post->update($request->all());
        $post->update($data);

        session()->flash('swal', [
            'title' => 'Post actualizado',
            'text' => 'El post se ha actualizado correctamente.',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
