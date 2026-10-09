<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('censos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('departamento', 100);
            $table->string('municipio', 100);
            $table->string('comunidad', 150);
            $table->string('direccion', 500);
            $table->date('fecha_censo');
            $table->json('datos');
            $table->timestamps();
        });
        Schema::create('censo_hijos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('censo_id')->constrained('censos')->cascadeOnDelete();
            $table->string('primer_nombre', 100);
            $table->string('segundo_nombre', 100)->nullable();
            $table->string('tercer_nombre', 100)->nullable();
            $table->string('primer_apellido', 100);
            $table->string('segundo_apellido', 100)->nullable();
            $table->string('cui', 13)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('desnutricion', 2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('censo_hijos');
        Schema::dropIfExists('censos');
    }
};
