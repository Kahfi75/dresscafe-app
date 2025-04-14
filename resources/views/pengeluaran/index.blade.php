<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengeluaran POS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

  <!-- Header & Tombol -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-700">Daftar Pengeluaran</h1>
    <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
      + Tambah Pengeluaran
    </button>
  </div>

  <!-- Notifikasi -->
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    Data pengeluaran berhasil ditambahkan!
  </div>

  <!-- Tabel -->
  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-6 py-3 text-left font-semibold text-blue-700">Nama</th>
          <th class="px-6 py-3 text-left font-semibold text-blue-700">Jumlah</th>
          <th class="px-6 py-3 text-left font-semibold text-blue-700">Tanggal</th>
          <th class="px-6 py-3 text-left font-semibold text-blue-700">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <tr class="hover:bg-blue-50">
          <td class="px-6 py-4">Beli Gas LPG</td>
          <td class="px-6 py-4">Rp 150.000</td>
          <td class="px-6 py-4">10-04-2025</td>
          <td class="px-6 py-4 flex gap-2">
            <a href="#" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow">Edit</a>
            <button onclick="confirm('Hapus data ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">Hapus</button>
          </td>
        </tr>
        <tr class="hover:bg-blue-50">
          <td class="px-6 py-4">Servis Blender</td>
          <td class="px-6 py-4">Rp 80.000</td>
          <td class="px-6 py-4">09-04-2025</td>
          <td class="px-6 py-4 flex gap-2">
            <a href="#" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow">Edit</a>
            <button onclick="confirm('Hapus data ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH -->
<div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold text-blue-700">Tambah Pengeluaran</h2>
      <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
    </div>
    <form action="#" method="POST">
      <div class="mb-4">
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pengeluaran</label>
        <input type="text" name="nama" id="nama" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"/>
      </div>
      <div class="mb-4">
        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
        <input type="number" name="jumlah" id="jumlah" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"/>
      </div>
      <div class="mb-4">
        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"/>
      </div>
      <div class="flex justify-end">
        <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- JS untuk modal -->
<script>
  function openModal() {
    document.getElementById('modal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
  }
</script>

</body>
</html>
