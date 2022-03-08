<?php
session_start();
$value = $_SESSION['user'];
include_once 'pdoconfig.php';

//faz a conexão com o banco de dados
$dns = "mysql:dbname=decoracao;host=localhost";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($dns, $user, $pass);
    $msg = false;
    $sql = ("SELECT * FROM tags ORDER BY tag ASC");
    $result = mysqli_query($link, $sql);
    $row = mysqli_num_rows($result);
    if (isset($_POST['tag'])) {
        $tag = $_POST['tag'];
        $sql = $pdo->prepare("INSERT INTO tags SET tag= :tag");
        //não entendi muito bem o por que de fazer esses binds nas variaveis sendo que elas já foram lançadas para o BD
        $sql->bindValue(":tag",$tag);
        $sql->execute();
    }
} catch (PDOException $e) {
    echo "Falhou: " . $e->getMessage();
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title> Decoração presentes</title>
    <link rel="stylesheet" type="text/css" href="styleAdmHome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    ul {
        list-style-type: none;
        margin-top: 20px;
        padding: 0;
        text-align: center;

    }

    li {
        display: inline;
        margin-left: 5%;
    }

    a {
        text-decoration: none;
        color: white;
        font-family: "Arial", Helvetica, sans-serif;
    }

    h3 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .site {
        margin: 0%;
        padding: 0%;
    }

    .topnav {
        background-color: #696969;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .bn3637 {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.7rem 2rem;
        font-family: "Poppins", sans-serif;
        font-weight: 700;
        font-size: 18px;
        text-align: center;
        text-decoration: none;
        color: #fff;
        backface-visibility: hidden;
        border: 0.3rem solid transparent;
        border-radius: 3rem;
    }

    .bn37 {
        border-color: transparent;
        background-color: #696969;
        color: #000;
        transition: transform 0.2s cubic-bezier(0.235, 0, 0.05, 0.95);
    }

    .bn37:hover {
        transform: perspective(1px) scale3d(1.044, 1.044, 1) translateZ(0) !important;
    }
</style>

<body class="site">
    <div class="body">
        <div class="topnav">
            <h3 style="text-decoration: none; color:white;  font-family:Arial, Helvetica, sans-serif ; text-align: center"> Bem vindo <?php echo $value ?></h3>
            <h3 class="login"><a HREF="index.php?p=index" style="text-decoration: none; color:white">Sair</a></h3>
            <div class="imgLogo">
                <img src="imgProject/semFundo.png" width="400px" height="120px">
                <ul>
                    <li><a href="admHomeListarProdutos.php">PRODUTOS</a></li>
                    <li><a href="adicionarProduto.php">ADICINAR</a></li>
                    <li><a href="gerenciadorTags.php">TAGS</a></li>

                </ul>
            </div>
        </div>
        <div>
            <form method="POST">
                <div class="input-group mb-3" style="margin-top: 5%; width:50% ;margin-left:5%">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Adicionar Tag</button>
                    <input type="text" name="tag" id="tag"  class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </form>
            <div class="corpo" style="margin:5% ;background-color:#696969">

                <div class="tabela">
                    <table class="table caption-top">
                         <?php
                            $i = 0;
                                if ($row > 0) {
                                    echo "<thead>
                    <tr>
                    <th scope='col' style='color:white'>ID</th>
                    <th scope='col' style='color:white'>TAG</th>
                    <th scope='col' style='color:white'>Ações</th>
                    </tr>
                    </thead>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $i =$i+1;
                                        echo "<tbody>
                        <tr>
                        <th scope='row' style='color:white'>" . $i . "</th>
                        <td  style='color:white'>" . $row['tag'] . "</td>
                        <td><a href=controleTags.php?acao=excluirTag&id=" . $row['id'] . ">Excluir</a></td>
                   
                        </tr>
                        </tbody>";
                                    }
                                }
                                ?> 

                </div>
            </div>

</body>

</html>