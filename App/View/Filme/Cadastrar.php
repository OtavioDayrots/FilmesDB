
<?php


// Inclui o arquivo de configuração do banco de dados para estabelecer a conexão
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Filme', que contém métodos para manipular dados da tabela de filmes
require __dir__ . "\..\..\Model\Filme.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["titulo"]) && isset($_POST["ano"])){

        // Cria uma instância do modelo 'Filme' com a conexão do banco de dados
        $filmeModel = new Filme($conn);

        $img_link = $_POST["img_link"];
        $titulo = $_POST["titulo"];
        $ano = $_POST["ano"];
        $descricao = $_POST["descricao"];

        // Chama o método 'remover' do modelo 'Filme', passando o ID do filme, e armazena o resultado na variável '$sucesso'
        $sucesso = $filmeModel->adicionar($img_link, $titulo, $ano, $descricao);

        // Verifica se a exclusão foi bem-sucedida
        if ($sucesso === true) {
            // Se a exclusão foi bem-sucedida, redireciona para 'Listar.php' com uma mensagem de sucesso
            header("Location: Listar.php?status=Cadastro&mensagem=Sucesso");
            exit; // Encerra o script para garantir o redirecionamento
        } else {
            // Se a exclusão falhou, redireciona para 'Listar.php' com uma mensagem de erro
            header("Location: Listar.php?status=Cadastro&mensagem=Erro");
            exit; // Encerra o script para garantir o redirecionamento
        }
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar filme</title>

    <link rel="stylesheet" href="Style/reset.css">
    <link rel="stylesheet" href="Styles/cadastrar.css">
</head>
<body>
    <h1>Cadastro de Filme</h1>
    <main>
        <form action="Cadastrar.php" method="POST">
            <div>
                <label for="img_link">Link da Capa</label>
                <input type="text" name="img_link" placehouder="Infomre o link da capa" require>
            </div>
            <div>
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" placehouder="Infomre o nome" require>
            </div>
            <div>
                <label for="ano">Ano</label>
                <input type="number" name="ano" placehouder="Informe o Ano" require>
            </div>
            <div>
                <label for="descricao"></label>
                <textarea name="descricao" id="descricao" rows="5"></textarea>
            </div>
            <div class="botoes">
                <a href="Listar.php">Voltar</a>
                <button>Salvar</button>
            </div> 
    </main>

    </form>
</body>
</html>

