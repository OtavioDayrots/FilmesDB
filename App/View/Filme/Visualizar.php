<?php

// Inclui o arquivo de configuração do banco de dados para estabelecer a conexão
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Filme', que contém métodos para manipular dados da tabela de filmes
require __dir__ . "\..\..\Model\Filme.php";

// Cria uma instância do modelo 'Filme' com a conexão do banco de dados
$filmeModel = new Filme($conn);

// Obtém o ID do filme a ser exibido, que foi passado como parâmetro na URL via GET
$id = $_GET["id"];

// Chama o método 'findById' do modelo 'Filme', passando o ID do filme, e armazena o resultado na variável '$filme'
$filme = $filmeModel->findById($id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Define o charset como UTF-8 para suporte a caracteres especiais -->
    <meta charset="UTF-8">
    
    <!-- Configura a visualização para dispositivos móveis, definindo a escala inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Define o título da página -->
    <title>Filme solo</title>

    <!-- Inclui o arquivo de CSS reset para remover estilos padrões dos navegadores -->
    <link rel="stylesheet" href="Styles/reset.css">
    
    <link rel="stylesheet" href="Styles/vizualizar.css">

</head>
<body>
    <!-- Seção principal que exibe as informações do filme -->
    <main>
        <!-- Título principal da página -->
        <h1>Filme</h1>

        <figure>
            <img src="<?php echo $filme->img_link; ?>" alt="Capa do Filme">
        </figure>
        <!-- Exibe o título do filme usando o valor retornado pelo banco de dados -->
        <h3>Título: <?php echo $filme->titulo; ?></h3>
        
        <!-- Exibe o ano de lançamento do filme -->
        <h3>Ano: <?php echo $filme->ano; ?></h3>
        
        <!-- Exibe a descrição do filme -->
        <h3>Descrição: <?php echo $filme->descricao; ?></h3>

        <!-- Botão para voltar à lista de filmes -->
        <button><a href="Listar.php">Voltar à lista</a></button>
    </main>
</body>
</html>
