<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
class ReporteController extends Controller
{
    // Orden exacto de los campos del formulario censal.
    private function secciones(): array
    {
        return [
            [
                'titulo' => 'Identificación Cartográfica',
                'campos' => [
                    'departamento' => 'Departamento',
                    'municipio' => 'Municipio',
                    'comunidad' => 'Comunidad',
                    'direccion' => 'Dirección',
                ],
            ],
            [
                'titulo' => 'Características de la vivienda y datos del hogar',
                'campos' => [
                    'material_paredes' => 'Material predominante en las paredes exteriores',
                    'material_piso' => 'Material predominante en el piso',
                    'material_techo' => 'Material predominante en el techo',
                    'red_agua' => 'Red de distribución de agua',
                    'red_drenajes' => 'Red de drenajes',
                    'red_energia_electrica' => 'Red de distribución de energía eléctrica',
                    'red_telefonica' => 'Red telefónica',
                    'fuente_agua' => '¿De dónde obtiene principalmente el agua para el consumo del hogar?',
                    'eliminacion_basura' => '¿Cómo eliminan principalmente la basura en este hogar?',
                    'tipo_sanitario' => '¿Qué tipo de sanitario tiene este hogar?',
                    'uso_sanitario' => 'El servicio sanitario es de:',
                    'cantidad_cuartos' => '¿De cuántos cuartos dispone este hogar?',
                    'cuartos_dormitorio' => '¿Cuántos cuartos utiliza como dormitorio?',
                    'television' => 'Televisión',
                    'radio' => 'Radio',
                    'grabadora' => 'Grabadora o radio grabadora',
                    'piedra_moler' => 'Piedra de moler',
                    'molino_nixtamal' => 'Molino manual de Nixtamal',
                    'estufa_gas' => 'Estufa a gas',
                    'refrigeradora' => 'Refrigeradora',
                    'plancha_brasas' => 'Plancha de brasas',
                    'plancha_electrica' => 'Plancha eléctrica',
                    'lavadora' => 'Lavadora de ropa',
                    'bicicleta' => 'Bicicleta',
                    'automovil' => 'Automóvil',
                    'tenencia_vivienda' => 'La vivienda que ocupa este hogar es:',
                    'medio_obtencion_vivienda' => '¿Por cuál medio, el hogar obtuvo esta vivienda?',
                    'programa_vivienda' => '¿A través de qué programa accedió a esta vivienda?',
                    'vivienda_institucion' => '¿La vivienda que ocupa este hogar fue construida o financiada por alguna institución pública y/o ONG?',
                ],
            ],
            [
                'titulo' => 'Información del esposo',
                'campos' => [
                    'primer_nombre_esposo' => 'Primer nombre',
                    'segundo_nombre_esposo' => 'Segundo nombre',
                    'tercer_nombre_esposo' => 'Tercer nombre',
                    'primer_apellido_esposo' => 'Primer apellido',
                    'segundo_apellido_esposo' => 'Segundo apellido',
                    'cui_esposo' => 'No. de CUI',
                    'grupo_etnico_esposo' => 'Grupo étnico',
                    'fecha_nacimiento_esposo' => 'Fecha de nacimiento',
                    'edad_esposo' => 'Edad',
                    'estado_civil_esposo' => 'Estado Civil',
                    'discapacidad_esposo' => 'Discapacidad permanente',
                    'sabe_leer_escribir_esposo' => '¿Sabe leer y escribir?',
                    'ultimo_grado_aprobado_esposo' => 'Último grado aprobado',
                    'categoria_ocupacional_esposo' => 'Categoría ocupacional',
                    'siembra_esposo' => '¿Siembra?',
                    'tipo_cultivo_esposo' => '¿Qué cultivo siembra?',
                    'cantidad_siembra_esposo' => '¿Qué cantidad siembra?',
                    'unidad_siembra_esposo' => 'Unidad de medida de siembra',
                ],
            ],
            [
                'titulo' => 'Fotografía del DPI',
                'campos' => [
                    'dpi_frente_esposo' => 'Fotografía del DPI - Frente',
                    'dpi_reverso_esposo' => 'Fotografía del DPI - Reverso',
                ],
            ],
            [
                'titulo' => 'Información de la esposa',
                'campos' => [
                    'primer_nombre_esposa' => 'Primer nombre',
                    'segundo_nombre_esposa' => 'Segundo nombre',
                    'tercer_nombre_esposa' => 'Tercer nombre',
                    'primer_apellido_esposa' => 'Primer apellido',
                    'segundo_apellido_esposa' => 'Segundo apellido',
                    'apellido_casada_esposa' => 'Apellido de casada',
                    'cui_esposa' => 'No. de CUI',
                    'grupo_etnico_esposa' => 'Grupo étnico',
                    'fecha_nacimiento_esposa' => 'Fecha de nacimiento',
                    'edad_esposa' => 'Edad',
                    'estado_civil_esposa' => 'Estado civil esposa',
                    'discapacidad_esposa' => 'Discapacidad permanente',
                    'sabe_leer_escribir_esposa' => '¿Sabe leer y escribir?',
                    'ultimo_grado_aprobado_esposa' => 'Último grado aprobado',
                    'categoria_ocupacional_esposa' => 'Categoría ocupacional',
                    'siembra' => '¿Siembra?',
                    'tipo_cultivo' => '¿Qué cultivo siembra?',
                    'cantidad_siembra' => '¿Qué cantidad siembra?',
                    'unidad_siembra' => 'Unidad de medida de siembra',
                ],
            ],
            [
                'titulo' => 'Fotografías del DPI',
                'campos' => [
                    'dpi_frente_esposa' => 'Fotografía del DPI - Frente',
                    'dpi_reverso_esposa' => 'Fotografía del DPI - Reverso',
                ],
            ],
            [
                'titulo' => 'Información de los hijos',
                'campos' => [
                    'tiene_hijos' => '¿Tiene hijos?',
                ],
            ],
            [
                'titulo' => 'Datos del censo',
                'campos' => [
                    'fecha_censo' => 'Fecha del censo',
                    'censo_realizado_por' => 'Censo realizado por',
                    'observaciones' => 'Observaciones',
                ],
            ],
        ];
    }
    private function camposHijos(): array
    {
        return [
            'primer_nombre' => 'Primer nombre',
            'segundo_nombre' => 'Segundo nombre',
            'tercer_nombre' => 'Tercer nombre',
            'primer_apellido' => 'Primer apellido',
            'segundo_apellido' => 'Segundo apellido',
            'cui' => 'No. de CUI',
            'fecha_nacimiento' => 'Fecha de nacimiento',
            'edad' => 'Edad',
            'desnutricion' => '¿Presenta desnutrición?',
        ];
    }
    private function tiposReporte(): array
    {
        return [
            'general' => 'Reporte general',
            'comunidad' => 'Reporte por comunidad',
            'vivienda' => 'Reporte por características de vivienda',
            'poblacion' => 'Reporte por población',
            'educacion' => 'Reporte por educación',
            'agricultura' => 'Reporte por actividad agrícola',
            'discapacidad' => 'Reporte por discapacidad',
            'desnutricion' => 'Reporte por desnutrición infantil',
        ];
    }
    private function camposPorTipo(): array
    {
        return [
            'vivienda' => [
                'material_paredes' => 'Material de las paredes',
                'material_piso' => 'Material del piso',
                'material_techo' => 'Material del techo',
                'red_agua' => 'Red de agua',
                'red_drenajes' => 'Red de drenajes',
                'red_energia_electrica' => 'Energía eléctrica',
                'tenencia_vivienda' => 'Tenencia de vivienda',
            ],
            'poblacion' => [
                'grupo_etnico_esposo' => 'Grupo étnico del esposo',
                'grupo_etnico_esposa' => 'Grupo étnico de la esposa',
                'estado_civil_esposo' => 'Estado civil del esposo',
                'estado_civil_esposa' => 'Estado civil de la esposa',
                'tiene_hijos' => 'Tiene hijos',
            ],
            'educacion' => [
                'sabe_leer_escribir_esposo' => 'Alfabetización del esposo',
                'sabe_leer_escribir_esposa' => 'Alfabetización de la esposa',
                'ultimo_grado_aprobado_esposo' => 'Escolaridad del esposo',
                'ultimo_grado_aprobado_esposa' => 'Escolaridad de la esposa',
            ],
            'agricultura' => [
                'siembra_esposo' => 'Siembra el esposo',
                'tipo_cultivo_esposo' => 'Cultivo del esposo',
                'siembra' => 'Siembra la esposa',
                'tipo_cultivo' => 'Cultivo de la esposa',
            ],
            'discapacidad' => [
                'discapacidad_esposo' => 'Discapacidad del esposo',
                'discapacidad_esposa' => 'Discapacidad de la esposa',
            ],
            'desnutricion' => [
                'desnutricion' => 'Desnutrición de los hijos',
            ],
        ];
    }
    private function filtros(Request $request): array
    {
        $filtros = $request->validate([
            'tipo_reporte' => ['nullable', Rule::in(array_keys($this->tiposReporte()))],
            'comunidad' => ['nullable', 'string', 'max:255'],
            'campo' => ['nullable', 'string', 'max:100'],
            'valor' => ['nullable', 'string', 'max:255'],
            'buscar' => ['nullable', 'string', 'max:150'],
        ]);
        $tipo = $filtros['tipo_reporte'] ?? 'general';
        if ($tipo === 'comunidad' && empty($filtros['comunidad'])) {
            throw \Illuminate\Validation\ValidationException::withMessages(['comunidad' => 'Seleccione una comunidad.']);
        }
        if (isset($this->camposPorTipo()[$tipo])) {
            $campo = $filtros['campo'] ?? '';
            if (!array_key_exists($campo, $this->camposPorTipo()[$tipo])) {
                throw \Illuminate\Validation\ValidationException::withMessages(['campo' => 'Seleccione un criterio válido.']);
            }
        }
        return $filtros;
    }
    private function consulta(array $filtros)
    {
        $query = DB::table('censos');
        $tipo = $filtros['tipo_reporte'] ?? 'general';
        if ($tipo === 'comunidad') {
            $query->where('comunidad', $filtros['comunidad']);
        }
        if (isset($this->camposPorTipo()[$tipo])) {
            $campo = $filtros['campo'];
            $valor = $filtros['valor'] ?? '';
            if ($campo === 'desnutricion') {
                $query->whereExists(function ($subconsulta) use ($valor) {
                    $subconsulta->selectRaw('1')->from('censo_hijos')
                        ->whereColumn('censo_hijos.censo_id', 'censos.id');
                    if ($valor !== '') {
                        $subconsulta->where('desnutricion', $valor);
                    }
                });
            } elseif ($valor !== '') {
                // El nombre del campo proviene exclusivamente de la lista permitida.
                $query->where('datos->' . $campo, $valor);
            } else {
                $query->whereNotNull('datos->' . $campo);
            }
        }
        $buscar = trim($filtros['buscar'] ?? '');
        if ($buscar !== '') {
            $partes = preg_split('/\\s+/u', $buscar);
            $camposNombre = ['primer_nombre_esposo', 'segundo_nombre_esposo', 'tercer_nombre_esposo', 'primer_apellido_esposo', 'segundo_apellido_esposo', 'primer_nombre_esposa', 'segundo_nombre_esposa', 'tercer_nombre_esposa', 'primer_apellido_esposa', 'segundo_apellido_esposa', 'apellido_casada_esposa'];
            $expresiones = [];
            foreach (['esposo', 'esposa'] as $persona) {
                $campos = array_values(array_filter($camposNombre, fn ($campo) => str_ends_with($campo, '_' . $persona)));
                if ($persona === 'esposa') $campos[] = 'apellido_casada_esposa';
                $componentes = array_map(fn ($campo) => "COALESCE(JSON_UNQUOTE(JSON_EXTRACT(datos, '$." . $campo . "')), '')", array_unique($campos));
                $expresiones[] = "CONCAT_WS(' ', " . implode(', ', $componentes) . ")";
            }
            foreach ($partes as $parte) {
                $patron = '%' . str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $parte) . '%';
                $query->where(function ($q) use ($expresiones, $patron) {
                    foreach ($expresiones as $expresion) {
                        $q->orWhereRaw($expresion . " LIKE ? ESCAPE '!'", [$patron]);
                    }
                });
            }
        }
        return $query;
    }
    private function opcionesFiltros(): array
    {
        $opciones = [];
        foreach ($this->camposPorTipo() as $tipo => $campos) {
            foreach ($campos as $campo => $etiqueta) {
                if ($campo === 'desnutricion') {
                    $valores = DB::table('censo_hijos')->whereNotNull('desnutricion')
                        ->distinct()->orderBy('desnutricion')->pluck('desnutricion')->all();
                } else {
                    $ruta = '$."' . $campo . '"';
                    $valores = DB::table('censos')
                        ->selectRaw('DISTINCT JSON_UNQUOTE(JSON_EXTRACT(datos, ?)) AS valor', [$ruta])
                        ->whereRaw('JSON_EXTRACT(datos, ?) IS NOT NULL', [$ruta])
                        ->orderBy('valor')->pluck('valor')->filter(fn ($v) => $v !== null && $v !== '')->values()->all();
                }
                $opciones[$tipo][$campo] = $valores;
            }
        }
        return $opciones;
    }
    private function obtenerDatos($censo): array
    {
        $datos = json_decode($censo->datos ?? '{}', true);
        return is_array($datos) ? $datos : [];
    }
    private function convertirValor($valor): string
    {
        if (is_array($valor)) {
            return json_encode(
                $valor,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            ) ?: '';
        }
        if (is_bool($valor)) {
            return $valor ? 'Sí' : 'No';
        }
        return (string) ($valor ?? '');
    }
    private function columnasOrdenadas(): array
    {
        $columnas = [];
        foreach ($this->secciones() as $seccion) {
            foreach ($seccion['campos'] as $clave => $etiqueta) {
                $columnas[$clave] = $etiqueta;
            }
        }
        return $columnas;
    }
    public function index(Request $request)
    {
        $filtros = $this->filtros($request);
        $tipoReporte = $filtros['tipo_reporte'] ?? 'general';
        $tiposReporte = $this->tiposReporte();
        $camposPorTipo = $this->camposPorTipo();
        $opcionesFiltros = $this->opcionesFiltros();
        $censos = $this->consulta($filtros)
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();
        $comunidades = DB::table('censos')
            ->whereNotNull('comunidad')
            ->where('comunidad', '<>', '')
            ->distinct()
            ->orderBy('comunidad')
            ->pluck('comunidad');
        $totalCensos = DB::table('censos')->count();
        $totalComunidades = DB::table('censos')
            ->whereNotNull('comunidad')
            ->where('comunidad', '<>', '')
            ->distinct()
            ->count('comunidad');
        return view(
            'reportes.index',
            compact(
                'censos',
                'comunidades',
                'totalCensos',
                'totalComunidades',
                'tipoReporte',
                'tiposReporte',
                'camposPorTipo',
                'opcionesFiltros'
            )
        );
    }
    // EXPORTAR REPORTE PDF
    public function exportarPdf(Request $request)
    {
        $filtros = $this->filtros($request);
        $censos = $this->consulta($filtros)
            ->orderBy('id', 'asc')
            ->get();
        $usuarios = DB::table('users')->whereIn('id', $censos->pluck('user_id')->filter()->unique()->all())->pluck('name', 'id');
        $censos->each(function ($censo) use ($usuarios) {
            $censo->censo_realizado_por = $usuarios->get($censo->user_id) ?: 'No registrado';
        });
        $ids = $censos->pluck('id')->all();
        $hijosPorCenso = empty($ids)
            ? collect()
            : DB::table('censo_hijos')
                ->whereIn('censo_id', $ids)
                ->orderBy('id')
                ->get()
                ->groupBy('censo_id');
        return Pdf::loadView('reportes.pdf', [
            'censos' => $censos,
            'tipoReporte' => $filtros['tipo_reporte'] ?? 'general',
            'comunidad' => $filtros['comunidad'] ?? null,
            'secciones' => $this->secciones(),
            'camposHijos' => $this->camposHijos(),
            'hijosPorCenso' => $hijosPorCenso,
        ])
            ->setPaper('a4', 'landscape')
            ->download('reporte_censal.pdf');
    }
    // EXPORTAR EXCEL: UNA FILA POR CENSO
    public function exportarExcel(Request $request)
    {
        $filtros = $this->filtros($request);
        $censos = $this->consulta($filtros)
            ->orderBy('id', 'asc')
            ->get();
        $usuarios = DB::table('users')->whereIn('id', $censos->pluck('user_id')->filter()->unique()->all())->pluck('name', 'id');
        $censos->each(function ($censo) use ($usuarios) {
            $censo->censo_realizado_por = $usuarios->get($censo->user_id) ?: 'No registrado';
        });
        $ids = $censos->pluck('id')->all();
        // Obtener los hijos de todos los censos.
        $hijosPorCenso = empty($ids)
            ? collect()
            : DB::table('censo_hijos')
                ->whereIn('censo_id', $ids)
                ->orderBy('id')
                ->get()
                ->groupBy('censo_id');
        $secciones = $this->secciones();
        $camposHijos = $this->camposHijos();
        // Buscar el número máximo de hijos por censo.
        $maxHijos = $hijosPorCenso->reduce(
            function ($maximo, $hijos) {
                return max($maximo, $hijos->count());
            },
            0
        );
        // Encabezados de Excel.
        $encabezados = ['Familias censadas'];
        foreach ($secciones as $seccion) {
            foreach ($seccion['campos'] as $clave => $etiqueta) {
                $encabezados[] =
                    $seccion['titulo'] . ' - ' . $etiqueta;
            }
            // Agregar los campos de los hijos en el mismo
            // lugar donde aparecen en el PDF.
            if (
                $seccion['titulo'] ===
                'Información de los hijos'
            ) {
                for ($numero = 1; $numero <= $maxHijos; $numero++) {
                    foreach ($camposHijos as $clave => $etiqueta) {
                        $encabezados[] =
                            'Hijo ' . $numero . ' - ' . $etiqueta;
                    }
                }
            }
        }
        // Construir una sola fila por cada censo.
        $filas = $censos->values()->map(function ($censo, $indiceCenso) use (
            $secciones,
            $camposHijos,
            $hijosPorCenso,
            $maxHijos
        ) {
            $datos = json_decode(
                $censo->datos ?? '{}',
                true
            );
            $datos = is_array($datos) ? $datos : [];
            $datos = array_merge(
                $datos,
                (array) $censo
            );
            $hijos = (
                $hijosPorCenso[$censo->id] ?? collect()
            )->values();
            $fila = [$indiceCenso + 1];
            foreach ($secciones as $seccion) {
                // Datos generales del censo.
                foreach ($seccion['campos'] as $clave => $etiqueta) {
                    $valor = $datos[$clave] ?? null;
                    if (is_array($valor)) {
                        $valor = json_encode(
                            $valor,
                            JSON_UNESCAPED_UNICODE |
                            JSON_UNESCAPED_SLASHES
                        );
                    }
                    if (is_bool($valor)) {
                        $valor = $valor ? 'Sí' : 'No';
                    }
                    $fila[] = (
                        $valor !== null && $valor !== ''
                    )
                        ? (string) $valor
                        : '—';
                }
                // Información de los hijos.
                if (
                    $seccion['titulo'] ===
                    'Información de los hijos'
                ) {
                    for (
                        $indice = 0;
                        $indice < $maxHijos;
                        $indice++
                    ) {
                        $hijo = $hijos->get($indice);
                        foreach ($camposHijos as $clave => $etiqueta) {
                            $valorHijo = $hijo
                                ? ($hijo->{$clave} ?? null)
                                : null;
                            // Calcular edad a la fecha del censo.
                            if (
                                $hijo &&
                                $clave === 'edad' &&
                                !empty($hijo->fecha_nacimiento)
                            ) {
                                try {
                                    $fechaNacimiento =
                                        Carbon::parse(
                                            $hijo->fecha_nacimiento
                                        );
                                    $fechaReferencia =
                                        !empty($censo->fecha_censo)
                                            ? Carbon::parse(
                                                $censo->fecha_censo
                                            )
                                            : Carbon::today();
                                    if (
                                        $fechaNacimiento->lessThanOrEqualTo(
                                            $fechaReferencia
                                        )
                                    ) {
                                        $valorHijo = (int)
                                            $fechaNacimiento->diffInYears(
                                                $fechaReferencia
                                            );
                                    } else {
                                        $valorHijo = null;
                                    }
                                } catch (\Exception $e) {
                                    $valorHijo = null;
                                }
                            }
                            if (is_array($valorHijo)) {
                                $valorHijo = json_encode(
                                    $valorHijo,
                                    JSON_UNESCAPED_UNICODE |
                                    JSON_UNESCAPED_SLASHES
                                );
                            }
                            if (is_bool($valorHijo)) {
                                $valorHijo =
                                    $valorHijo ? 'Sí' : 'No';
                            }
                            $fila[] = (
                                $valorHijo !== null &&
                                $valorHijo !== ''
                            )
                                ? (string) $valorHijo
                                : '—';
                        }
                    }
                }
            }
            return $fila;
        });
        // Generar archivo Excel.
        $exportacion = new class(
            $filas,
            $encabezados
        ) implements
            FromCollection,
            WithHeadings,
            WithStyles,
            ShouldAutoSize {
            public function __construct(
                private $filas,
                private array $encabezados
            ) {}
            public function headings(): array
            {
                return $this->encabezados;
            }
            public function collection(): \Illuminate\Support\Enumerable
            {
                return $this->filas;
            }
            public function styles(Worksheet $sheet): array
            {
                // Encabezados.
                $sheet->getStyle('1:1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF',
                        ],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => '12335B',
                        ],
                    ],
                    'alignment' => [
                        'vertical' => 'center',
                        'wrapText' => true,
                    ],
                ]);
                // Altura del encabezado.
                $sheet->getRowDimension(1)->setRowHeight(45);
                // Congelar encabezados y numeración de familias.
                $sheet->freezePane('B2');
                // Filtros automáticos.
                $sheet->setAutoFilter(
                    'A1:' .
                    $sheet->getHighestColumn() .
                    $sheet->getHighestRow()
                );
                // Bordes para toda la tabla.
                $sheet->getStyle(
                    'A1:' .
                    $sheet->getHighestColumn() .
                    $sheet->getHighestRow()
                )->getBorders()->getAllBorders()->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );
                // Tratar los CUI como texto para conservar
                // todos sus dígitos.
                foreach ($this->encabezados as $indice => $encabezado) {
                    if (str_contains($encabezado, 'No. de CUI')) {
                        $columna =
                            \PhpOffice\PhpSpreadsheet\Cell\Coordinate
                                ::stringFromColumnIndex($indice + 1);
                        $sheet->getStyle(
                            $columna . '2:' .
                            $columna . max(2, $sheet->getHighestRow())
                        )->getNumberFormat()->setFormatCode('@');
                    }
                }
                return [];
            }
        };
        return Excel::download(
            $exportacion,
            'reporte_censal.xlsx'
        );
    }
    // MOSTRAR DETALLE DE UN CENSO
    public function show($id)
    {
        $censo = DB::table('censos')
            ->where('id', $id)
            ->first();
        abort_if(!$censo, 404);
        $datos = $this->obtenerDatos($censo);
        $hijos = DB::table('censo_hijos')
            ->where('censo_id', $id)
            ->get();
        return view(
            'reportes.show',
            compact('censo', 'datos', 'hijos')
        );
    }
public function destroy($id)
{
    $censo = DB::table('censos')->where('id', $id)->first();
    abort_if(!$censo, 404);
    $datos = json_decode($censo->datos ?? '{}', true);
    $datos = is_array($datos) ? $datos : [];
    DB::transaction(function () use ($id) {
        DB::table('censo_hijos')->where('censo_id', $id)->delete();
        DB::table('censos')->where('id', $id)->delete();
    });
    $camposDpi = [
        'dpi_frente_esposo',
        'dpi_reverso_esposo',
        'dpi_frente_esposa',
        'dpi_reverso_esposa'
    ];
    foreach ($camposDpi as $campo) {
        $ruta = $datos[$campo] ?? null;
        if (is_string($ruta) && str_starts_with($ruta, 'censos/dpi/')) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($ruta);
        }
    }
    return redirect()->route('reportes.index')->with('success', 'Registro censal eliminado correctamente.');
}
}
