<?php

    require_once "cabecalho.php";
    require_once "rodape.php";

    require_once "../../models/CrudProdutos.php";

    $crud = new CrudProdutos();

    //seguranca
    $codigo = filter_input(INPUT_GET, 'codigo', FILTER_VALIDATE_INT);

    $produto = $crud->getProduto($codigo);

?>

<h2>Editar Produtos</h2>
<form action="../../controllers/controladorProduto.php?acao=editar&codigo=<?= $codigo; ?>" method="post">
    <div class="form-group">
        <label for="produto">Produto:</label>
        <input value="<?= $produto->nome ?>" name="nome" type="text" class="form-control" id="produto" aria-describedby="nome produto" placeholder="Digite o produto">
    </div>

    <div class="form-group">
        <label for="preco">Preco</label>
        <input value="<?= $produto->preco ?>" name="preco" type="number" step="0.01" class="form-control" id="preco" placeholder="Digite o preço">
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input value="<?= $produto->quantidade_estoque ?>" name="estoque" type="number" class="form-control" id="quantidade" placeholder="Digite a quantidade">
    </div>

    <div class="form-group">
        <label for="Categoria">Categoria</label>
        <select name="categoria" class="form-control" id="Categoria">
            <option <?php if ($produto->categoria == "Acessórios"){ echo "selected"; } ?> >Acessórios</option>
            <option <?php if ($produto->categoria == "Camisetas"){ echo "selected"; } ?> >Camisetas</option>
            <option <?php if ($produto->categoria == "Canecas"){ echo "selected"; } ?> >Canecas</option>
            <option <?php if ($produto->categoria == "Chaveiros"){ echo "selected"; } ?> >Chaveiros</option>
        </select>
    </div>

    <input name="codigo" type="hidden" value="<?= $codigo; ?>">

    <button type="submit" class="btn btn-primary">Atualizar Produto</button>

</form>