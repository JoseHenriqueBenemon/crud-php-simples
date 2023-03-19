<?php

class Produto {
    public $id;
    public $nome;
    public $quantidade;
    public $data_de_validade;

    // Construct que não pede nenhum argumento
    public function __construct() {
        $this->id = null;
        $this->nome = null;
        $this->quantidade = null;
        $this->data_de_validade = null;
    }

    // Fake construct que armaneza todos os argumentos
    public function construct($id, $nome, $quantidade, $data_de_validade) {
        $this->id = htmlentities($id);
        $this->nome = htmlentities($nome);
        $this->quantidade = htmlentities($quantidade);
        $this->data_de_validade = htmlentities($data_de_validade);
    }

    // Fake construct que armaneza os argumentos sem o Id
    public function construct2($nome, $quantidade, $data_de_validade) {
        $this->nome = htmlentities($nome);
        $this->quantidade = htmlentities($quantidade);
        $this->data_de_validade = htmlentities($data_de_validade);
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getDataDeValidade() {
        return $this->data_de_validade;
    }
}

?>