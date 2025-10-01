<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        // Listar los archivos que ya existen en storage/app/laravel-backup
        $backups = Storage::disk('local')->files('laravel-backup');

        return view('admin.backups.index', compact('backups'));
    }

    public function create()
    {
        try {
            Artisan::call('backup:run');
            $output = Artisan::output(); // Capturar salida real del comando

            return redirect()->route('admin.backups.index')
                ->with('mensaje', 'Backup creado correctamente')
                ->with('detalle', $output) // opcional, para ver detalles en la vista
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return redirect()->route('admin.backups.index')
                ->with('mensaje', 'Error: '.$e->getMessage())
                ->with('icono', 'error');
        }
    }


public function descargar($nombreARCHIVO)
{
    $filePath = storage_path('app/laravel-backup/' . $nombreARCHIVO);

    if (!file_exists($filePath)) {
        abort(404, 'Archivo no encontrado');
    }

    return response()->download($filePath);
}


}
