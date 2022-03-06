<?php
session_start();
$value = $_SESSION['user'];

include 'pdoconfig.php';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title> Decoração presentes</title>
    <link rel="stylesheet" type="text/css" href="styleAdmHome.css">
    
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
                    <li><a href="">PRODUTOS</a></li>
                    <li><a href="adicionarProduto.php">ADICINAR</a></li>
                    <li><a href="gerenciadorTags.php">TAGS</a></li>

                </ul>
            </div>
        </div>
        <div class="corpo" style="background-color:black; margin:3%">
            <?php
            $query = "SELECT * FROM produtos";
            $result = mysqli_query($link, $query);
            while ($array = mysqli_fetch_assoc($result)) {


            ?>
                <div class="img" style="float: left; margin-left:80px;margin-top:20px;">
                    <img src="upload/<?= $array['imagem'] ?>" style="margin-left:15%;
                    margin-top:4%;
                    max-width: 100%;
                    width: 200px;
                    height: 200px;
                    object-fit: cover;
                    ">
                    <h3 style=""><?php echo $array['nome'] ?></h3>
                    <h3>R$ <?php echo $array['preco'] ?></h3>
                    <a href="editarProduto.php?id=<?= $array['id']; ?>" class="bn3637 bn37" style="color:white">Editar</a>
                    <a href="controleImg.php?acao=excluir&id=<?= $array['id']; ?>" class="bn3637 bn37" style="color:white"  onclick="return confirm('Deseja excluir o produto?')">Excluir</a>
                </div>
            <?php } ?>
        </div>
        
</body>

</html>