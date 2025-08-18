<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //* Verificamos si el usuario está autenticado.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $post = $this->route('post');

        return [
            'image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            //* Si published_at es null, slug es requerido, de lo contrario no lo es. Además, debe ser único excepto para el post actual.
            'slug' => 'required_if:published_at,null|string|max:255|unique:posts,slug,' .  ($post ? $post->id : 'NULL'),
            'category_id' => 'required|exists:categories,id',
            //* Si is_published es 1, excerpt es requerido.
            'excerpt' => 'required_if:is_published,1|string',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
        ];
    }
}
