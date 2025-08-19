<x-layouts.app>
    <flux:avatar :name="$post->user->name" class="mr-4" size='lg' circle />
    <h1>
        {{ $post->title }}
    </h1>

    <p> {{ $post->excerpt }} </p>
    <img class="h-72 w-full object-cover object-center" src="{{ $post->image }}" alt="">

</x-layouts.app>
