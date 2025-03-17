<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - DressCafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Category Name</label>
                <input type="text" name="name" value="{{ $category->name }}" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Update</button>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</a>
        </form>
    </div>

</body>
</html>
