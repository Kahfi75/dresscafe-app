<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanBarang;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanBarangExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanBarangController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanBarang::all();
        return view('pengajuan_barang.index', compact('pengajuan'));
    }

    public function getData()
    {
        $pengajuan = PengajuanBarang::select('id', 'nama_pengaju', 'nama_barang', 'tanggal_pengajuan', 'qty', 'terpenuhi');

        return DataTables::of($pengajuan)
            ->addColumn('terpenuhi', function ($item) {
                return $item->terpenuhi ? '✅ Terpenuhi' : '❌ Belum Terpenuhi';
            })
            ->addColumn('action', function ($item) {
                return '
                    <a href="' . route('pengajuan_barang.edit', $item->id) . '" class="btn btn-sm btn-warning">Edit</a>
                    <form action="' . route('pengajuan_barang.destroy', $item->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'qty' => 'required|integer',
        ]);

        PengajuanBarang::create([
            'nama_pengaju' => $request->nama_pengaju,
            'nama_barang' => $request->nama_barang,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'qty' => $request->qty,
            'terpenuhi' => $request->has('terpenuhi') ? 1 : 0,
        ]);

        return redirect()->route('pengajuan_barang.index')->with('success', 'Data pengajuan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengajuanBarang = PengajuanBarang::findOrFail($id);
        return view('pengajuan_barang.edit', compact('pengajuanBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'qty' => 'required|integer',
        ]);

        $pengajuanBarang = PengajuanBarang::findOrFail($id);
        $pengajuanBarang->update([
            'nama_pengaju' => $request->nama_pengaju,
            'nama_barang' => $request->nama_barang,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'qty' => $request->qty,
            'terpenuhi' => $request->has('terpenuhi') ? 1 : 0,
        ]);

        return redirect()->route('pengajuan_barang.index')->with('success', 'Data pengajuan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengajuanBarang = PengajuanBarang::findOrFail($id);
        $pengajuanBarang->delete();

        return redirect()->route('pengajuan_barang.index')->with('success', 'Data pengajuan berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new PengajuanBarangExport, 'pengajuan_barang.xlsx');
    }

    public function exportPdf()
    {
        // Ambil data dari tabel pengajuan_barang
        $pengajuan = PengajuanBarang::select('nama_pengaju', 'nama_barang', 'tanggal_pengajuan', 'qty', 'terpenuhi')
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        // Kirim data ke view exports.pdf dan buat file PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.pdf', ['data' => $pengajuan]);

        return $pdf->download('laporan_pengajuan_barang.pdf');
    }



    public function updateStatus($id)
    {
        $pengajuan = PengajuanBarang::findOrFail($id);
        $pengajuan->terpenuhi = !$pengajuan->terpenuhi;
        $pengajuan->save();

        return redirect()->route('pengajuan_barang.index')->with('success', 'Status berhasil diperbarui');
    }
}
