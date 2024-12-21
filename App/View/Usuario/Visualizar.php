<?php

// Inclui o arquivo de configuração do banco de dados para estabelecer a conexão
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Usuario', que contém métodos para manipular dados da tabela de Usuarios
require __dir__ . "\..\..\Model\Usuario.php";

// Cria uma instância do modelo 'Usuario' com a conexão do banco de dados
$usurioModel = new Usuario($conn);

// Obtém o ID do Usuario a ser exibido, que foi passado como parâmetro na URL via GET
$id = $_GET["id"];

// Chama o método 'findById' do modelo 'Usuario', passando o ID do Usuario, e armazena o resultado na variável '$usurio'
$usurio = $usurioModel->findById($id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Define o charset como UTF-8 para suporte a caracteres especiais -->
    <meta charset="UTF-8">
    
    <!-- Configura a visualização para dispositivos móveis, definindo a escala inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Define o título da página -->
    <title>Usuario</title>

    <!-- Inclui o arquivo de CSS reset para remover estilos padrões dos navegadores -->
    <link rel="stylesheet" href="Styles/reset.css">
    
    <style>
        /* Estilos da página */
        
        /* Define a cor de fundo, cor do texto e fonte da página */
        body {
            background-color: #181616;
            color: #fdfdfd;
            font-family: 'Arial', Times, serif;
        }

        /* Estilo da seção principal que contém o conteúdo do Usuario */
        main {
            margin: 0 auto; /* Centraliza horizontalmente */
            margin-top: 25vh; /* Define uma margem superior para posicionamento */
            width: 600px; /* Largura fixa */
            background-color: #1d1d1d; /* Cor de fundo */
            border-radius: 15px; /* Bordas arredondadas */
            text-align: center; /* Centraliza o texto */
        }

        /* Estilo dos títulos */
        h1, h3 {
            padding: 1rem; /* Espaçamento interno */
        }

        /* Define o tamanho da fonte do título principal */
        h1 {
            font-size: 28px;
        }

        /* Estilo do botão */
        button {
            background-color: rgb(71, 190, 12); /* Cor de fundo verde */
            padding: .5rem; /* Espaçamento interno */
            border-radius: 15px; /* Bordas arredondadas */
            margin: 1rem; /* Espaçamento externo */
            width: 200px; /* Largura fixa */
        }

        /* Estilo do link */
        a {
            text-decoration: none; /* Remove o sublinhado do link */
            color: #fff; /* Define a cor do texto do link como branco */
        }

    </style>

</head>
<body>
    <!-- Seção principal que exibe as informações do Usuario -->
    <main>
        <!-- Título principal da página -->
        <h1>Usuario</h1>

        <!-- Exibe o título do Usuario usando o valor retornado pelo banco de dados -->
        <h3>Nome: <?php echo $usurio->nome; ?></h3>
        
        <!-- Exibe o ano de lançamento do Usuario -->
        <h3>E-mail: <?php echo $usurio->email; ?></h3>
        
        <!-- Exibe a descrição do Usuario -->
        <h3>Nascimento: <?php echo $usurio->nascimento; ?></h3>

        <!-- Botão para voltar à lista de Usuarios -->
        <button><a href="User.php">Voltar a lista</a></button>
    </main>
</body>
</html>
