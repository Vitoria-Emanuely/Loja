<?php


// O Controlador é a peça de código que sabe qual classe chamar, para onde redirecionar e etc.
// Use o método $_GET para obter informações vindas de outras páginas.

    require_once __DIR__."/../models/Produto.php";
    require_once __DIR__. "/../models/CrudProdutos.php";

if ($_GET['acao'] == 'cadastrar'){

    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade_estoque']);
    $crud = new CrudProdutos();
    $crud->salvar($produto);

    header('location: ../views/admin/produtos.php?msg=cadastro com sucesso');
}

if ($_GET['acao'] == 'editar'){

    $crud->editar($produto);

    header("location: ../views/admin/produtos.php");
}

//quando um valor da URL for igual a excluir faça isso
if ($_GET['acao'] == 'excluir'){

    //algoritmo para excluir

    $crud = new CrudProdutos();
    $crud->excluir($_GET['codigo']);

    header("location: ../views/admin/produtos.php");
}