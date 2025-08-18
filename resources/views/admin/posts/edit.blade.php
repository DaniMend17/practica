<x-layouts.admin>
    <div class="mb-4">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="relative mb-4">
            <img src="{{ $post->image_path
                ? Storage::url($post->image_path)
                : 'https://cdn.wuxiaworld.eu/original/noimagefound_PxUD0gM.jpg' }}"
                class="w-full aspect-video object-cover object-center" id="imgPreview">



            <div class="absolute ">
                <label class="bg-black px-4 py-2 rounded-lg cursor-pointer">
                    Change image
                    <input name="image" accept="image/*" class="hidden" type="file"
                        onchange="preview_image(event, '#imgPreview')">
                </label>
            </div>
        </div>

        <div class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4">
            <flux:input name="title" label="Post title" value="{{ old('title', $post->title) }}"
                oninput="string_to_slug(this.value, '#slug')" />

            {{-- Este campo unicamente se mostrará si publised_at es null --}}
            @if (!$post->published_at)
                <flux:input name="slug" id="slug" label="Post slug" value="{{ old('slug', $post->slug) }}" />
            @endif

            <flux:textarea name="excerpt" label="Update excerpt">{{ old('excerpt', $post->excerpt) }}</flux:textarea>

            <flux:select name="category_id" label="Post categories" placeholder="Choose category...">
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}"
                        :selected="$category->id == old('category_id', $post->category_id)">
                        {{ $category->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:textarea rows="16" name="content" label="Update content">{{ old('content', $post->content) }}
            </flux:textarea>

            <div>
                <p class="text-sm font-semibold">Estado</p>
                <label class="ml-2">
                    <input type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1) />
                    Publicado
                </label>

                <label class="ml-2">
                    <input type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0) />
                    No publicado
                </label>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Update</flux:button>
            </div>
        </div>

    </form>
</x-layouts.admin>
