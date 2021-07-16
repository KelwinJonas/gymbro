<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'dia', 'descricao'];

    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class)
        ->withTimestamps()
        ->withPivot(['serie'])
        ->using(ExercicioTreino::class);
    }

}

