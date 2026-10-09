<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comunidad extends Model { protected $fillable=['nombre','tipo']; public function cocodes(){return $this->hasMany(Cocode::class);} }
