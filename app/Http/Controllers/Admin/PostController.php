<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function update(PostRequest $request, Post $post)
    {

        //* Obtenemos los datos de la solucitud que se validaron en el PostRequest.
        $data = $request->validated();

        //*Verificamos si la request contiene un archivo en su campo image.
        if ($request->hasFile('image')) {
            if ($post->image_path) {
                //* Si el post ya tiene una imagen, la eliminamos del disco.
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = Storage::disk('public')->put('posts', $data['image']);
        }

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
