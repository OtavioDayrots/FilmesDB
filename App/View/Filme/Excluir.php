<?php

// Inclui o arquivo de configuração do banco de dados para estabelecer a conexão
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Filme', que contém os métodos para manipular dados da tabela de filmes
require __dir__ . "\..\..\Model\Filme.php";

// Verifica se o método de requisição não é POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Se não for uma requisição POST, redireciona para 'Listar.php' com uma mensagem de sucesso
    header("Location: Listar.php?mensagem=Sucesso");
    exit; // Encerra o script para garantir que o redirecionamento ocorra
}

// Cria uma instância do modelo 'Filme' passando a conexão do banco de dados como parâmetro
$filmeModel = new Filme($conn);

// Obtém o ID do filme a ser excluído do campo 'id' do formulário enviado via POST
$id = $_POST["id"];

// Chama o método 'remover' do modelo 'Filme', passando o ID do filme, e armazena o resultado na variável '$sucesso'
$sucesso = $filmeModel->remover($id);

// Verifica se a exclusão foi bem-sucedida
if ($sucesso === true) {
    // Se a exclusão foi bem-sucedida, redireciona para 'Listar.php' com uma mensagem de sucesso
    header("Location: Listar.php?status=Excluir&mensagem=Sucesso");
    exit; // Encerra o script para garantir o redirecionamento
} else {
    // Se a exclusão falhou, redireciona para 'Listar.php' com uma mensagem de erro
    header("Location: Listar.php?status=Excluir&mensagem=Erro");
    exit; // Encerra o script para garantir o redirecionamento
}

?>
