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
        Schema::table('bayar_zakats', function (Blueprint $table) {
            $table->integer('tahun_hijriah')->nullable()->after('status');
        });

        Schema::table('distribusi_zakats', function (Blueprint $table) {
            $table->integer('tahun_hijriah')->nullable()->after('status');
        });

        Schema::table('distribusi_zakat_lainnyas', function (Blueprint $table) {
            $table->integer('tahun_hijriah')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bayar_zakats', function (Blueprint $table) {
            $table->dropColumn('tahun_hijriah');
        });

        Schema::table('distribusi_zakats', function (Blueprint $table) {
            $table->dropColumn('tahun_hijriah');
        });

        Schema::table('distribusi_zakat_lainnyas', function (Blueprint $table) {
            $table->dropColumn('tahun_hijriah');
        });
    }
};
