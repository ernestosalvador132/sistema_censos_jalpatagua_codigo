<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cocode extends Model { protected $table='cocodes'; protected $fillable=['comunidad_id','nombre','cargo','telefono']; }
