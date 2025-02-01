<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fondo_ims', function (Blueprint $table) {
            $table->id();
            $table->string('imagen_path'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fondo_ims');
    }
};
