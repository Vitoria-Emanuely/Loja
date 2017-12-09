<?php
/**
 * Created by PhpStorm.
 * User: Supreme
 * Date: 08/12/2017
 * Time: 22:00
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
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria, quantidade_estoque) VALUES ('$produto->nome', $produto->preco, '$produto->categoria','$produto->quantidade_estoque')";

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

    public function editar($codigo,$nome,$preco,$quantidade,$categoria){

        $sql = "UPDATE tb_produtos SET nome='$nome', preco=$preco, quantidade_estoque=$quantidade,categoria='$categoria' WHERE codigo =$codigo";
        $this->conexao->exec($sql);
    }

    public function comprar(int $codigo, int $qntdDesejada){
        $p = $this->conexao->query("SELECT quantidade_estoque FROM tb_produtos WHERE codigo = $codigo")->fetch(PDO::FETCH_ASSOC);
        if ($qntdDesejada > $p['quantidade']){
            return "A quantidade desejada é maior que a disponível";
        }
        $novaQuantidade = $p['quantidade_estoque'] - $qntdDesejada;
        $this->conexao->exec("UPDATE tb_produtos SET quantidade_estoque = $novaQuantidade WHERE codigo = $codigo");
        return "Compra realizada com sucesso";
    }

    public function buscar($nome){

        $sql = "SELECT * FROM tb_produtos WHERE codigo=$codigo, nome='$nome'";
        $this->conexao->exec($sql);

        $produtos = $crud->getProdutos();
        $encontrados = [];
        if ($nome == null) {
            return $produtos;
        } else {

            foreach ($produtos as $produto) {
                if ($nome == $produto['pesquisar']) {
                    $encontrados[] = $produto;
                }
            }

            return $encontrados;
        }
    }

}

