<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

//* Agregamos la interfaz HasMiddleware para poder usar el método middleware.
// class CategoryController extends Controller implements HasMiddleware
class CategoryController extends Controller
{

    //*Usamos el método middleware para poder aplicar el middleware IsAdmin a las rutas de este controlador.
    //*El middleware IsAdmin se aplica unicamente a las rutas index y edit.
    // public static function middleware()
    // {
    //     return [new Middleware(
    //         'admin',
    //         //* Excluimos las rutas create, store, show, update y destroy del middleware IsAdmin.
    //         // except: ['create', 'store', 'show', 'update', 'destroy'],
    //         //* Solo aplicamos el middleware IsAdmin a las rutas index y edit.
    //         only: ['index', 'edit',]
    //     )];
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        //*Creamos una variable de sesión para mostrar un mensaje de exito.
        session()->flash('swal', [
            'title' => 'Categoría creada',
            'text' => 'La categoría se ha creado correctamente.',
            'icon' => 'success'
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //*Valida que el nombre del registro sea unico en la tabla categories pero que me excluya el nombre del registro actual.
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        //*Creamos una variable de sesión para mostrar un mensaje de exito.
        session()->flash('swal', [
            'title' => 'Categoría actualizada',
            'text' => 'La categoría se ha actualizado correctamente.',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        //*Creamos una variable de sesión para mostrar un mensaje de exito.
        session()->flash('swal', [
            'title' => 'Categoría eliminada',
            'text' => 'La categoría se ha eliminado correctamente.',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.categories.index');
    }
}
