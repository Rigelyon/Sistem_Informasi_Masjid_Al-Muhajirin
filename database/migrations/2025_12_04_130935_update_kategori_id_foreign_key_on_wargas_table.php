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
        Schema::table('wargas', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['kategori_id']);

            // Add the new foreign key referencing the 'kategoris' table
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['kategori_id']);

            // Restore the old foreign key referencing 'kategori_bayar_zakats'
            $table->foreign('kategori_id')->references('id')->on('kategori_bayar_zakats')->onDelete('set null');
        });
    }
};
