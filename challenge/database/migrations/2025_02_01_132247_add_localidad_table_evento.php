<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('evento', function (Blueprint $table) {
            $table->string('localidad')->after('fecha_evento')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('evento', function (Blueprint $table) {
            $table->dropColumn('localidad');
        });
    }
};
