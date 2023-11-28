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
        Schema::create('rembes_items', function (Blueprint $table) {
            $table->id();

            $table->string('nama_rembes');
            $table->decimal('nominal', 10, 2);
            $table->date('tanggal_rembes');
            $table->longText('deskripsi')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rembes_items');
    }
};
