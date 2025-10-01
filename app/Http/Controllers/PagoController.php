<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use App\Models\Prestamo;
use App\Models\Configuracion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        $pagos = Pago::all();
        return view('admin.pagos.index', compact('pagos', 'clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function cargar_prestamos_cliente($id)
    {
        $cliente = Cliente::find($id);

        // Carga los préstamos y precarga la relación con el cliente (uso de with)
        $prestamos = Prestamo::where('cliente_id', $cliente->id)->with('cliente')->get();

        return view('admin.pagos.cargar_prestamos_cliente', compact('cliente', 'prestamos'));
    }


    public function create($id)
    {

        $prestamo = Prestamo::find($id);
        $pagos = Pago::where('prestamo_id', $id)->get();
        return view('admin.pagos.create', compact('prestamo', 'pagos'));
    }

    public function cargar_datos($id)
    {
        $datoscliente = Cliente::find($id);

        $clientes = Cliente::all();
        //$prestamo = Prestamo::find($id);
        //$pagos = Pago::where('prestamo_id', $prestamo->id)->get();
        return view('admin.pagos.cargar_datos', compact('datoscliente', 'clientes'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $pago = Pago::find($id);
        $pago->estado = "Confirmado";
        $pago->fecha_cancelado = date('Y-m-d');
        $pago->save();


        $total_cuotas_faltantes = Pago::where('prestamo_id', $pago->prestamo->id)
            ->where('estado', 'pendiente')
            ->count();

        if ($total_cuotas_faltantes == 0) {
            echo "YA PAGO TODO";
            $prestamo = Prestamo::find($pago->prestamo->id);
            $prestamo->estado = "cancelado";
            $prestamo->save;
        } else {
           // echo "AUN FALTAN CUOTAS";
        }

        return redirect()->back()
            ->with('mensaje', 'Se registró el pago de manera correcta')
            ->with('icono', 'success');
    }

    public function comprobantedepago($id)
    {
        $pago = Pago::find($id);
        $prestamo = Prestamo::where('id', $pago->prestamo_id)->first();
        $cliente = Cliente::where('id', $prestamo->cliente_id)->first();
        $fecha_cancelado = $pago->fecha_cancelado;
        $timestamp = strtotime($fecha_cancelado);
        $dia = date('j', $timestamp);
        $mes = date('F', $timestamp);
        $ano = date('Y', $timestamp);

        $meses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];

        $mes_espanol = $meses[$mes];

        $fecha_literal = $dia . " de " . $mes_espanol . " del  " . $ano;

        $configuracion = Configuracion::latest()->first();
        $pdf = PDF::loadView('admin.pagos.comprobantedepago', compact('pago', 'configuracion', 'fecha_literal', 'prestamo', 'cliente'));
        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pago = Pago::find($id);
        $prestamo = Prestamo::where('id', $pago->prestamo_id)->first();
        $cliente = Cliente::where('id', $prestamo->cliente_id)->first();
        return view('admin.pagos.show', compact('cliente', 'pago', 'prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago = Pago::find($id);
        $pago->fecha_cancelado = null;
        $pago->estado = "pendiente";
        $pago->save();

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Se elimino  el pago del cliente  de manera correcta')
            ->with('icono', 'success');
    }
}
