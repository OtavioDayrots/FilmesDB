<?php 

class Usuario{
    private $table = "Usuario";

    private $conn;

    public $id;
    public $nome;
    public $email;
    public $nascimento;

    public function __construct($conn = null){
        $this->conn = $conn;
    }

    public function findAll(){
        $query = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($query);
        $stmt-> execute();
        $stmt-> setFetchMode(PDO::FETCH_CLASS, __CLASS__);

        return $stmt->fetchAll();
    }

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

    public function remover($id){
        $query = "DELETE FROM $this->table
        WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;

    }
}

?>