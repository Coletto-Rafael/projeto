
<?php
require_once ('./cabecalho.php');
require_once ('./carrinho.php');
require_once ('./produtoDAO.php');
verificaLogin();
?>

<div class="well well-lg">
    <div class="panel-body">
        <h3>Lista de Produtos Selecionados</h3>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto Selecionado</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
                <th>Remover</th>
            </tr>
        </thead>
        <form action="carrinho.php?acao=atu" method="post">
            <tbody>
                <?php
                if (count($_SESSION['carrinho']) == 0) {
                    echo '<tr>
                            <td>Não há produtos no carrinho!</td>
                         </tr>';
                } else {
                    $total = 0;
                    foreach ($_SESSION['carrinho'] as $id => $qtd) {
                        $ln = getProdutoId($id);

                        $nome = $ln['nome'];
                        $preco = number_format($ln['preco'], 2, ',', '.');
                        $sub = number_format($ln['preco'] * $qtd, 2, ',', '.');

                        $total += $ln['preco'] * $qtd;
                        ?>
                        <tr>
                            <td><?= $nome ?></td>
                            <td><?= $preco ?></td>
                            <td><?= $sub ?></td>
                            <td><input style="width: 50px;" type="number" min="0" name="prod['<?= $id ?>']" value="<?= $qtd ?>"></td>
                            <td><a href="carrinho.php?acao=del&id=<?= $id ?>" class="buttoncabe"><i class="fa fa-times"> Remover</i></a></td>
                        </tr>
                    <?php
                    }
                    $total = number_format($total, 2, ',', '.');
                    ?>
                    <tr>
                        <td colspan="5"><i class="pull-right">R$: <?= $total ?></i></td>
                    </tr>
<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <button type="submit" class="btn btn-success">Atualizar Carrinho</button>
                        <button type="button" onclick="location.href = 'vitrine.php'" class="btn btn-info">Voltar aos produtos</button>
                        <button type="button" onclick="#" class="btn btn-danger pull-right">Finalizar Compra</button>
                    </td>
                </tr>
            </tfoot>
    </table>
</div>

<?php require_once ('./rodape.php'); ?>