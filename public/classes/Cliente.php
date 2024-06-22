<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $email, $telefone) {
        try {
            // Preparar a query SQL para inserir o cliente
            $sql = "INSERT INTO clientes (nome, email, telefone) VALUES (:nome, :email, :telefone)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $stmt->execute();

            // Exibir mensagem de sucesso
            return "Usuário cadastrado com sucesso";
        } catch (PDOException $e) {
            // Em caso de erro no cadastro, exibir mensagem de erro
            echo "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }
}
?>
