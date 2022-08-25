<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_certificado',
        'cantidad',
        'clave_unidad',
        'descripcion',
        'base',
        'importe_iva',
        'total',
        'fecha',
        ];

        protected static function boot(){
            parent::boot();
            self::creating(function ($users){
                if (!app()->runningInConsole()){
                    $users->id = auth()->id();
                }
            });
        }

        
}
