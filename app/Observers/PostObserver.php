<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{

    //*Creating
    //*created

    //*Este método se va a ejecutar cuando se trate de actualizar un registro de un módelo Post.
    //*Este se ejecutara cuando se dispare este método en el controlador $post->update($data) pero antes de que actualize el registro en la bd.
    //*Lo mismo aplica para los demas métodos de este observador (creating, etc).
    public function updating(Post $post)
    {
        //*Verifica que is_published sea false y published_at sea null
        if ($post->is_published && !$post->published_at) {
            $post->published_at = now();
        }
    }

    //*updated

    //*deleting
    //*deleted
}
