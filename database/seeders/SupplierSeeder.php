<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            ['nama' => 'Sasuke Uchiha', 'alamat' => 'Konoha', 'telepon' => '081234567890'],
            ['nama' => 'Levi Ackerman', 'alamat' => 'Wall Sina', 'telepon' => '08999888777'],
            ['nama' => 'Roronoa Zoro', 'alamat' => 'East Blue', 'telepon' => '081122334455'],
            ['nama' => 'Kakashi Hatake', 'alamat' => 'Konoha', 'telepon' => '082233445566'],
            ['nama' => 'Gojou Satoru', 'alamat' => 'Tokyo Jujutsu High', 'telepon' => '087766554433'],
            ['nama' => 'Hinata Shoyo', 'alamat' => 'Karasuno', 'telepon' => '085544332211'],
            ['nama' => 'Itachi Uchiha', 'alamat' => 'Akatsuki Hideout', 'telepon' => '086655443322'],
            ['nama' => 'Eren Yeager', 'alamat' => 'Shiganshina District', 'telepon' => '088899776655'],
            ['nama' => 'Killua Zoldyck', 'alamat' => 'Zoldyck Estate', 'telepon' => '089977665544'],
            ['nama' => 'Saitama', 'alamat' => 'Z-City', 'telepon' => '081100220033'],
        ]);
    }
}
