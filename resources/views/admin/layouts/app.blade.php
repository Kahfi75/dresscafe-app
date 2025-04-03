<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | DressCafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 h-full">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                <div class="flex items-center h-16 px-4 border-b border-gray-200">
                    <h1 class="text-xl font-bold text-primary-700">DressCafe</h1>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    @include('admin.layouts.sidebar')
                </div>
                <div class="px-4 py-4 border-t border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=0ea5e9&color=fff" alt="Admin">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">Admin</p>
                            <p class="text-xs font-medium text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile sidebar (hidden by default) -->
        <div class="md:hidden fixed inset-0 z-40" id="mobile-sidebar" style="display: none;">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="toggleMobileSidebar()"></div>
            <div class="relative flex flex-col w-72 max-w-xs h-full bg-white">
                <div class="flex items-center h-16 px-4 border-b border-gray-200">
                    <h1 class="text-xl font-bold text-primary-700">DressCafe</h1>
                    <button type="button" class="ml-auto p-2 rounded-md text-gray-500 hover:text-gray-600" onclick="toggleMobileSidebar()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    @include('admin.layouts.sidebar')
                </div>
                <div class="px-4 py-4 border-t border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=0ea5e9&color=fff" alt="Admin">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">Admin</p>
                            <p class="text-xs font-medium text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <div class="sticky top-0 z-10 bg-white border-b border-gray-200">
                <div class="flex items-center h-16 px-4">
                    <button type="button" class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-600" onclick="toggleMobileSidebar()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    @include('admin.layouts.navbar')
                </div>
            </div>

            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-4 py-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            if (sidebar.style.display === 'none' || !sidebar.style.display) {
                sidebar.style.display = 'block';
            } else {
                sidebar.style.display = 'none';
            }
        }
    </script>
</body>
</html>