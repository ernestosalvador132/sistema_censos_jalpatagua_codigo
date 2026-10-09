<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Vivienda,Persona,Censo,CensoPersona};
use Illuminate\Support\Facades\DB;

class CensoController extends Controller {
    public function create(){ return view('censos.create'); }
    public function store(Request $request){
        $data=$request->validate([
            'direccion'=>'required|max:200','sector'=>'required|max:100','servicios_basicos'=>'nullable|max:200',
            'nombres'=>'required|max:100','apellidos'=>'required|max:100','edad'=>'required|integer|min:0|max:120',
            'sexo'=>'required|in:M,F,O','ocupacion'=>'nullable|max:120','rol_familiar'=>'required|max:60','observaciones'=>'nullable'
        ]);
        DB::transaction(function() use($data){
            $v=Vivienda::create(['direccion'=>$data['direccion'],'sector'=>$data['sector'],'servicios_basicos'=>$data['servicios_basicos']??null,'fecha_registro'=>now()]);
            $p=Persona::create(['nombres'=>$data['nombres'],'apellidos'=>$data['apellidos'],'edad'=>$data['edad'],'sexo'=>$data['sexo'],'ocupacion'=>$data['ocupacion']??null,'vivienda_id'=>$v->id]);
            $c=Censo::create(['fecha'=>now()->toDateString(),'observaciones'=>$data['observaciones']??null,'usuario_id'=>auth()->id(),'vivienda_id'=>$v->id]);
            CensoPersona::create(['censo_id'=>$c->id,'persona_id'=>$p->id,'rol_familiar'=>$data['rol_familiar']]);
        });
        return back()->with('ok','Censo registrado correctamente.');
    }
}
