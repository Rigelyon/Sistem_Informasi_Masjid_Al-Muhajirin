<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Added this use statement for DB facade

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Clean up existing test data (except Users)
        Schema::disableForeignKeyConstraints();
        DB::table('bayar_zakats')->truncate();
        DB::table('distribusi_zakats')->truncate();
        DB::table('wargas')->truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Fix Wargas Foreign Key (Point to kategoris instead of kategori_bayar_zakats)
        Schema::table('wargas', function (Blueprint $table) {
            // Drop old foreign key if it exists (name might vary, so we use array syntax)
            $table->dropForeign(['kategori_id']);
            
            // Re-add foreign key pointing to 'kategoris'
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
        });

        // 3. Add warga_id to bayar_zakats
        Schema::table('bayar_zakats', function (Blueprint $table) {
            $table->unsignedBigInteger('warga_id')->nullable()->after('id');
            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
            
            // Make these nullable since we might create the record before filling them
            $table->string('nama_KK')->nullable()->change();
            $table->string('nomor_KK')->nullable()->change();
            $table->integer('jumlah_tanggungan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bayar_zakats', function (Blueprint $table) {
            $table->dropForeign(['warga_id']);
            $table->dropColumn('warga_id');
        });

        Schema::table('wargas', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            // We can't easily restore the old FK to 'kategori_bayar_zakats' without knowing if it exists, 
            // but for rollback we'll just drop the new one.
        });
    }
};
