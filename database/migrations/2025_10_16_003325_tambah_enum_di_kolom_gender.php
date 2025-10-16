<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Menggunakan Schema::table untuk memodifikasi tabel yang sudah ada.
        Schema::table('pelanggan', function (Blueprint $table) {
            // Menambahkan kolom 'gender' baru dengan ENUM dan nullable.
            $table->enum('gender', ['Male', 'Female', 'Other'])->change()->after('birthday');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            // Menghapus kolom 'gender' saat di-rollback.
           $table->enum('gender', ['Male', 'Female', 'Other'])->change();
    });
}
};
