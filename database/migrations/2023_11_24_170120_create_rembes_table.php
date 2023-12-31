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
        Schema::create('rembes', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete('SET NULL')->cascadeOnUpdate('CASCADE');
            $table->foreignId('category_tahun_id')->constrained('category_tahuns')->cascadeOnDelete('SET NULL')->cascadeOnUpdate('CASCADE');
            $table->date('tanggal_ticket');
            $table->enum('status', ['PENDING', 'APPROVED', 'SUCCESS', 'REJECTED'])->default('PENDING');
            $table->longText('remarks')->nullable();
            $table->text('description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rembes');
    }
};
