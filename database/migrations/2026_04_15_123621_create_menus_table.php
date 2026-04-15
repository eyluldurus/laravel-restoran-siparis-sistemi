<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
    $table->id();
    $table->string('ad'); 
    $table->text('aciklama')->nullable(); 
    $table->decimal('fiyat', 8, 2); 
    $table->string('resim')->nullable(); 
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
