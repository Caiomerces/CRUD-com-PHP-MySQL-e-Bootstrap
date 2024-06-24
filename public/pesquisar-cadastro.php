<?php
// Incluir o arquivo da classe Cliente (se necessário)
require '../public/classes/Cliente.php';

//Zerar as variáveis
    $nome = "";
    $email = "";
    $confirmarEmail = "";
    $senha = "";

    if ($_SERVER ["REQUEST_METHOD"] == "POST"){
        #Tentar conectar com o banco
      //Enviar os parâmetros de conexão para as variáveis
		$host 	= "localhost";
		$db 	= "cadastrodeclientes";
		$user 	= "root";
		$pass 	= "";

		try {
			$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
			// definir tratamento de erros
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $id = $_POST['id'];

            $sql = "SELECT * FROM clientes WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);   

            if ($row) {
                $nome = $row['nome'];
                $email = $row['email'];
                $confirmarEmail = $row['confirmarEmail'];
                $senha = $row['senha'];
            } else {
                //Zerar as variáveis
                $nome = $email = $confirmarEmail = $senha = "";
            }
        } catch (PDOExeption $e) {
                echo "Erro: " . $e->getMessage();
            }
	} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa e atualização de cadastro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Pesquisar cadastro</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <label for="id">ID:</label>
            <input type="text" name="id"><br><br>
            
            <input type="submit" class="btn btn-secondary" name="Pesquisar" value="Pesquisar">
            <a href="../public/index.php" class="btn btn-primary">Voltar</a>
        </form>

        <hr>
        <?php if (!empty($nome)) { ?>
        <!-- Formulário de atualização de cadastro -->
        <h2>Formulário de atualização de cadastro</h2>
        <form action="../public/atualizar-cadastro.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="nome">Nome: </label>
            <input type="text" name="nome" value="<?php echo $nome; ?>">
            <br><br>

            <label for="email">Email: </label>
            <input type="email" name="email" value="<?php echo $email; ?>"> <br><br>

            <label for="confirmarEmail">Confirmar Email: </label>
            <input type="email" name="confirmarEmail" value="<?php echo $confirmarEmail; ?>"> <br><br>

            <label for="senha">Senha: </label>
            <input type="text" name="senha" value="<?php echo $senha; ?>"> <br><br>

            <input type="submit" class="btn btn-secondary" value="Atualizar">
            
        </form>   
        <form action="../public/delete-cadastro.php" method="post" style="margin-top: 20px;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" class="btn btn-danger" value="Excluir">
        </form>
       
    </div>
    <?php } else { ?> 
        <form action="../public/atualiza.php" method="post">
            <input type="hidden" name="id" disabled>

            <label for="nome">Nome: </label>
            <input type="text" name="nome" placeholder ="Nome" disabled>
            <br><br>

            <label for="email">Email: </label>
            <input type="email" name="email" placeholder ="Email" disabled> <br><br>

            <label for="confirmarEmail">Confirmar Email: </label>
            <input type="email" name="confirmarEmail" placeholder ="Confirmar Email" disabled> <br><br>

            <label for="senha">Senha: </label>
            <input type="text" name="senha" placeholder ="Senha" disabled> <br><br>

            <input type="submit" class="btn btn-secondary" value="Atualizar" disabled>
             <!-- Formulário de exclusão de cadastro -->
        </form>              
        <form action="../public/delete-cadastro.php" method="post" style="margin-top: 20px;" disabled>
               <input type="hidden" name="id" value="<?php echo $id; ?>" disabled>
               <input type="submit" class="btn btn-danger" value="Excluir" disabled>
        </form>
         
    <?php } ?>
    
    <!-- Bootstrap JS e dependências -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Arquivos JavaScript (incluindo Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>