<?php


// O Controlador é a peça de código que sabe qual classe chamar, para onde redirecionar e etc.
// Use o método $_GET para obter informações vindas de outras páginas.

    require_once __DIR__."/../models/Produto.php";
    require_once __DIR__. "/../models/CrudProdutos.php";

if ($_GET['acao'] == 'cadastrar'){

    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade']);
    $crud = new CrudProdutos();
    $crud->salvar($produto);

    header('location: ../views/admin/produtos.php');
}

if ( $_GET['acao'] == 'editar'){

    //algoritmo para editar
    $crud = new CrudProdutos();
    $crud->editar($_GET['codigo'],$_POST['nome'],$_POST['preco'],$_POST['quantidade'],$_POST['categoria']);

    //redirecione para a página de produtos
    header("Location: ../views/admin/produtos.php");
}

if ($_GET['acao'] == 'excluir'){

    $crud = new CrudProdutos();
    $crud->excluir($_GET['codigo']);

    header("location: ../views/admin/produtos.php");
}
//if ( $_GET['acao'] == 'comprar'){
//    $crud = new CrudProdutos();
//    $produto = $crud->getProduto($_GET['codigo']);
//    $produto['quantidade_estoque'] -= $_POST['quantidade_nova'];
//    $crud->editar($produto['codigo'],$produto['nome'],$produto['preco'],$produto['quantidade_estoque'],$produto['categoria']);
//    header("Location: ../../index.php");
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