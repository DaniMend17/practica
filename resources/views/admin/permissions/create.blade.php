<x-layouts.admin>
    <div class="mb-4">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.permissions.index') }}">Permissions</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Create</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form action="{{ route('admin.permissions.store') }}", method="POST"
        class="bg-black px-6 py-8 rounded-lg shadow-lg space-y-4">
        @csrf
        <flux:input name="name" label="Permission name" value="{{ old('name') }}" />
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">Create</flux:button>
        </div>
    </form>

</x-layouts.admin>
