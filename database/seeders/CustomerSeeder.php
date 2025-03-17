<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->truncate(); // Hapus data lama agar tidak duplikasi

        $customers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 10, Jakarta'
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'phone' => '081298765432',
                'address' => 'Jl. Ahmad Yani No. 23, Bandung'
            ],
            [
                'name' => 'Andi Saputra',
                'email' => 'andi@example.com',
                'phone' => '081377788899',
                'address' => 'Jl. Merdeka No. 45, Surabaya'
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
