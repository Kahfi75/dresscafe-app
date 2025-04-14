@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#f0fdfd] min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-[#006d77]">Manajemen Pembelian</h1>

    <!-- Button Tambah -->
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')" 
            class="bg-[#00a8b5] hover:bg-[#00838f] text-white px-4 py-2 rounded-lg mb-6 transition-colors flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Pembelian
    </button>

    <!-- Tabel Pembelian -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-[#e0f7fa]">
        <table class="min-w-full">
            <thead class="bg-[#00b4d8] text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Tanggal</th>
                    <th class="py-3 px-4 text-left">Supplier</th>
                    <th class="py-3 px-4 text-left">Total Harga</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e0f7fa]">
                @foreach ($pembelians as $p)
                <tr class="hover:bg-[#f0fdfd] transition-colors">
                    <td class="py-3 px-4">{{ $p->tanggal }}</td>
                    <td class="py-3 px-4">{{ $p->supplier->nama }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td class="py-3 px-4">
                        <form action="{{ route('pembelian.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-[#ef476f] hover:bg-[#d43d63] text-white px-3 py-1 rounded-lg transition-colors">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="modal-tambah" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-xl border border-[#e0f7fa] overflow-hidden">
        <div class="bg-[#00b4d8] text-white p-4">
            <h2 class="text-xl font-bold flex items-center">
                <i class="fas fa-cart-plus mr-2"></i> Tambah Pembelian
            </h2>
        </div>
        
        <form action="{{ route('pembelian.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-[#006d77] mb-1">Supplier</label>
                    <select name="supplier_id" class="w-full border border-[#b2ebf2] rounded-lg p-2 focus:ring-2 focus:ring-[#00b4d8] focus:border-transparent">
                        @foreach ($suppliers as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-[#006d77] mb-1">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border border-[#b2ebf2] rounded-lg p-2 focus:ring-2 focus:ring-[#00b4d8] focus:border-transparent" required>
                </div>
                
                <div class="border-t border-[#e0f7fa] pt-4">
                    <h3 class="text-[#006d77] font-semibold mb-3">Item Pembelian</h3>
                    <div id="item-container" class="space-y-3">
                        <div class="grid grid-cols-12 gap-3 items-center item-row">
                            <div class="col-span-5">
                                <select name="items[0][menu_id]" class="w-full border border-[#b2ebf2] rounded-lg p-2">
                                    @foreach ($menus as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="items[0][jumlah]" placeholder="Jumlah" 
                                       class="w-full border border-[#b2ebf2] rounded-lg p-2" required>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="items[0][harga_beli]" placeholder="Harga Beli" 
                                       class="w-full border border-[#b2ebf2] rounded-lg p-2" required>
                            </div>
                            <div class="col-span-1">
                                <button type="button" onclick="hapusItem(this)" 
                                        class="w-full bg-[#ef476f] hover:bg-[#d43d63] text-white p-2 rounded-lg transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="tambahItem()" 
                            class="mt-3 bg-[#48cae4] hover:bg-[#00b4d8] text-white px-3 py-1 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-plus mr-1"></i> Tambah Item
                    </button>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-[#e0f7fa]">
                <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')" 
                        class="bg-[#adb5bd] hover:bg-[#6c757d] text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <button type="submit" 
                        class="bg-[#00b4d8] hover:bg-[#0096c7] text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let itemIndex = 1;
function tambahItem() {
    const container = document.getElementById('item-container');
    const div = document.createElement('div');
    div.classList.add('grid', 'grid-cols-12', 'gap-3', 'items-center', 'item-row');
    div.innerHTML = `
        <div class="col-span-5">
            <select name="items[${itemIndex}][menu_id]" class="w-full border border-[#b2ebf2] rounded-lg p-2">
                @foreach ($menus as $m)
                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-3">
            <input type="number" name="items[${itemIndex}][jumlah]" placeholder="Jumlah" 
                   class="w-full border border-[#b2ebf2] rounded-lg p-2" required>
        </div>
        <div class="col-span-3">
            <input type="number" name="items[${itemIndex}][harga_beli]" placeholder="Harga Beli" 
                   class="w-full border border-[#b2ebf2] rounded-lg p-2" required>
        </div>
        <div class="col-span-1">
            <button type="button" onclick="hapusItem(this)" 
                    class="w-full bg-[#ef476f] hover:bg-[#d43d63] text-white p-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
    itemIndex++;
}

function hapusItem(btn) {
    btn.closest('.item-row').remove();
}
</script>

<style>
    /* Custom scrollbar for modal */
    #item-container {
        max-height: 300px;
        overflow-y: auto;
    }
    #item-container::-webkit-scrollbar {
        width: 6px;
    }
    #item-container::-webkit-scrollbar-thumb {
        background-color: #00b4d8;
        border-radius: 3px;
    }
</style>
@endsection