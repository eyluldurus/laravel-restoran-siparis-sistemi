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
        Schema::create('siparis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masa_id');
            $table->decimal('toplam_tutar', 8, 2)->default(0);
            $table->string('durum')->default('Bekliyor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siparis');
    }
};
