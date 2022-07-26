<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nome_marca, imagem_marca'];

    public function roules(){
        return [
            'nome_marca' => 'required|unique:marcas,nome_marca,'.$this->id.'min:3',
            'imagem_marca' => 'file|mimes:png,jpeg,jpg'
        ];
    }

    public function feedback(){

        return [
            'required'=> 'O campo :attribute é requerido',
            'file' => 'O campo :attribute deve ser uma imagem',
            'mimes' => 'O campo :attribute deve ser uma imagem do tipo png ou jpeg ou jpg',
            'max' => ' O campo :attribute tem que ter no maximo 100 letras'
        ];
    }
}
