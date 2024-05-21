<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h1 class="mb-4 font-semibold">Permissions Index</h1>
                        <div>
                            <Link href="{{ route('admin.permissions.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New Permission</Link>
                        </div>
                    </div>
                    <x-splade-table :for="$permissions">
                        @cell('action', $permission)
                        <div class="space-x-2">
                            <Link href="{{ route('admin.permissions.edit', $permission->id) }}" class="text-green-400 hover:text-green-600 font-semibold">Edit</Link>
                            <Link confirm="이 권한을 삭제하시겠습니까?" confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No" href="{{ route('admin.permissions.destroy', $permission->id) }}" method="DELETE" class="text-red-400 hover:text-red-600 font-semibold">Delete</Link>
                        </div>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>