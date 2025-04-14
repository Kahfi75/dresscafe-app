<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Schema;

class GenericImport implements ToCollection
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function collection(Collection $rows)
    {
        // Pastikan tabel ada di database
        if (!Schema::hasTable($this->table)) {
            return; // Jika tabel tidak ada, keluar
        }

        // Ambil header dari baris pertama (nama kolom)
        $heading = $rows->first()->toArray();

        // Ambil kolom yang ada di tabel
        $columns = Schema::getColumnListing($this->table);

        // Pastikan kolom Excel sesuai dengan kolom di tabel
        $validColumns = array_intersect($columns, $heading);
        
        if (count($validColumns) === 0) {
            return; // Jika tidak ada kolom yang valid, keluar
        }

        // Inisialisasi array untuk menampung data
        $data = [];

        // Skip baris pertama yang digunakan sebagai header
        foreach ($rows->skip(1) as $row) {
            // Hanya ambil data yang sesuai dengan kolom yang ada di tabel
            $rowData = array_combine($heading, $row->toArray());

            // Pastikan hanya data dengan kolom yang valid yang dimasukkan
            $filteredData = array_intersect_key($rowData, array_flip($validColumns));

            $data[] = $filteredData;
        }

        // Insert data ke tabel yang sesuai
        if (!empty($data)) {
            DB::table($this->table)->insert($data);
        }
    }
}
