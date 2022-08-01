<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome_categoria'];


    public function roules(){
        return [
            'nome_categoria' => 'required|min:3|max:100'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é requerido',
            'min' => 'O campo :attribute tem que ter no minimo 3 letras',
            'max' => ' O campo :attribute tem que ter no maximo 100 letras'
        ];
    }

    public function produto(){
        return $this->hasMany('App\Models\Produto');
    }

}
