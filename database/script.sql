CREATE DATABASE crudphpsimples;

USE crudphpsimples;

CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  quantidade INT NOT NULL,
  data_de_validade DATE NOT NULL
);