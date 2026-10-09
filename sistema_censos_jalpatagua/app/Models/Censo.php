<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Censo extends Model { protected $fillable=['fecha','observaciones','usuario_id','vivienda_id']; public function vivienda(){return $this->belongsTo(Vivienda::class);} public function usuario(){return $this->belongsTo(User::class,'usuario_id');} }
