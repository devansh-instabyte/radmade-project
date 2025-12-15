<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for dropdown submenu -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    @stack('styles')
  

</head>

@php
use App\Models\Settings;
$setting = Settings::first();
@endphp

<body class="min-h-screen flex bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-gray-100 min-h-screen p-6">

       <img src="{{asset('storage/' . $setting->flogo)}}" alt="Logo" class="h-12 w-auto mb-6">

        <nav class="space-y-2">
            
        
            <!-- Dashboard Link -->
            <a href="{{route('admin.dashboard')}}"
                class="block px-4 py-2  hover:bg-gray-800 border-b border-gray-300">
                Dashboard
            </a>

            <!-- Pages Dropdown -->
            <div x-data="{ open: false }" class="space-y-1">
                <button 
                    @click="open = !open"
                    class="w-full flex justify-between items-center px-4 py-2  hover:bg-gray-800 border-b border-gray-300">
                    <span>Pages</span>
                    <span x-show="!open">+</span>
                    <span x-show="open">-</span>
                </button>

                <div x-show="open" class="pl-6 space-y-1 border-b border-gray-300">
                    <a href="{{route('admin.addpage')}}" class="block py-1 hover:text-white border-b border-gray-300">Add Page</a>
                    <a href="{{route('admin.pages.index')}}" class="block py-1 hover:text-white border-b border-gray-300">View Pages</a>
                </div>
            </div>

            <!-- Menus Dropdown -->
            <div x-data="{ open: false }" class="space-y-1">
                <button 
                    @click="open = !open"
                    class="w-full flex justify-between items-center px-4 py-2  hover:bg-gray-800 border-b border-gray-300">
                    <span>Menus</span>
                    <span x-show="!open">+</span>
                    <span x-show="open">-</span>
                </button>

                <div x-show="open" class="pl-6 space-y-1">
                    <a href="" class="block py-1 hover:text-white border-b border-gray-300">Add Menu</a>
                    <a href="" class="block py-1 hover:text-white border-b border-gray-300">View Menus</a>
                </div>
            </div>

            <!-- Settings -->
            <a href="{{route('admin.settings')}}" class="block px-4 py-2  hover:bg-gray-800 border-b border-gray-300">
                Settings
            </a>

             <!-- Settings -->
            <a href="{{route('admin.logout')}}" class="block px-4 py-2  hover:bg-gray-800 border-b border-gray-300">
                Logout 
            </a>

        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">

        <!-- TopBar -->
       <header class="bg-white p-4 rounded shadow mb-6 flex justify-between items-center">
        <h1 class="text-xl font-semibold">@yield('title')</h1>
        <div>Welcome, {{Session::get('name')}}!</div>
    </header>

       
       

        <section>
            @yield('content')
        </section>

    </main>


<script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
@stack('scripts')
</script>

</body>
</html>
