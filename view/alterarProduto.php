<?php
require '../controller/Produto.php';
require '../model/DaoProduto.php';
require '../conn/Conexao.php';

// Criando objeto Produto
$conn = new Connection();

if(isset($_GET['id'])) {
    // Pega o id da URL
    $id = $_GET['id'];

    // Pegando o objeto Produto do model
    $model = new ProdutoModel($conn->getConnection());
    $produtos = $model->getProdutoById($id);

} else { // Caso não tenha ida na url da página o usuário é redirecionado para a página principal
    header("Location: manterProduto.php");
    exit();
    die("Falta de argumento na URL");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Criar Produto</title>
</head>
<body>
    <div id='formulario'>
        <div class="your-content">
            <form action="manterProduto.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $produtos->nome ?>" required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= $produtos->quantidade ?>" required>
                </div>
                <div class="form-group">
                    <label for="data_de_validade">Data de Validade:</label>
                    <input type="date" class="form-control" id="data_de_validade" name="data_de_validade" value="<?= $produtos->data_de_validade ?>" required>
                </div>

                <input type="hidden" name="id" id="id" value="<?=$id?>">
                <button type="submit" class="btn btn-primary" name="alter">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>

