<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null'); // Pelanggan opsional
            $table->dateTime('tanggal');
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('change_amount', 10, 2);
            $table->string('payment_method'); // cash, card, digital
            $table->enum('payment_status', ['Lunas', 'Tertunda'])->default('Lunas'); // Status pembayaran
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
