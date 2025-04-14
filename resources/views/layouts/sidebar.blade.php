<aside id="sidebar" class="w-64 bg-white border-r border-gray-200 fixed h-full transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-50">
    <div class="p-4 border-b border-gray-200">
        <h1 class="text-xl font-semibold text-gray-800">
            <i class="fas fa-utensils mr-2 text-blue-500"></i>
            Resto POS
        </h1>
    </div>
    
    <div class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-tachometer-alt mr-3 text-gray-500"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}" class="flex items-center p-2 text-white rounded-lg bg-blue-500">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    <span>Order Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('menu.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-utensils mr-3 text-gray-500"></i>
                    <span>Menu Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customers.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-users mr-3 text-gray-500"></i>
                    <span>Customer Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reports.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-chart-bar mr-3 text-gray-500"></i>
                    <span>Reports</span>
                </a>
            </li>
            
            <!-- Divider -->
            <li class="border-t border-gray-200 my-2"></li>
            
            <li>
                <a href="{{ route('settings.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-cog mr-3 text-gray-500"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Sidebar footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center">
            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Toggle sidebar
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
    });

    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    });
</script>