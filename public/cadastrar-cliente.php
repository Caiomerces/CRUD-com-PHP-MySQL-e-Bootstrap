<?php
require_once '../config/conexao.php'; // Inclui o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Captura os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        // Prepara e executa a query SQL para inserir o cliente
        $sql = "INSERT INTO clientes (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->execute();

        // Exibe mensagem de sucesso
        echo "Usuário inserido com sucesso";

    } catch (PDOException $e) {
        // Em caso de erro no cadastro, exibe mensagem de erro
        echo "Erro ao cadastrar usuário: " . $e->getMessage();
    }
} else {
    // Se não for uma requisição POST, redireciona para a página de cadastro
    header("Location: cadastro.html");
    exit;
}
?>
