<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome_cliente,cpf_cliente'];


    public function roules(){

        return [
            'nome_cliente' => 'required|min:3|max:50',
            'cpf_cliente' => 'required|integer|min:11|max:11|unique:clientes,cpf_cliente'
        ];
    }

    public function feedback(){
        [
            'required' => 'O campo :attribute é requerido',
            'nome.min' => 'O nome tem que ter no minimo 3 caracteres',
            'nome.max' => 'O nome tem que ter no maximo 50 caracteres',
            'cpf_cliente.min' => 'O Cpf tem que ter no minimo 11 caracteres',
            'cpf_cliente.max' => 'O cpf tem que ter no maximo 11 caracteres',
            'cpf_cliente.unique' => 'Este cpf já foi cadastrado',
            'cpf_cliente.integer' => 'O campo tem que ser exclusivamente de numeros inteiros'
        ];
    }



}
