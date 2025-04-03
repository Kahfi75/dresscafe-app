<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DressCafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            900: '#1a365d',
                            800: '#2a4365',
                            700: '#2c5282',
                        }
                    }
                }
            }
        }
        
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("-translate-x-full");
        }
    </script>
</head>

<body class="bg-gray-50 flex font-sans">

    <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-gradient-to-b from-primary-900 to-primary-700 text-white h-screen flex flex-col p-5 fixed transition-transform duration-300 transform -translate-x-full md:translate-x-0 shadow-xl">
        <h2 class="text-2xl font-bold text-center mb-8 pt-2">DressCafe</h2>
        <nav class="flex flex-col gap-2 flex-1">
            <a href="{{ route('dashboard') }}" class="px-4 py-2.5 rounded-lg bg-primary-800 hover:bg-primary-600 transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
            <div class="relative">
                <button onclick="document.getElementById('orderDropdown').classList.toggle('hidden')" class="w-full px-4 py-2.5 rounded-lg hover:bg-primary-600 flex justify-between items-center transition-colors duration-200">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Orders
                    </div>
                    <span>▼</span>
                </button>
                <div id="orderDropdown" class="hidden flex flex-col bg-primary-800 rounded-lg mt-1 ml-2 pl-4 border-l-2 border-primary-600">
                    <a href="{{ route('orders.index', ['status' => 'Pending']) }}" class="px-4 py-2 hover:bg-primary-600 rounded transition-colors duration-200">New Orders</a>
                    <a href="#" class="px-4 py-2 hover:bg-primary-600 rounded transition-colors duration-200">Completed Orders</a>
                </div>
            </div>
            <a href="#" class="px-4 py-2.5 rounded-lg hover:bg-primary-600 transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Payments
            </a>
            <a href="{{ route('menus.index') }}" class="px-4 py-2.5 rounded-lg hover:bg-primary-600 transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Menus
            </a>
            <a href="#" class="px-4 py-2.5 rounded-lg hover:bg-primary-600 transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
            </a>
            <a href="#" class="px-4 py-2.5 rounded-lg bg-red-600 hover:bg-red-500 mt-auto text-center transition-colors duration-200 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </a>
        </nav>
    </div>

    <!-- Content -->
    <div class="w-full md:ml-64 p-6">
        <button onclick="toggleSidebar()" class="md:hidden bg-primary-800 text-white px-4 py-2 rounded-lg mb-6 flex items-center gap-2 shadow-sm hover:shadow-md transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            Menu
        </button>

        <h1 class="text-3xl font-semibold mb-8 text-gray-800">Dashboard Overview</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Orders -->
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Total Orders</p>
                        <p class="text-2xl font-bold mt-1 text-gray-800">{{ $totalOrder }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-3"><span class="text-green-500 font-medium">↑ 12%</span> from last month</p>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Total Revenue</p>
                        <p class="text-2xl font-bold mt-1 text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-3"><span class="text-green-500 font-medium">↑ 23%</span> from last month</p>
            </div>

            <!-- Total Customers -->
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Total Customers</p>
                        <p class="text-2xl font-bold mt-1 text-gray-800">125</p>
                    </div>
                    <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-3"><span class="text-green-500 font-medium">↑ 8%</span> from last month</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Top 5 Menu -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 md:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Top 5 Menu</h2>
                    <a href="#" class="text-sm text-primary-700 hover:text-primary-900 font-medium">View All</a>
                </div>
                <ul class="space-y-3">
                    @foreach($topMenu as $menu)
                    <li class="flex justify-between items-center bg-gray-50 hover:bg-gray-100 text-gray-800 p-3 rounded-lg transition-colors duration-200">
                        <div class="flex items-center gap-3">
                            <span class="font-medium text-gray-700">{{ $loop->iteration }}.</span>
                            <span>{{ $menu->name }}</span>
                        </div>
                        <span class="bg-primary-100 text-primary-800 px-3 py-1 rounded-full text-sm font-medium">{{ $menu->total_sold }} sold</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-2 w-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">New order #1234 received</p>
                            <p class="text-xs text-gray-500">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-2 w-2 bg-green-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Payment received for order #1228</p>
                            <p class="text-xs text-gray-500">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-2 w-2 bg-yellow-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Low stock alert for "Matcha Latte"</p>
                            <p class="text-xs text-gray-500">3 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-2 w-2 bg-purple-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">New customer registered</p>
                            <p class="text-xs text-gray-500">5 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Sales Overview</h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-sm bg-primary-100 text-primary-800 rounded-lg">Week</button>
                    <button class="px-3 py-1 text-sm bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200">Month</button>
                    <button class="px-3 py-1 text-sm bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200">Year</button>
                </div>
            </div>
            <div class="w-full h-64 bg-gray-50 flex items-center justify-center rounded-xl border border-gray-200">
                <p class="text-gray-400">Chart will be displayed here</p>
            </div>
        </div>
    </div>

</body>

</html>