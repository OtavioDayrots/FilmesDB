<?php

// Define a classe 'Database' para gerenciar a conexão com o banco de dados
class Database {
    
    // Declaração de variáveis privadas para armazenar as informações de conexão
    private $host;      // Endereço do servidor do banco de dados
    private $port;      // Porta usada para a conexão com o banco
    private $username;  // Nome de usuário para autenticação
    private $password;  // Senha para autenticação
    private $db;        // Nome do banco de dados a ser acessado

    private $conn;      // Variável que armazenará a conexão com o banco de dados

    // Construtor da classe, responsável por inicializar os atributos com os parâmetros de conexão
    public function __construct($host, $port, $username, $password, $db) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
    }

    // Método que cria a conexão com o banco de dados
    public function createConnection() {
        // Monta a string de conexão usando os atributos da classe
        $connUrl = "mysql:host=$this->host;port=$this->port;dbname=$this->db";

        // Cria uma nova conexão PDO, passando a URL de conexão, o nome de usuário e a senha
        $this->conn = new PDO($connUrl, $this->username, $this->password);

        // Retorna a conexão criada
        return $this->conn;
    }
}

// Instancia um objeto da classe 'Database' com os parâmetros de conexão específicos
$database = new Database(
    "localhost", // Endereço do servidor
    3306,        // Porta do banco de dados MySQL
    "root",      // Nome de usuário
    "",          // Senha (neste caso, vazia)
    "filmesdb"   // Nome do banco de dados a ser acessado
);

// Estabelece a conexão com o banco chamando o método 'createConnection' do objeto 'Database'
$conn = $database->createConnection();

?>
