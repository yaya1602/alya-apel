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
    Schema::create('multipleuploads', function (Blueprint $table) {
    $table->id();
    $table->string('file');
    $table->string('ref_table', 100)->nullable();
    $table->integer('ref_id')->nullable();
    $table->timestamps();
});

}


public function down()
{
    Schema::table('multipleuploads', function (Blueprint $table) {
        $table->dropColumn(['ref_table', 'ref_id']);
    });
}

};
