<?php 
    $nome = $email = $confirmarEmail = $senha = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "localhost";
        $db = "cadastrodeclientes";
        $user = "root";
        $pass = "";

        try {
			$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
			// definir tratamento de erros
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $sql = "SELECT * FROM clientes WHERE email = :email ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);   

            if ($row) {        
                $emailPDO = $row['email'];
                $senhaPDO = $row['senha'];
                
                if ($senha == $senhaPDO) {
                    session_start();    
                    $_SESSION['email'] = $emailPDO;
                    header("Location: ./sistema.html");
                } else {
                    echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aula Bootstrap</title>
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Estilo customizado para ajustar a largura dos inputs -->
        <style>
            .form-signin {
                max-width: 350px;
                padding: 15px;
                margin: auto;
            }
            .form-control-narrow {
                width: 300px; /* Largura ajustada para os inputs */
            }
        </style>
    </head>
    <body class="text-center">
        <div class="container mt-5">
            <form method="post" class="form-signin" action="login.php">
                <h1 class="h3 mb-3 fw-normal">Faça login</h1>
                <div class="form-floating mb-3">
                    <input type="email" id="inputEmail" class="w-100 form-control form-control-narrow" name="email" placeholder="Seu email" required autofocus>
                    <label for="inputEmail">Endereço de email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="inputPassword" class="w-100 form-control form-control-narrow" name="senha" placeholder="Senha" required>
                    <label for="inputPassword">Senha</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembrar de mim
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
        </div>
        <!-- Modal -->
        <div id="modal" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Erro de Conexão</h5>
                       
                    </div>
                    <div class="modal-body">
                        Senha incorreta!
                    </div>
                    <div class="modal-footer">
                        <a href="../public/login.html" class="btn btn-primary">Retornar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap JS e outros scripts -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
        <script>
            // Mostrar o modal
            var modal = new bootstrap.Modal(document.getElementById("modal"), {
                keyboard: false,
                backdrop: "static"
            });
            modal.show();
        </script>
    </body>
    </html>';
   
                }
            } else {
                echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aula Bootstrap</title>
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Estilo customizado para ajustar a largura dos inputs -->
        <style>
            .form-signin {
                max-width: 350px;
                padding: 15px;
                margin: auto;
            }
            .form-control-narrow {
                width: 300px; /* Largura ajustada para os inputs */
            }
        </style>
    </head>
    <body class="text-center">
        <div class="container mt-5">
            <form method="post" class="form-signin" action="login.php">
                <h1 class="h3 mb-3 fw-normal">Faça login</h1>
                <div class="form-floating mb-3">
                    <input type="email" id="inputEmail" class="w-100 form-control form-control-narrow" name="email" placeholder="Seu email" required autofocus>
                    <label for="inputEmail">Endereço de email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="inputPassword" class="w-100 form-control form-control-narrow" name="senha" placeholder="Senha" required>
                    <label for="inputPassword">Senha</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembrar de mim
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
        </div>
        <!-- Modal -->
        <div id="modal" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Erro de Conexão</h5>
                        
                    </div>
                    <div class="modal-body">
                        Email incorreto!
                    </div>
                    <div class="modal-footer">
                        <a href="../public/login.html" class="btn btn-primary">Retornar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap JS e outros scripts -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
        <script>
            // Mostrar o modal
            var modal = new bootstrap.Modal(document.getElementById("modal"), {
                keyboard: false,
                backdrop: "static"
            });
            modal.show();
        </script>
    </body>
    </html>';
            }
        } catch (PDOExeption $e) {
                echo'<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aula Bootstrap</title>
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Estilo customizado para ajustar a largura dos inputs -->
        <style>
            .form-signin {
                max-width: 350px;
                padding: 15px;
                margin: auto;
            }
            .form-control-narrow {
                width: 300px; /* Largura ajustada para os inputs */
            }
        </style>
    </head>
    <body class="text-center">
        <div class="container mt-5">
            <form method="post" class="form-signin" action="login.php">
                <h1 class="h3 mb-3 fw-normal">Faça login</h1>
                <div class="form-floating mb-3">
                    <input type="email" id="inputEmail" class="w-100 form-control form-control-narrow" name="email" placeholder="Seu email" required autofocus>
                    <label for="inputEmail">Endereço de email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="inputPassword" class="w-100 form-control form-control-narrow" name="senha" placeholder="Senha" required>
                    <label for="inputPassword">Senha</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembrar de mim
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
        </div>
        <!-- Modal -->
        <div id="modal" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Erro de Conexão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         Erro: ' . $e->getMessage() .  '
                    </div>
                    <div class="modal-footer">
                        <a href="../public/login.html" class="btn btn-primary">Retornar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap JS e outros scripts -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
        <script>
            // Mostrar o modal
            var modal = new bootstrap.Modal(document.getElementById("modal"), {
                keyboard: false,
                backdrop: "static"
            });
            modal.show();
        </script>
    </body>
    </html>';

            }
    
        // $conn =  mysqli_connect($host,$user,$pass, $db);
     } else {
       echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aula Bootstrap</title>
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Estilo customizado para ajustar a largura dos inputs -->
        <style>
            .form-signin {
                max-width: 350px;
                padding: 15px;
                margin: auto;
            }
            .form-control-narrow {
                width: 300px; /* Largura ajustada para os inputs */
            }
        </style>
    </head>
    <body class="text-center">
        <div class="container mt-5">
            <form method="post" class="form-signin" action="login.php">
                <h1 class="h3 mb-3 fw-normal">Faça login</h1>
                <div class="form-floating mb-3">
                    <input type="email" id="inputEmail" class="w-100 form-control form-control-narrow" name="email" placeholder="Seu email" required autofocus>
                    <label for="inputEmail">Endereço de email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="inputPassword" class="w-100 form-control form-control-narrow" name="senha" placeholder="Senha" required>
                    <label for="inputPassword">Senha</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembrar de mim
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
        </div>
        <!-- Modal -->
        <div id="modal" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Erro de Conexão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Você não tem permissão para acessar o site!
                    </div>
                    <div class="modal-footer">
                        <a href="../public/login.html" class="btn btn-primary">Retornar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap JS e outros scripts -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
        <script>
            // Mostrar o modal
            var modal = new bootstrap.Modal(document.getElementById("modal"), {
                keyboard: false,
                backdrop: "static"
            });
            modal.show();
        </script>
    </body>
    </html>';
    }

?>
