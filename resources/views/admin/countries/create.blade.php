<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4 font-semibold">New Country</h1>
                    <x-splade-form :action="route('admin.countries.store')">
                        <x-splade-input name="name" label="Name" />
                        <x-splade-input name="country_code" label="Country code" class="mt-2" />
                        <x-splade-submit class="mt-4" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>