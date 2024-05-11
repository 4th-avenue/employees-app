<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h1 class="mb-4 font-semibold">Users Index</h1>
                        <div>
                            <Link href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New User</Link>
                        </div>
                    </div>
                    <x-splade-table :for="$users">
                        @cell('action', $user)
                        <Link href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-2 text-white bg-green-400 hover:bg-green-600 rounded-md">Edit</Link>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>