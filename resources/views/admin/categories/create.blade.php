<x-layouts.admin>
    <div class="mb-4">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.categories.index') }}">Categories</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">New</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{ route('admin.categories.store') }}", method="POST"
        class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4">
        @csrf
        <flux:input name="name" label="Category name" value="{{ old('name') }}" />
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">Create</flux:button>
        </div>
    </form>
</x-layouts.admin>
