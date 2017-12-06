<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos
{

    private $conexao;
    private $produto;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria, quantidade_estoque, codigo =  NULL ) VALUES ('$produto->nome', $produto->preco, '$produto->categoria','$produto->quantidade_estoque')";

        $this->conexao->exec($sql);
    }

    public function getProduto(int $codigo)
    {
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE codigo = $codigo");
        $produto = $consulta->fetch(PDO::FETCH_ASSOC); //SEMELHANTES JSON ENCODE E DECODE

        return new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidade_estoque'], $produto['codigo']);
    }

    public function getProdutos()
    {
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos");
        $arrayProdutos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //Fábrica de Produtos
        $listaProdutos = [];
        foreach ($arrayProdutos as $produto) {
            $listaProdutos[] = new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidade_estoque'], $produto['codigo']);

        }

        return $listaProdutos;
    }

    public function excluir(int $codigo)
    {

        $this->conexao->exec("DELETE FROM tb_produtos WHERE codigo  = $codigo");

    }

    public function editar(Produto $produto) {


        $this->conexao->exec("UPDATE tb_produtos
        SET nome= '$produto->nome', preco = $produto->preco, categoria= '$produto->categoria', quantidade_estoque=$produto->quantidade_estoque
        WHERE codigo=$produto->codigo");

    }

    public function buscar($busca = null)
    {
        $this->conexao->query("SELECT * FROM tb_produtos WHERE codigo = $codigo");
        $encontrado = [];

        if ($busca == null || $busca == "") {
            $encontrado = $this->getProdutos();
        } else {
            foreach ($listaProdutos as $produto) {
                if ($produto['nome'] == $busca) {
                    $encontrado[] = $produto;
                }
            }
        }
        return $encontrado;

    }

}

