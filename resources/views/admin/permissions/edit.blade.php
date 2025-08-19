<x-layouts.admin>
    <div class="mb-4">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.permissions.index') }}">Permissions</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.permissions.update', $permission) }}">Edit
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST"
        class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4">
        @csrf
        @method('PUT')

        <flux:input name="name" label="Update name" value="{{ old('name', $permission->name) }}" />
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">Update</flux:button>
        </div>
    </form>
</x-layouts.admin>
