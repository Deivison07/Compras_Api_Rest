<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome_produto',
                            'descricao_produto',
                            'categoria_id',
                            'tipo_id',
                            'imagem_produto',
                            'marca_id',
                            'quantidade_produto',
                            'valor_produto'];


    public function roules(){
        return [
            'nome_produto' => 'required|unique:produtos,nome_produto,'.$this->id.'|min:3',
            'descricao_produto' => 'required|min:3',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_id' => 'required|exists:tipos,id',
            'marca_id' => 'required|exists:marcas,id',
            'quantidade_produto' => 'required|integer',
            'valor_produto' => 'required|numeric'
        ];
    }

    public function feedback(){
        return [
            'required' => ' O campo :attribute é requerido',
            'min' => 'O campo :attribute tem que conter no minimo 3 caracteres',
            'numeric' => 'O campo :attribute tem que ser numérico',
            'integer' => 'O campo :attribute tem que ser um inteiro'
        ];
    }


    // relacionamento de pertencimento

    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

}