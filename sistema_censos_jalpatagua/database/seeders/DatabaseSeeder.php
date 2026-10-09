<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{User,Comunidad,Cocode};
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
 public function run(): void {
  User::updateOrCreate(['email'=>'admin@jalpatagua.gob.gt'],['name'=>'Ernesto Salvador','password'=>Hash::make('Admin12345!'),'rol'=>'ADMINISTRADOR']);
  $nombres=[
   ['ALDEA EL PAJONAL','Aldea'],['ALDEA SANIXTAN','Aldea'],['CASERIO EL AMATE','Caserío'],['CASERÍO LA FRONTERA ALDEA VALLE NUEVO','Caserío'],['ALDEA EL JICARAL','Aldea'],['CASERIO EL ACEITUNO ALDEA JICARAL','Caserío'],['ALDEA EL SITIO','Aldea'],['ALDEA SAPUYUCA','Aldea'],['ALDEA VALLE NUEVO','Aldea'],['ALDEA EL COCO','Aldea']
  ];
  foreach($nombres as [$nombre,$tipo]){
   $c=Comunidad::firstOrCreate(['nombre'=>$nombre],['tipo'=>$tipo]);
   foreach([['PRESIDENTE','Juan Pérez',''],['VICEPRESIDENTE','María García',''],['SECRETARIO','Pedro Méndez',''],['TESORERO','Ana Rodríguez','']] as [$cargo,$persona,$tel]) Cocode::firstOrCreate(['comunidad_id'=>$c->id,'cargo'=>$cargo],['nombre'=>$persona,'telefono'=>$tel]);
  }
 }
}
