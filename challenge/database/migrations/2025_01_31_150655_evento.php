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
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->text('description');
            $table->dateTime('fecha_evento'); 
            $table->integer('capacidad_maxima');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};
