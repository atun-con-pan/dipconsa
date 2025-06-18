<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MensajeriaController extends Controller
{
    public function index()
    {
        $registros = Mensaje::latest()->get();
        return view('mensajeria.index', compact('registros'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'recibido_por' => 'required|string',
            'entregado_por' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'tipo' => 'required|in:recibido,entregado',
            'documento' => 'required|file|max:102400',
        ]);

        $archivo = $request->file('documento');
        $ruta = $archivo->store('mensajeria', 'public');
        $nombreOriginal = $archivo->getClientOriginalName();

        $data['documento'] = $ruta;
        $data['nombre_documento'] = $nombreOriginal;

        //dd($data);

        Mensaje::create($data);

        return redirect()->back()->with('success', 'Documento registrado con éxito.');
    }

    public function verArchivo($nombre_documento)
    {
        // Busca el registro por el nombre del archivo
        $registro = Mensaje::where('nombre_documento', 'like', $nombre_documento)->firstOrFail();

        $filePath = storage_path('app/public/' . $registro->documento);

        return response()->file($filePath, [
            'Content-Disposition' => 'inline; filename="' . basename($registro->nombre_documento) . '"',
        ]);
    }
   

    public function update(Request $request, $id)
    {
        $registro = Mensaje::findOrFail($id);

        $request->validate([
            'recibido_por' => 'required|string',
            'entregado_por' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'tipo' => 'required|in:recibido,entregado',
            'documento' => 'nullable|file|mimes:pdf,doc,docx,jpg,png', // ajusta a tus extensiones
        ]);

        $registro->recibido_por = $request->recibido_por;
        $registro->entregado_por = $request->entregado_por;
        $registro->fecha = $request->fecha;
        $registro->hora = $request->hora;
        $registro->tipo = $request->tipo;

        if ($request->hasFile('documento')) {
            // Borra archivo anterior si existe
            if ($registro->documento && Storage::disk('public')->exists($registro->documento)) {
                Storage::disk('public')->delete($registro->documento);
            }

            // Guarda nuevo archivo con nombre aleatorio para evitar conflictos
            $path = $request->file('documento')->store('documentos', 'public');

            $registro->documento = $path;                              // ruta almacenada
            $registro->nombre_documento = $request->file('documento')->getClientOriginalName(); // nombre original
        }

        $registro->save();

        return redirect()->route('mensajeria.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(Mensaje $mensajerium)
    {
        Storage::delete($mensajerium->documento);
        $mensajerium->delete();

        return redirect()->back()->with('success', 'Documento eliminado.');
    }
}
