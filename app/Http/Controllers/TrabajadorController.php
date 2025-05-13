<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;

class TrabajadorController extends Controller
{
    // Mostrar lista de trabajadores
    public function index()
    {
        $trabajadores = Trabajador::all();
        return view('trabajadores.index', compact('trabajadores'));
    }

    // Mostrar formulario para crear un nuevo trabajador
    public function create()
    {
        return view('trabajadores.create');
    }

    // Guardar un nuevo trabajador
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dpi' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'residencia' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:trabajadores,email',
            'cargo' => 'required|string|max:255',
            'inicio' => 'required|string|max:255',
            'terminacion' => 'required|string|max:255',
            'salario' => 'required|string|max:255',
            'contrato' => 'required|string|max:255',
            'jefe' => 'required|string|max:255',
            'cuenta_bancaria' => 'required|string|max:255',
            'No_IGSS' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf,docx,jpg,png|max:102400',
        ]);

        $archivo = null;
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo')->store('archivos', 'public');
        }

        Trabajador::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'dpi' => $request->dpi,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'estado_civil' => $request->estado_civil,
            'residencia' => $request->residencia,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'cargo' => $request->cargo,
            'inicio' => $request->inicio,
            'terminacion' => $request->terminacion,
            'salario' => $request->salario,
            'contrato' => $request->contrato,
            'jefe' => $request->jefe,
            'cuenta_bancaria' => $request->cuenta_bancaria,
            'No_IGSS' => $request->No_IGSS,
            'archivo' => $archivo,
        ]);

        return redirect()->route('trabajadores.index');
    }

    // Mostrar formulario para editar un trabajador
    public function edit($id)
    {
        $trabajador = Trabajador::findOrFail($id);
        return view('trabajadores.edit', compact('trabajador'));
    }

    // Actualizar un trabajador
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dpi' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'residencia' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:trabajadores,email,' . $id,
            'cargo' => 'required|string|max:255',
            'inicio' => 'required|string|max:255',
            'terminacion' => 'required|string|max:255',
            'salario' => 'required|string|max:255',
            'contrato' => 'required|string|max:255',
            'jefe' => 'required|string|max:255',
            'cuenta_bancaria' => 'required|string|max:255',
            'No_IGSS' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048',
        ]);

        $trabajador = Trabajador::findOrFail($id);

        $archivo = $trabajador->archivo;
        if ($request->hasFile('archivo')) {
            if ($archivo) {
                \Storage::disk('public')->delete($archivo);
            }
            $archivo = $request->file('archivo')->store('archivos', 'public');
        }

        $trabajador->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'dpi' => $request->dpi,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'estado_civil' => $request->estado_civil,
            'residencia' => $request->residencia,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'cargo' => $request->cargo,
            'inicio' => $request->inicio,
            'terminacion' => $request->terminacion,
            'salario' => $request->salario,
            'contrato' => $request->contrato,
            'jefe' => $request->jefe,
            'cuenta_bancaria' => $request->cuenta_bancaria,
            'No_IGSS' => $request->No_IGSS,
            'archivo' => $archivo,
        ]);

        return redirect()->route('trabajadores.index');
    }

    // Eliminar un trabajador
    public function destroy($id)
    {
        $trabajador = Trabajador::findOrFail($id);
        if ($trabajador->archivo) {
            \Storage::disk('public')->delete($trabajador->archivo);
        }
        $trabajador->delete();

        return redirect()->route('trabajadores.index');
    }

    // Ver la informacion de un trabajador
    public function show(Trabajador $trabajador)
    {
        return view('trabajadores.show', compact('trabajador'));
    }

}
