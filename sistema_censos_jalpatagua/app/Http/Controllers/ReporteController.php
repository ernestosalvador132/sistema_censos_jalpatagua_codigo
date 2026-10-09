<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Censo;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReporteController extends Controller {
    public function index(Request $request){
        $tipo=$request->get('tipo','GENERAL');
        $censos=Censo::with(['vivienda','usuario'])->latest('fecha')->get();
        return view('reportes.index',compact('censos','tipo'));
    }
    public function exportar(Request $request){
        $tipo=$request->get('tipo','GENERAL');
        $rows=Censo::with(['vivienda','usuario'])->get();
        $sheet=(new Spreadsheet())->getActiveSheet();
        $sheet->setCellValue('A1','Reporte')->setCellValue('B1',$tipo);
        $sheet->fromArray(['Fecha','Sector','Dirección','Registrado por'],null,'A3');
        $r=4;
        foreach($rows as $c){ $sheet->fromArray([$c->fecha,$c->vivienda->sector,$c->vivienda->direccion,$c->usuario->name],null,'A'.$r++); }
        $tmp=tempnam(sys_get_temp_dir(),'xlsx'); (new Xlsx($sheet->getParent()))->save($tmp);
        return response()->download($tmp,'reporte_'.strtolower($tipo).'_'.date('Ymd_His').'.xlsx')->deleteFileAfterSend(true);
    }
}
