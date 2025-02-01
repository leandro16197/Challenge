<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  
            $table->foreignId('evento_id')->constrained('evento')->onDelete('cascade'); 
            $table->integer('cantidad'); 
            $table->timestamps(); 
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('reservas');

    }
};
