<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    const EXHIBICION = 1;
    const PARTICIPANTE = 2;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
