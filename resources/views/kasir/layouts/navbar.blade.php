<nav class="bg-white shadow p-4 flex justify-between">
    <h1 class="text-xl font-semibold">Dashboard Admin</h1>
    <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="text-red-600 hover:underline">Logout</button>
    </form>

</nav>