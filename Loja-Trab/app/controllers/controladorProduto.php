<?php


// O Controlador é a peça de código que sabe qual classe chamar, para onde redirecionar e etc.
// Use o método $_GET para obter informações vindas de outras páginas.

    require_once __DIR__."/../models/Produto.php";
    require_once __DIR__. "/../models/CrudProdutos.php";

if ($_GET['acao'] == 'cadastrar'){

    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade_estoque']);
    $crud = new CrudProdutos();
    $crud->salvar($produto);

    header('location: ../views/admin/produtos.php');
}

if ($_GET['acao'] == 'editar'){

    $crud = new CrudProdutos();

    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade_estoque']);

    $crud->editar($produto);

    header("location: ../views/admin/produtos.php");
}

if ($_GET['acao'] == 'excluir'){

    $crud = new CrudProdutos();
    $crud->excluir($_GET['codigo']);

    header("location: ../views/admin/produtos.php");
}
//if ( $_GET['acao'] == 'comprar') {
//    $crud = new CrudProdutos();
//    $produto = $crud->getProduto($_GET['codigo']);
//    $produto['quant_estoque'] -= $_POST['quantidade_nova'];
//    $crud->editar($produto['nome'], $produto['preco'], $produto['quantidade_estoque'], $produto['categoria']);
//
//    header("Location: ../views/admin/produtos.php");
//}
    function buscar($nome)
{

    $crud = new CrudProdutos();
    $produtos = $crud->getProdutos();
    $encontrados = [];
    if ($nome == null) {
        return $produtos;
    } else {

        foreach ($produtos as $produto) {
            if ($nome == $produto['nome']) {
                $encontrados[] = $produto;
            }
        }

        return $encontrados;
    }
}