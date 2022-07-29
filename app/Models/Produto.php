<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome_produto,
                            descricao_produto,
                            categoria_produto,
                            tipo_produto,
                            imagem_produto,
                            marca_produto,
                            quantidade_produto,
                            valor_produto'];



    function roules(){
        return [
            'nome_produto' => 'required|unique:marcas,nome,'.$this->id.'min:3',
            'descricao_produto' => 'required|min:3',
            'categoria_produto' => 'required|exists:categoria,id',
            'tipo_produto' => 'required|exists:tipo,id',
            'marca_produto' => 'required|exists:marca,id',
            'quantidade_produto' => 'required|integer',
            'valor_produto' => 'required|numeric'
        ];
    }

    public function feedback(){
        [
            'required' => ' O campo :attribute é requerido',
            'min' => 'O campo :attribute tem que conter no minimo 3 caracteres',
            'exists' => 'a referencia não existe',
            'numeric' => 'O campo :attribute tem que ser numérico',
            'integer' => 'O campo :attribute tem que ser um inteiro'
        ];
    }


    // relacionamento de pertencimento

    public function categoria(){
         return $this->belongsTo('App\Models\Categoria');
    }

    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }

    public function tipo(){
        return $this->belongsTo('App\Models\Tipo');
    }

}