<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = ['nome_tipo'];

    public function roules(){
        return [
            'nome_tipo' => 'required|min:3|max:200',

        ]; // regras de validação
    }

    public function feedback(){
        return  [
            'required' => 'o campo :attribute é requerido',

        ]; // feedback das regras de validação
    }



}
