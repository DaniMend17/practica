<x-layouts.admin>
    <div class="mb-4">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">New</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{ route('admin.posts.store') }}", method="POST"
        class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4">
        @csrf

        <flux:input name="title" label="Post title" value="{{ old('title') }}"
            oninput="string_to_slug(this.value, '#slug')" />
        <flux:input name="slug" id="slug" label="Post slug" value="{{ old('slug') }}" />



        <flux:select name="category_id" label="Post categories" placeholder="Choose category...">
            @foreach ($categories as $category)
                <flux:select.option value="{{ $category->id }}" :selected="$category->id == old('category_id')">
                    {{ $category->name }}
                </flux:select.option>
            @endforeach
        </flux:select>

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">Create</flux:button>
        </div>
    </form>

    {{-- Código js para crear un slug --}}
    {{-- @push('js')
        <script>
            function string_to_slug(str, querySelector) {
                // Eliminar espacios al inicio y final
                str = str.replace(/^\s+|\s+$/g, '');

                // Convertir todo a minúsculas
                str = str.toLowerCase();

                // Definir caracteres especiales y sus reemplazos
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to = "aaaaeeeeiiiioooouuuunc------";

                // Reemplazar caracteres especiales por los correspondientes en 'to'
                for (var i = 0, l = from.length; i < l; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                // Eliminar caracteres no alfanuméricos y reemplazar espacios por guiones
                str = str.replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

                // Asignar el slug generado al campo de entrada correspondiente
                document.querySelector(querySelector).value = str;
            }
        </script>
    @endpush --}}


</x-layouts.admin>
