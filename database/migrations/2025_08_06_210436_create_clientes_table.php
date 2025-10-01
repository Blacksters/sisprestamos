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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('nro_documento', length:20)->unique();
            $table->string('nombre', length:100);
            $table->string('apellidos', length:100);
            $table->string('fecha_nacimiento');
            $table->string('genero');
            $table->string('email',length:100);
            $table->string('celular', length:20);
            $table->string('ref_celular');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
