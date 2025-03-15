<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDarkMode = html.classList.toggle('dark');
            localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
            document.getElementById('theme-icon').textContent = isDarkMode ? '🌙' : '🌞';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const isDarkMode = localStorage.getItem('darkMode') === 'enabled';
            if (isDarkMode) {
                document.documentElement.classList.add('dark');
                document.getElementById('theme-icon').textContent = '🌙';
            } else {
                document.getElementById('theme-icon').textContent = '🌞';
            }
        });
    </script>
    <style>
        body {
            transition: background 0.3s, color 0.3s;
        }

        .dark body {
            background: linear-gradient(to right, #0f172a, #1e293b);
            color: white;
        }

        body {
            background: linear-gradient(to right, #f3f4f6, #e5e7eb);
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: background 0.3s, color 0.3s;
        }

        .dark .card {
            background: #1e293b;
            color: white;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="flex items-center justify-center h-screen transition-colors">
    <!-- Tombol Mode Gelap -->
    <button onclick="toggleDarkMode()" class="absolute top-4 right-4 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-black dark:text-white rounded transition">
        <span id="theme-icon">🌞</span>
    </button>

    <div class="card">
        <h3 class="text-center text-2xl font-semibold mb-4">Login</h3>

        <!-- Pesan Error -->
        @if (session('error'))
        <div class="mb-4 px-4 py-2 bg-red-500 text-white rounded text-center">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 dark:text-gray-300 mt-4">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 dark:text-blue-300 hover:underline">Daftar</a>
        </p>
    </div>
</body>

</html>
