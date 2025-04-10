<aside class="w-64 bg-gray-900 text-white flex flex-col p-4">
  <!-- Branding -->
  <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-2 mb-6 text-xl font-semibold text-white hover:text-primary-400 transition">
    <i class="bi bi-cash-stack"></i>
    <span>Kasir POS</span>
  </a>

  <!-- Navigation -->
  <nav class="flex-1 space-y-1">
    <ul class="flex flex-col space-y-1">
      <li>
        <a href="{{ route('kasir.dashboard') }}" 
           class="flex items-center px-3 py-2 rounded-md transition 
           {{ request()->routeIs('kasir.dashboard') ? 'bg-primary-600 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
          <i class="bi bi-house-door mr-2"></i> Dashboard
        </a>
      </li>
      
      <li>
        <a href="{{ route('orders.index') }}" 
           class="flex items-center px-3 py-2 rounded-md transition 
           {{ request()->routeIs('orders.*') ? 'bg-primary-600 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
          <i class="bi bi-receipt mr-2"></i> Pesanan
        </a>
      </li>
      
      <li>
        <a href="#" 
           class="flex items-center px-3 py-2 rounded-md transition hover:bg-gray-700 text-gray-300">
          <i class="bi bi-box-seam mr-2"></i> Produk
        </a>
      </li>
      
      <li>
        <a href="#" 
           class="flex items-center px-3 py-2 rounded-md transition hover:bg-gray-700 text-gray-300">
          <i class="bi bi-people mr-2"></i> Pelanggan
        </a>
      </li>
      
      <li>
        <a href="{{ route('sales.index') }}" 
           class="flex items-center px-3 py-2 rounded-md transition 
           {{ request()->routeIs('sales.*') ? 'bg-primary-600 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
          <i class="bi bi-cart-check mr-2"></i> Penjualan
        </a>
      </li>
    </ul>
  </nav>

  <!-- Footer with User Profile -->
  <div class="mt-auto pt-4 border-t border-gray-700">
    <div class="flex items-center space-x-3">
      <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
           alt="Avatar {{ Auth::user()->name }}"
           class="w-10 h-10 rounded-full object-cover ring-2 ring-primary-500">
      <div>
        <p class="font-medium text-sm">{{ Auth::user()->name }}</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-1">
          @csrf
          <button type="submit" class="text-xs text-gray-400 hover:text-red-400 hover:underline transition">Keluar</button>
        </form>
      </div>
    </div>
  </div>
</aside>