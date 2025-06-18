<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DocumentoController extends Controller
{
    public function store(Request $request, \App\Models\Trabajador $trabajador)
    {
        $request->validate([
            'archivo' => 'required|file|max:5120', // 5MB máx.
        ]);

        $file = $request->file('archivo');
        $path = $file->store('documentos', 'public');

        $trabajador->documentos()->create([
            'nombre' => $file->getClientOriginalName(),
            'archivo' => $path,
        ]);

        return back()->with('success', 'Documento subido correctamente.');
    }

    public function destroy(Documento $documento)
    {
        // Eliminar archivo de almacenamiento
        Storage::delete('public/' . $documento->archivo);

        // Eliminar documento de la base de datos
        $documento->delete();

        return back()->with('success', 'Documento eliminado con éxito.');
    }

    public function ver($nombre)
    {
        $documento = Documento::where('nombre', $nombre)->firstOrFail();
        $filePath = storage_path('app/public/' . $documento->archivo);

        return response()->file($filePath, [
            'Content-Disposition' => 'inline; filename="' . $documento->nombre . '"',
        ]);
    }


}
