<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4 font-semibold">New Role</h1>
                    <x-splade-form :action="route('admin.roles.store')">
                        <x-splade-input name="name" label="Name" />
                        <x-splade-select name="permissions[]" label="Permissions" :options="$permissions" multiple relation choices class="mt-4" />
                        <x-splade-submit class="mt-4" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>