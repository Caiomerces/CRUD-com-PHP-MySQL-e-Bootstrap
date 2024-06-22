<?php
// Incluir o arquivo de conexão ao banco de dados
require '../connectDataBase/conexao.php';

// Incluir o arquivo da classe Cliente
require '../public/classes/Cliente.php';

// Verificar se é uma requisição do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Capturar os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        // Instanciar a classe Cliente e cadastrar o cliente
        $cliente = new Cliente($pdo);
        $cliente->cadastrar($nome, $email, $telefone);

        // Mensagem de sucesso
        $mensagem = "Usuário cadastrado com sucesso";

    } catch (PDOException $e) {
        // Em caso de erro no cadastro, capturar a mensagem de erro
        $mensagem = "Erro ao cadastrar usuário: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">

        <!-- Mensagem de sucesso -->
        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($mensagem); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Botão para voltar -->
        <a href="../public/index.php" class="btn btn-secondary">Voltar</a>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
