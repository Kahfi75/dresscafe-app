<?php

namespace App\Exports;

use App\Models\PengajuanBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanBarangExport implements FromCollection, WithHeadings
{
    // Mengambil data dari tabel pengajuan barang
    public function collection()
    {
        return PengajuanBarang::select('nama_pengaju', 'nama_barang', 'tanggal_pengajuan', 'qty', 'terpenuhi')->get();
    }

    // Menentukan header untuk file Excel
    public function headings(): array
    {
        return [
            'Nama Pengaju',
            'Nama Barang',
            'Tanggal Pengajuan',
            'Quantity',
            'Status Terpenuhi',
        ];
    }

    // Export data ke PDF
    public function exportPdf()
    {
        $data = $this->collection();
        $pdf = Pdf::loadView('pengajuan_barang.export-pdf', compact('data'));

        return $pdf->download('pengajuan_barang.pdf');
    }
}
