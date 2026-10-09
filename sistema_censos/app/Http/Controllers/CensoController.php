<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
class CensoController extends Controller
{
    private function reglas(): array
    {
        $rules = [
            'departamento' => ['required', 'string', 'max:100'],
            'municipio' => ['required', 'string', 'max:100'],
            'comunidad' => ['required', 'string', 'max:150'],
            'direccion' => ['required', 'string', 'max:500'],
            'fecha_censo' => ['required', 'date', 'before_or_equal:today'],
            'tiene_hijos' => ['required', Rule::in(['Si', 'No'])],
            'cui_esposo' => ['nullable', 'digits:13'],
            'cui_esposa' => ['nullable', 'digits:13'],
            'fecha_nacimiento_esposo' => ['nullable', 'date', 'before_or_equal:today'],
            'fecha_nacimiento_esposa' => ['nullable', 'date', 'before_or_equal:today'],
            'hijos' => ['nullable', 'array'],
            'hijos.*.primer_nombre' => ['required', 'string', 'max:100'],
            'hijos.*.segundo_nombre' => ['nullable', 'string', 'max:100'],
            'hijos.*.tercer_nombre' => ['nullable', 'string', 'max:100'],
            'hijos.*.primer_apellido' => ['required', 'string', 'max:100'],
            'hijos.*.segundo_apellido' => ['nullable', 'string', 'max:100'],
            'hijos.*.cui' => ['nullable', 'digits:13'],
            'hijos.*.fecha_nacimiento' => ['required', 'date', 'before_or_equal:today'],
            'hijos.*.desnutricion' => ['required', Rule::in(['Si', 'No'])],
        ];
        foreach ($this->fotos() as $field) {
            $rules[$field] = ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'];
        }
        return $rules;
    }
    private function fotos(): array
    {
        return ['dpi_frente_esposo', 'dpi_reverso_esposo', 'dpi_frente_esposa', 'dpi_reverso_esposa'];
    }
    private function validar(Request $request): array
    {
        $data = $request->validate($this->reglas());
        $hijos = $data['hijos'] ?? [];
        if ($data['tiene_hijos'] === 'Si' && count($hijos) === 0) {
            throw ValidationException::withMessages(['hijos' => 'Debe registrar al menos un hijo cuando selecciona Sí.']);
        }
        if ($data['tiene_hijos'] === 'No' && count($hijos) > 0) {
            throw ValidationException::withMessages(['hijos' => 'Seleccione No solamente si no registró hijos.']);
        }
        return $data;
    }
    private function datosFormulario(Request $request): array
    {
        $payload = $request->except(array_merge(['_token', '_method', 'hijos', 'usuario_censista'], $this->fotos()));
        foreach (['edad_esposo', 'edad_esposa'] as $field) {
            $birthField = str_replace('edad_', 'fecha_nacimiento_', $field);
            $payload[$field] = !empty($payload[$birthField]) ? Carbon::parse($payload[$birthField])->age : null;
        }
        return $payload;
    }
    private function guardarHijos(int $id, array $hijos): void
    {
        foreach ($hijos as $hijo) {
            DB::table('censo_hijos')->insert([
                'censo_id' => $id,
                'primer_nombre' => $hijo['primer_nombre'],
                'segundo_nombre' => $hijo['segundo_nombre'] ?? null,
                'tercer_nombre' => $hijo['tercer_nombre'] ?? null,
                'primer_apellido' => $hijo['primer_apellido'],
                'segundo_apellido' => $hijo['segundo_apellido'] ?? null,
                'cui' => $hijo['cui'] ?? null,
                'fecha_nacimiento' => $hijo['fecha_nacimiento'],
                'desnutricion' => $hijo['desnutricion'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    public function store(Request $request)
    {
        $data = $this->validar($request);
        $payload = $this->datosFormulario($request);
        $archivosNuevos = [];
        try {
            foreach ($this->fotos() as $field) {
                if ($request->hasFile($field)) {
                    $ruta = $request->file($field)->store('censos/dpi', 'local');
                    $archivosNuevos[] = $ruta;
                    $payload[$field] = $ruta;
                }
            }
            DB::transaction(function () use ($data, $payload) {
                $id = DB::table('censos')->insertGetId([
                    'user_id' => auth()->id(),
                    'departamento' => $data['departamento'],
                    'municipio' => $data['municipio'],
                    'comunidad' => $data['comunidad'],
                    'direccion' => $data['direccion'],
                    'fecha_censo' => $data['fecha_censo'],
                    'datos' => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->guardarHijos($id, $data['hijos'] ?? []);
            });
        } catch (\Throwable $e) {
            Storage::disk('local')->delete($archivosNuevos);
            throw $e;
        }
        return redirect()->route('censos.index')->with('success', 'Registro censal guardado correctamente.');
    }
    public function edit(int $id)
    {
        $censo = DB::table('censos')->where('id', $id)->first();
        abort_if(!$censo, 404);
        $datos = json_decode($censo->datos ?? '{}', true);
        $datos = is_array($datos) ? $datos : [];
        $datos = array_merge($datos, [
            'departamento' => $censo->departamento,
            'municipio' => $censo->municipio,
            'comunidad' => $censo->comunidad,
            'direccion' => $censo->direccion,
            'fecha_censo' => $censo->fecha_censo,
        ]);
        $hijos = DB::table('censo_hijos')->where('censo_id', $id)->orderBy('id')->get()->map(fn ($hijo) => (array) $hijo)->all();
        return view('censos.index', compact('censo', 'datos', 'hijos'));
    }
    public function update(Request $request, int $id)
    {
        $censo = DB::table('censos')->where('id', $id)->first();
        abort_if(!$censo, 404);
        $data = $this->validar($request);
        $anteriores = json_decode($censo->datos ?? '{}', true);
        $anteriores = is_array($anteriores) ? $anteriores : [];
        $payload = array_merge($anteriores, $this->datosFormulario($request));
        $archivosNuevos = [];
        $archivosReemplazados = [];
        try {
            foreach ($this->fotos() as $field) {
                if ($request->hasFile($field)) {
                    $ruta = $request->file($field)->store('censos/dpi', 'local');
                    $archivosNuevos[] = $ruta;
                    if (!empty($anteriores[$field])) {
                        $archivosReemplazados[] = $anteriores[$field];
                    }
                    $payload[$field] = $ruta;
                }
            }
            DB::transaction(function () use ($id, $data, $payload) {
                DB::table('censos')->where('id', $id)->update([
                    'departamento' => $data['departamento'],
                    'municipio' => $data['municipio'],
                    'comunidad' => $data['comunidad'],
                    'direccion' => $data['direccion'],
                    'fecha_censo' => $data['fecha_censo'],
                    'datos' => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
                    'updated_at' => now(),
                ]);
                DB::table('censo_hijos')->where('censo_id', $id)->delete();
                $this->guardarHijos($id, $data['hijos'] ?? []);
            });
        } catch (\Throwable $e) {
            Storage::disk('local')->delete($archivosNuevos);
            throw $e;
        }
        // Borrar fotografías antiguas solamente después de guardar correctamente.
        foreach ($archivosReemplazados as $ruta) {
            if (str_starts_with($ruta, 'censos/dpi/')) {
                Storage::disk('local')->delete($ruta);
            }
        }
        return redirect()->route('reportes.index')->with('success', 'Registro censal actualizado correctamente.');
    }
}
