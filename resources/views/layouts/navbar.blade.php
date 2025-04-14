<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="px-4 py-3 flex justify-between items-center">
        <!-- Mobile menu button -->
        <div class="flex items-center md:hidden">
            <button id="sidebarToggle" class="text-gray-500 hover:text-gray-600">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>
        
        <!-- Search bar -->
        <div class="hidden md:block w-1/3">
            <div class="relative">
                <input type="text" placeholder="Search..." 
                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
        
        <!-- Right side items -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div class="relative">
                <button class="p-2 text-gray-500 hover:text-gray-600 relative">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="absolute top-0 right-0 h-3 w-3 rounded-full bg-red-500"></span>
                </button>
            </div>
            
            <!-- User dropdown -->
            <div class="relative">
                <button id="userDropdownButton" class="flex items-center space-x-2 focus:outline-none">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="hidden md:inline-block font-medium">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs hidden md:inline-block"></i>
                </button>
                
                <!-- Dropdown menu -->
                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    <div class="border-t border-gray-200"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    // Toggle user dropdown
    document.getElementById('userDropdownButton').addEventListener('click', function() {
        document.getElementById('userDropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userDropdownButton');
        
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });
</script>