<?php
require '../connectDataBase/conexao.php';
// Incluir o arquivo da classe Cliente
require '../public/classes/Cliente.php';

// Verificar se é uma requisição do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Capturar os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $confirmarEmail = $_POST['confirmarEmail'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO clientes (nome, email, confirmarEmail, senha) VALUES (:nome, :email, :confirmarEmail, :senha)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':confirmarEmail', $confirmarEmail, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

        $stmt->execute();

        // Exibir mensagem de sucesso (opcional)
        echo '<!DOCTYPE html>
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
    <div class="alert alert-success">
        <h2 class="h4 mb-2">Usuário inserido com sucesso!</h2>
        <a href="index.php" class="btn btn-primary">Voltar</a>
    </div>
</div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Arquivos JavaScript (incluindo Popper) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
';
    } catch (PDOException $e) {
        // Em caso de erro no cadastro, capturar a mensagem de erro
        $mensagem = "Erro ao cadastrar usuário: " . $e->getMessage();
        echo $mensagem; // Exibir o erro na página
    }
} else {
    echo "Você não tem permissão para acessar o site!";
}
?>
