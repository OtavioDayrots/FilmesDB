<?php

// classe Model que representa a tabela filme no db
class Filme {
    private $table = "filme";

    private $conn;

    // colunas da tabela
    public $id;
    public $titulo;
    public $ano;
    public $descricao;
    public $img_link;

    // parâmetro de connexão opcional
    public function __construct($conn = null) {
        $this->conn = $conn;
    }

    // método responsável por buscar todos os filmes
    public function findAll() {
        $query = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

        return $stmt->fetchAll();
    }

    // método responsável por buscar 1 o filme
    public function findById($id) {
        $query = "SELECT * FROM $this->table
            WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        // Configurando o PDO para comparar inteiros
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        // configura o PDO para retornar uma instância da classe
        // como resultado da consulta.
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

        return $stmt->fetch();
    }

    public function remover($id) {
        $query = "DELETE FROM $this->table
        WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;  
    }

    public function adicionar($img_link, $titulo, $ano, $descricao){
        $query = "INSERT INTO $this->table (img_link, titulo, ano, descricao)
        Values(:img_link, :titulo, :ano, :descricao)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":img_link", $img_link);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":ano", $ano);
        $stmt->bindParam(":descricao", $descricao);
        
        $stmt->execute();

        return $stmt->rowCount() > 0; 
    }

    public function editar($id, $img_link, $titulo, $ano, $descricao) {
        $query = "UPDATE $this->table
        SET img_link = :img_link, titulo = :titulo, ano = :ano, descricao = :descricao
        WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":img_link", $img_link, PDO::PARAM_STR);
        $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $stmt->bindParam(":ano", $ano, PDO::PARAM_INT);
        $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
        
        $stmt->execute();

         // Executa a query e verifica o resultado
        if ($stmt->execute()) {
            return true; // Retorna verdadeiro se ao menos 1 linha foi alterada
        } else {
            // Captura e exibe o erro
            $errorInfo = $stmt->errorInfo();
            echo "Erro: " . $errorInfo[2];
            return false;
        }
    }
}

?>