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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('maridaje'); // Corrección de 'test' a 'text'
            $table->decimal('precio', 10, 2); // Corrección de 'decimal(10,2)' a 'decimal('precio', 10, 2)'
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos'); // Corrección en las claves foráneas
            $table->unsignedBigInteger('denominacion_id');
            $table->foreign('denominacion_id')->references('id')->on('denominaciones'); // Corrección en las claves foráneas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
