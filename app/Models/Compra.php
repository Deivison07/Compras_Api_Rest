<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['produto_id,cliente_id'];

    public function roules(){

        return [
            'produto_id' => 'required|exists:produtos,id',
            'cliente_id' => 'required|exists:clientes,id'
        ];
    }

    public function feedback(){

        return [
            'required' => 'O campo :attribute é requerido',
            'exists' => 'O valor não faz referencia a nenhum :attribute'
        ];
    }


    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }

    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }

}
