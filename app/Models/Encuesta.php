<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    use HasFactory;

    const Abierta = 1;
    const Cerrada = 2;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

}
