<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4 font-semibold">New User</h1>
                    <x-splade-form :action="route('admin.users.store')">
                        <x-splade-input name="username" label="Username" />
                        <x-splade-input name="first_name" label="First name" class="mt-2" />
                        <x-splade-input name="last_name" label="Last name" class="mt-2" />
                        <x-splade-input name="email" label="Email address" class="mt-2" />
                        <x-splade-input type="password" name="password" label="Password" class="mt-2" />
                        <x-splade-input type="password" name="password_confirmation" label="Password Confirmation" class="mt-2" />
                        <x-splade-submit class="mt-4" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>