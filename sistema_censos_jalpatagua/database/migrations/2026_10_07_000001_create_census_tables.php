<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::table('users',function(Blueprint $t){ $t->enum('rol',['ADMINISTRADOR','DIGITADOR'])->default('DIGITADOR'); });
  Schema::create('viviendas',function(Blueprint $t){$t->id();$t->string('direccion',200);$t->string('sector',100);$t->string('servicios_basicos',200)->nullable();$t->dateTime('fecha_registro');$t->timestamps();});
  Schema::create('personas',function(Blueprint $t){$t->id();$t->string('nombres',100);$t->string('apellidos',100);$t->unsignedTinyInteger('edad');$t->enum('sexo',['M','F','O']);$t->string('ocupacion',120)->nullable();$t->foreignId('vivienda_id')->constrained('viviendas')->cascadeOnDelete();$t->timestamps();});
  Schema::create('censos',function(Blueprint $t){$t->id();$t->date('fecha');$t->text('observaciones')->nullable();$t->foreignId('usuario_id')->constrained('users');$t->foreignId('vivienda_id')->constrained('viviendas');$t->timestamps();});
  Schema::create('censo_persona',function(Blueprint $t){$t->foreignId('censo_id')->constrained('censos')->cascadeOnDelete();$t->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();$t->string('rol_familiar',60);$t->primary(['censo_id','persona_id']);});
  Schema::create('comunidades',function(Blueprint $t){$t->id();$t->string('nombre',150)->unique();$t->string('tipo',50);$t->timestamps();});
  Schema::create('cocodes',function(Blueprint $t){$t->id();$t->foreignId('comunidad_id')->constrained('comunidades')->cascadeOnDelete();$t->string('nombre',150);$t->enum('cargo',['PRESIDENTE','VICEPRESIDENTE','SECRETARIO','TESORERO']);$t->string('telefono',20)->nullable();$t->timestamps();$t->unique(['comunidad_id','cargo']);});
 }
 public function down(): void { Schema::dropIfExists('cocodes');Schema::dropIfExists('comunidades');Schema::dropIfExists('censo_persona');Schema::dropIfExists('censos');Schema::dropIfExists('personas');Schema::dropIfExists('viviendas');Schema::table('users',fn(Blueprint $t)=>$t->dropColumn('rol')); }
};
