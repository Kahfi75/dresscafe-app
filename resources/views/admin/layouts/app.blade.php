<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        @include('admin.layouts.sidebar')

        <div class="flex-1 min-h-screen">
            @include('admin.layouts.navbar')

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
