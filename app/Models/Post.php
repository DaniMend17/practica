<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

//*Asignamos el observador PostObserver al modelo Post.
#[ObservedBy(PostObserver::class)]
class Post extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'excerpt',
        'content',
        'is_published',
        'published_at',
        'category_id',
        'user_id',
    ];

    //*Usamos casts para convertir is_published a booleano y published_at a instancia date-time para poder manejar la inserción masiva.
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    //*Route model binding
    //*L
    public function getRouteKeyName()
    {
        return 'slug';
    }


    //*Creamos un accesor para obtener la URL de la imagen.
    //*Usamos el método Storage::url() para obtener la URL de la imagen almacenada.
    //*Si la imagen no existe, se devuelve una URL de imagen por defecto.
    //*Recordar que lo que estamos haciendo aquí es CREAR UN NUEVO ATRIBUTO EN EL MÓDELO,
    //*POR TANTO SI QUEREMOS ACCESAR A ESTE LO HACEMOS DE LA SIGUIENTE MANERA $post->image
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image_path ? Storage::url($this->image_path) : 'https://cdn.wuxiaworld.eu/original/noimagefound_PxUD0gM.jpg',
        );
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
