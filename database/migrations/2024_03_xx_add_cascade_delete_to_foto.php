<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeDeleteToFoto extends Migration
{
    public function up()
    {
        Schema::table('foto', function (Blueprint $table) {
            // Hapus foreign key yang lama
            $table->dropForeign(['galery_id']);
            
            // Tambahkan foreign key baru dengan cascade delete
            $table->foreign('galery_id')
                  ->references('id')
                  ->on('galery')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('foto', function (Blueprint $table) {
            // Hapus foreign key dengan cascade
            $table->dropForeign(['galery_id']);
            
            // Kembalikan ke foreign key biasa
            $table->foreign('galery_id')
                  ->references('id')
                  ->on('galery');
        });
    }
} 