<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CensoPersona extends Model { public $timestamps=false; protected $table='censo_persona'; protected $fillable=['censo_id','persona_id','rol_familiar']; }
