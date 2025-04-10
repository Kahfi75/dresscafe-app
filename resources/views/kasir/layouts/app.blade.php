<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kasir | Aplikasi POS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
<body class="bg-gray-100 text-gray-800 font-sans">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col p-4">
      <!-- Branding -->
      <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-2 mb-6 text-xl font-semibold text-white hover:text-primary-400 transition">
        <i class="bi bi-cash-stack"></i>
        <span>Kasir POS</span>
      </a>

      <!-- Navigation -->
      <nav class="flex-1 space-y-1">
        <a href="{{ route('kasir.dashboard') }}"
           class="flex items-center px-3 py-2 rounded-md transition 
           {{ request()->routeIs('kasir.dashboard') ? 'bg-primary-600 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
          <i class="bi bi-house-door mr-2"></i> Dashboard
        </a>

        <a href="{{ route('orders.index') }}"
           class="flex items-center px-3 py-2 rounded-md transition 
           {{ request()->routeIs('orders.*') ? 'bg-primary-600 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
          <i class="bi bi-receipt mr-2"></i> Pesanan
        </a>

        <a href="{{ route('sales.index') }}"
           class="flex items-center px-3 py-2 rounded-md transition 
           {{ request()->routeIs('sales.*') ? 'bg-primary-600 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
          <i class="bi bi-cart-check mr-2"></i> Penjualan
        </a>
      </nav>

      <!-- Footer -->
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

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </main>
  </div>

</body>
</html>
