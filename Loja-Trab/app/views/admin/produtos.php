<?php

require_once __DIR__."/../../models/CrudProdutos.php";
$crud = new CrudProdutos();

$listaProdutos = $crud->getProdutos();

require_once "cabecalho.php";

?>

<!--Barra de busca-->
<div class="row">
    <div class="col-md-12">
        <div class="input-group">
            <input type="text" name="pesquisar" formmethod="post" class="form-control" placeholder="Digite o nome do produto" aria-describedby="basic-addon2">
            <button type="submit" class="input-group-addon" id="basic-addon2">Buscar</button>
        </div>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Produto</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
            <?php foreach ($listaProdutos as $pro): ?>
                <tr>
                    <th scope="row"><?= $pro->codigo?></th>
                    <td><?= $pro->nome ?></td>
                    <td><?= $pro->preco ?></td>
                    <td><?= $pro->quantidade_estoque ?></td>
                    <td><?= $pro->categoria ?></td>
                    <td><a href="editar-produto.php?codigo=<?= $pro->codigo ?>">Editar</a> |
                        <a href="../../controllers/controladorProduto.php?acao=excluir&codigo=<?= $pro->codigo ?>"> Remover</a></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

<?php
require_once "rodape.php";

?>

