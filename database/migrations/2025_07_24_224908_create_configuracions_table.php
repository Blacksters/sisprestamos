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
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();

            $table->string(column: 'nombre');
            $table->string(column: 'descripcion');
            $table->text(column: 'direccion');
            $table->string(column: 'telefono');
            $table->string(column: 'gmail');
            $table->string(column: 'web') ->nullable();
            $table->string(column: 'moneda');
            $table->text(column: 'logo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracions');
    }
};
