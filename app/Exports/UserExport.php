<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data pengguna untuk diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data pengguna dan map ke format yang diinginkan
        return User::all()->map(function ($user) {
            return [
                'name' => $user->name,  // Nama pengguna
                'email' => $user->email, // Email pengguna
                // Tambahkan kolom lain sesuai kebutuhan
            ];
        });
    }

    /**
     * Menentukan headings untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',  // Heading untuk kolom nama
            'Email', // Heading untuk kolom email
            // Tambahkan headings lain sesuai kolom yang ada
        ];
    }
}
