<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('photo')->after('angkatan')->nullable(); // Tambahkan kolom photo
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('photo'); // Hapus kolom saat rollback
        });
    }
};
