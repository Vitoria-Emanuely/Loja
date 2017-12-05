<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 09/11/2017
 * Time: 10:40
 */

require_once "Conexao.php";

class Produto {

    public $codigo;
    public $nome;
    public $preco;
    public $categoria;
    public $quantidade_estoque;

    public function __construct($nome, $preco, $categoria, $quantidade_estoque, $codigo = null){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->categoria = $categoria;
        $this->quantidade_estoque = $quantidade_estoque;
        $this->codigo = $codigo;

    }

    public function estaDisponivel($quantidade_estoque){
        if ($quantidade_estoque > 0){
            echo "Disponivel";
        }else{
            echo "Indisponivel";
        }
    }

}