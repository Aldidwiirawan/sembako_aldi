<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('laporan_keuntungan', function (Blueprint $table) {
        $table->id();
        $table->string('bulan'); // format: YYYY-MM
        $table->bigInteger('pendapatan_kotor')->default(0);
        $table->bigInteger('hpp')->default(0);
        $table->bigInteger('biaya_gaji')->default(0);
        $table->bigInteger('biaya_toko')->default(0);
        $table->bigInteger('biaya_urgent')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuntunga');
    }
};
