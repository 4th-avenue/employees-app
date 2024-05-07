<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <div class="flex">
        <sidebar />
    
        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>
</div>
