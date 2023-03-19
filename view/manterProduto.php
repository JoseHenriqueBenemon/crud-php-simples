<?php
require '../controller/Produto.php';
require '../model/DaoProduto.php';
require '../conn/Conexao.php';

// Criando objeto Produto
$conn = new Connection();

if(isset($_POST['add'])){
    // Recebendo dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $quantidade = htmlspecialchars($_POST['quantidade']);
    $data_de_validade = htmlspecialchars($_POST['data_de_validade']);

    // Instancianod o objeto Produto
    $produto = new Produto();
    $produto->construct2($nome, $quantidade, $data_de_validade);

    // Passando objeto Produto para o model
    $model = new ProdutoModel($conn->getConnection());
    $model->addProduto($produto);
} else if(isset($_POST['alter'])){
    // Recebendo dados do formulário
    $id = htmlspecialchars($_POST['id']);
    $nome = htmlspecialchars($_POST['nome']);
    $quantidade = htmlspecialchars($_POST['quantidade']);
    $data_de_validade = htmlspecialchars($_POST['data_de_validade']);
    
    // Instancianod o objeto Produto
    $produto = new Produto();
    $produto->construct($id, $nome, $quantidade, $data_de_validade);

    // Passando objeto Produto para o model
    $model = new ProdutoModel($conn->getConnection());
    $model->updateProduto($produto);
}

// Pegando o objeto Produto do model
$model = new ProdutoModel($conn->getConnection());
$produtos = $model->getAllProdutos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Produtos</title>
</head>
<body>

<div class="container">
    <h1>Produtos</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Data de validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($produtos)){
                    foreach ($produtos as $produto) { ?>
                <tr>
                    <td><?php echo $produto->id; ?></td>
                    <td><?php echo $produto->nome; ?></td>
                    <td><?php echo $produto->quantidade; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($produto->data_de_validade)); ?></td>
                    <td>
                        <a href='alterarProduto.php?id=<?=$produto->id?>' class="btn btn-warning btn-sm">Alterar</a>
                        <a href='excluirProduto.php?id=<?=$produto->id?>' class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php }
                } ?>
        </tbody>
    </table>
    <br />
    <a href="criarProduto.php" class="btn btn-primary">Adicionar Produto</a>
</div>


</body>
</html>