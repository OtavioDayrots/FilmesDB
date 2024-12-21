<?php
// Inclui o arquivo de configuração do banco de dados para estabelecer a conexão
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Filme', que contém métodos para manipular dados da tabela de filmes
require __dir__ . "\..\..\Model\Filme.php";

// Cria uma instância do modelo 'Filme' com a conexão do banco de dados
$filmeModel = new Filme($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["titulo"]) && isset($_POST["ano"]) && isset($_POST["id"])) {

        $id = $_POST["id"];
        $img_link = $_POST["img_link"];
        $titulo = $_POST["titulo"];
        $ano = $_POST["ano"];
        $descricao = $_POST["descricao"];

        // Chama o método 'editar' do modelo 'Filme', passando os dados do filme
        $sucesso = $filmeModel->editar($id, $img_link, $titulo, $ano, $descricao);

        // Verifica se a edição foi bem-sucedida
        if ($sucesso === true) {
            // Se a atualização foi bem-sucedida, redireciona para 'Listar.php' com uma mensagem de sucesso
            header("Location: Listar.php?status=Atualizado&mensagem=Sucesso");
            exit; // Encerra o script para garantir o redirecionamento
        } else {
            // Se a atualização falhou, redireciona para 'Listar.php' com uma mensagem de erro
            header("Location: Listar.php?status=Atualizado&mensagem=Erro");
            exit; // Encerra o script para garantir o redirecionamento
        }
    }
} else {
    // Obtém o ID do filme a ser exibido, que foi passado como parâmetro na URL via GET
    $id = $_GET["id"];

    // Chama o método 'findById' do modelo 'Filme', passando o ID do filme, e armazena o resultado na variável '$filme'
    $filme = $filmeModel->findById($id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>

    <link rel="stylesheet" href="Style/reset.css">
    <link rel="stylesheet" href="Styles/cadastrar.css">
</head>

<body>
    
    <h1>Editar <?php echo $filme->titulo; ?></h1>
    <main>
        <form action="Editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $filme->id; ?>">
            <div>
                <label for="img_link">Link da Capa</label>
                <input type="text" name="img_link" value="<?php echo $filme->img_link; ?>" required>
            </div>
            <div>
                <label for="titulo">Título</label>
                <input type="text" name="titulo" value="<?php echo $filme->titulo; ?>" required>
            </div>
            <div>
                <label for="ano">Ano</label>
                <input type="number" name="ano" value="<?php echo $filme->ano; ?>" required>
            </div>
            <div>
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" rows="5"><?php echo $filme->descricao; ?></textarea>
            </div>
            <div class="botoes">
                <a href="Listar.php">Voltar</a>
                <button>Salvar</button>
            </div>
        </form>
    </main>
</body>
</html>
