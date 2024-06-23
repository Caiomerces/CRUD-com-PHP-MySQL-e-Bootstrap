<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "cadastrodeclientes";

        $conn =  mysqli_connect($host,$user,$pass, $db);

        #Tentativa de conexão com o Banco de dados
        if(!$conn) {
            die ("Falha na conexão: " . mysqli_connect_error());
        } else {
            echo"conexão estabelecida";
            #Caputra de valores via POST
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $sql = "SELECT * FROM clientes WHERE email = '$email' ";
            $result = mysqli_query($conn, $sql);

            #Retornar registros encontrados na tabela
            if (mysqli_num_rows($result) > 0 ) {
               $row = mysqli_fetch_assoc($result);
               $emailSQL = $row['email'];
               $senhaSQL = $row['senha'];
               if (($email == $emailSQL) and ($senha == $senhaSQL)) {
                echo $email . "<b>igual a</b>" . $emailSQL ."<br><br>" . $senha . " <b>igual a</b>" . $senhaSQL . "<br><br>" . "<b>Registro encontrado:</b> email e senha verificados!";
               } else {
                echo $senha . "<b>diferente de</b>" . $senhaSQL ."<br><br>" . "<b>Erro: </b> senha não confere";
               }
            }else {
                echo "Erro: Registro não encontrado.";
            }

        }
    } else {
        echo "Não houve requisicao via post";
    }


?>
