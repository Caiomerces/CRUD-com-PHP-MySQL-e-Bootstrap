<?php
// Incluir o arquivo de conexão ao banco de dados
require '../connectDataBase/conexao.php';
// Incluir o arquivo da classe Cliente (se necessário)
require '../public/classes/Cliente.php';

$clientes = []; // Inicializa a variável $clientes como um array vazio

// Função para listar os clientes com filtro de pesquisa
function listarClientes($pdo, $termo_pesquisa = '') {
    try {
        // Preparar a query SQL para buscar clientes com filtro de pesquisa pelo nome
        $sql = "SELECT cod_cliente, nome, email, telefone FROM clientes";
        
        // Se houver um termo de pesquisa, adiciona a cláusula WHERE
        if (!empty($termo_pesquisa)) {
            $sql .= " WHERE nome LIKE :termo";
        }

        $stmt = $pdo->prepare($sql);

        // Se houver um termo de pesquisa, vincula o parâmetro
        if (!empty($termo_pesquisa)) {
            $stmt->bindValue(':termo', '%' . $termo_pesquisa . '%', PDO::PARAM_STR);
        }
        
        $stmt->execute();

        // Retornar os resultados como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Em caso de erro, exibir mensagem de erro
        echo "Erro ao listar clientes: " . $e->getMessage();
        return []; // Retorna um array vazio em caso de erro
    }
}

// Verifica se o formulário de pesquisa foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesquisar'])) {
    $termo_pesquisa = $_POST['termo_pesquisa'];
    $clientes = listarClientes($pdo, $termo_pesquisa);
} else {
    // Caso contrário, lista todos os clientes
    $clientes = listarClientes($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Listagem de Clientes</h2>

        <!-- Formulário de pesquisa -->
        <form method="post" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pesquisar cliente por nome" name="termo_pesquisa" value="<?php echo isset($termo_pesquisa) ? htmlspecialchars($termo_pesquisa) : ''; ?>">
                <button type="submit" class="btn btn-outline-primary" name="pesquisar">Pesquisar</button>
            </div>
        </form>

        <?php if (!empty($clientes)): ?>
            <!-- Tabela de resultados da pesquisa -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cliente['cod_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum cliente encontrado.</p>
        <?php endif; ?>
        
        <a href="../public/index.php" class="btn btn-primary">Voltar</a>
    </div>
    
    <!-- Bootstrap JS e dependências -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Arquivos JavaScript (incluindo Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>