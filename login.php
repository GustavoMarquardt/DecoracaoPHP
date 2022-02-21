<?php
session_start();

if (isset($_POST['email']) && empty($_POST['email']) == false) {
    // pegando os campos do formulario e armazenando em variaveis, além de pegar a senha e usar o md5 para criptografar
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    //faz a conexão com o banco de dados
    $dns = "mysql:dbname=decoracao;host=localhost";
    $user = "root";
    $pass = "";

    try {

        $db = new PDO($dns, $user, $pass);
        //faz a consulta no banco de dados
        $sql = $db->query("SELECT * FROM adm_usuarios WHERE email='$email'AND senha='$senha'");

        if ($sql->rowCount() > 0) {
            //pega o primeiro valor que achar no banco
            $dado = $sql->fetch();
            $_SESSION['id'] = $dado['id'];
            $_SESSION['user'] = $email; 
            header("Location: admHome.php");
        }
    } catch (PDOException $e) {
        echo "Falhou: " . $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Decoração presentes</title>
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>

<body class="body">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    <h4> ADMINISTRADOR</h4>

                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="POST">
                            <div class="form-group">
                                <label class="form-control-label">EMAIL</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">SENHA</label>
                                <input type="password" class="form-control" name="senha">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <!-- estilizar melhor esse botão -->
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>





</body>

</html>