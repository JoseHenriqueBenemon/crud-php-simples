<?php
require '../model/DaoProduto.php';
require '../conn/Conexao.php';

// Criando objeto Produto
$conn = new Connection();

if(isset($_GET['id'])) {
    // Pega o id da URL
    $id = $_GET['id'];

    // Pegando o objeto Produto do model
    $model = new ProdutoModel($conn->getConnection());
    $produtos = $model->deleteProduto($id);

} else { // Caso não tenha ida na url da página o usuário é redirecionado para a página principal
    header("Location: manterProduto.php");
    exit();
    die("Falta de argumento na URL");
}

header("Location: manterProduto.php");
exit();
die("Sucess delete");