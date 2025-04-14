<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::latest()->get();
        return view('pengeluaran.index', compact('data'));
    }

    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Pengeluaran::findOrFail($id);
        return view('pengeluaran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengeluaran' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->all());

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pengeluaran::destroy($id);
        return back()->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}
