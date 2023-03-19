<?php

class ProdutoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProdutoById($id) {
        // Preparando uma query para ser executada no banco de dados
        $stmt = $this->db->prepare("SELECT * FROM produtos WHERE id = :id");

        // Colocando o id por bindValue para evitar ataques xss
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Executando a query
        $stmt->execute();

        // Colocando os resultados dentro de uma variável específica 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Instanciando o objeto produto
        $produto = new Produto();

        // Colocando valores em no método construct
        $produto->construct($result["id"], $result["nome"], $result["quantidade"], $result["data_de_validade"]);

        // Retornando o objeto
        return $produto;
    }

    public function getAllProdutos() {
        // Preparando uma query para ser executada no banco de dados
        $stmt = $this->db->prepare('SELECT * FROM produtos');

        // Executando a query
        $stmt->execute();

        // Colocando os resultados dentro de uma variável específica 
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Criando um array de suporte
        $listaProdutos = array();

        // Passando cada valor pelo array $produto resultante do banco de dados
        foreach ($produtos as $produto) {

            // Criando uma instancia de Produto
            $prod = new Produto();

            // Instanciando um objeto usando um método construct
            $prod->construct(
                $produto['id'],
                $produto['nome'],
                $produto['quantidade'],
                $produto['data_de_validade']
            );

            // Puxando os objetos para dentro de um array final
            array_push($listaProdutos, $prod);
        }

        // Retornando o array final
        return $listaProdutos;
    }

    public function addProduto($produto) {
        // Preparando uma query para ser executada no banco de dados
        $stmt = $this->db->prepare("INSERT INTO produtos (nome, quantidade, data_de_validade) VALUES (:nome, :quantidade, :data_de_validade)");
        
        // Colocando os valores do objeto nos bindValue para evitar ataques xss
        $stmt->bindValue(':nome', $produto->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':quantidade', $produto->getQuantidade(), PDO::PARAM_INT);
        $stmt->bindValue(':data_de_validade', $produto->getDataDeValidade(), PDO::PARAM_STR);

        // Executando a query
        $stmt->execute();

        // Retornando o array do produto inserido no banco de dados
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateProduto($produto) {
        // Preparando uma query para ser executada no banco de dados
        $stmt = $this->db->prepare("UPDATE produtos SET nome = :nome, quantidade = :quantidade, data_de_validade = :data_de_validade WHERE id = :id");
        
        // Colocando os valores do objeto nos bindValue para evitar ataques xss
        $stmt->bindValue(':nome', $produto->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':quantidade', $produto->getQuantidade(), PDO::PARAM_INT);
        $stmt->bindValue(':data_de_validade', $produto->getDataDeValidade(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $produto->getId(), PDO::PARAM_INT);
       
        // Executando a query
        $stmt->execute();

        // Retornando o array do produto inserido no banco de dados
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function deleteProduto($id) {
        // Preparando uma query para ser executada no banco de dados
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");

        // Colocando o id por bindValue para evitar ataques xss
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Executando a query
        $stmt->execute();

        // Retornando o array do produto inserido no banco de dados
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

?>