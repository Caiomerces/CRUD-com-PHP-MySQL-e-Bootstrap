<?php 

require '../connectDataBase/conexao.php';

// Incluir o arquivo da classe Cliente
require '../public/classes/Cliente.php';

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        try {
            
            $id = $_POST['id'];

            $sql = "DELETE FROM clientes WHERE id = :id";

            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            

            if ($stmt->execute()) {
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
                            <h2>Excluido com sucesso!</h2>
                            <hr>
                            <button class="btn btn-primary" onclick="history.go(-2);">Voltar</button>
                        </div>
                        
                        <!-- Bootstrap JS and dependencies -->
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                            <!-- Arquivos JavaScript (incluindo Popper) -->
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                    </body>
                    </html> ';
            } else {
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
                            <h2>Usuário não deletado!</h2>
                            <hr>
                            <button class="btn btn-primary" onclick="history.go(-1);">Voltar</button>
                        </div>

                        <!-- Bootstrap JS and dependencies -->
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                            <!-- Arquivos JavaScript (incluindo Popper) -->
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                    </body>
                    </html> ';
                    }   
            } catch (PDOException $e) {
                // Em caso de erro no cadastro, capturar a mensagem de erro
                echo "Erro: " . $e->getMessage();
            }
    }else {
        echo "Você não tem permissão para acessar o site!";
    }
?>