<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Vivienda extends Model { protected $fillable=['direccion','sector','servicios_basicos','fecha_registro']; public function personas(){return $this->hasMany(Persona::class);} }
