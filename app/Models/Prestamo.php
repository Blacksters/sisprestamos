<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    // relacion un prestamo pertenece a un cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    //relacion un prestamos tiene muchos pago
    public function pagos(){
        return $this->hasMany(Pago::class);
    }
}
