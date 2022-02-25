<?php
session_start();
include_once 'pdoconfig.php';
$value = $_SESSION['user'];
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id=$id";
$result = mysqli_query($link, $sql);
$array = mysqli_fetch_assoc($result);
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

    .site {
        margin: 0%;
        padding: 0%;
    }

    .formProdutos {
        margin-top: 5%;
        margin-left: 10%;
        margin-right: 10%;

    }

    h1 {
        font-family: "Arial", Helvetica, sans-serif;
        color: white;
    }

    label {
        font-family: "Lucida Console", Monaco, monospace;
        color: white;
    }

    input {
        width: 30%;
    }


    *,
    *::after,
    *::before {
        margin: 0;
        padding: 0;
        box-sizing: inherit;
        font-size: 62, 5%;
    }


    .form__label {
        font-family: 'Roboto', sans-serif;
        font-size: 1.2rem;
        margin-left: 2rem;
        margin-top: 0.7rem;
        display: block;
        transition: all 0.3s;
        transform: translateY(0rem);
    }

    .form__input {
        font-family: 'Roboto', sans-serif;
        color: #333;
        font-size: 1.2rem;
        margin: 0 auto;
        padding: 1.5rem 2rem;
        border-radius: 0.2rem;
        background-color: rgb(255, 255, 255);
        border: none;
        width: 90%;
        display: block;
        border-bottom: 0.3rem solid transparent;
        transition: all 0.3s;
    }

    .form__input:placeholder-shown+.form__label {
        opacity: 0;
        visibility: hidden;
        -webkit-transform: translateY(-4rem);
        transform: translateY(-4rem);
    }

    .btn {
        color: #fff;
        background-color: #e74c3c;
        outline: none;
        border: 0;
        color: #fff;
        padding: 10px 20px;
        text-transform: uppercase;
        margin-top: 50px;
        border-radius: 2px;
        cursor: pointer;
        position: relative;
    }

    .topnav {
        background-color: #696969;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
</style>

<body class="site" style="margin-bottom: 5%;">
    <div class="body">
        <div class="topnav">
            <h3 style="text-decoration: none; color:white;  font-family:Arial, Helvetica, sans-serif ; text-align: center; margin-top:1.2%"> Bem vindo <?php echo $value ?></h3>
            <h3 class="login"><a HREF="index.php?p=index" style="text-decoration: none; color:white">Sair</a></h3>
            <div class="imgLogo">
                <img src="imgProject/semFundo.png" width="400px" height="120px">
                <ul>
                    <li><a href="admHomeListarProdutos.php">PRODUTOS</a></li>
                    <li><a href="adicionarProduto.php">ADICINAR</a></li>

                </ul>
            </div>
        </div>
        <!-- fim da nav bar -->

        <div class="formProdutos" style="background-color:#696969">
            <h1 style=" margin:5%;margin-top:3%; text-align: center">Adicionar produtos</h1>
            <form method="POST" action="controleImg.php?acao=edit&id=<?=$id?>">
                <ul>
                    <li>
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome do produto" class="form__input" require style=" margin:2%" value="<?php echo htmlspecialchars($array['nome']) ?>">
                    </li>
                    <li>
                        <label for="preco">Preço:</label>
                        <input type="number" name="preco" id="preco" placeholder="Preço do produto" class="form__input" require value="<?php echo $array['preco'] ?>">
                    </li>
                </ul>

                <ul>
                    <li>
                        <label for="nome">Descrição:</label>
                        <textarea type="text" name="descricao" id="descricao" placeholder="Descrição do produto" class="form__input" style="margin:2%" cols="40" rows="6" value="<?php echo htmlspecialchars($array['descricao']); ?>"></textarea>
                    </li>
                    <li>
                        <label for="preco">Tag:</label>
                        <input type="text" name="tag" id="tag" placeholder="Tag do produto" class="form__input" require value="<?php echo $array['tag'] ?>">
                    </li>
                    <!-- <div class="inputFile" style="margin-top:2%">
                        <input type="file" name="arquivo" id="arquivo">
                    </div> -->
                    <input type="submit" value="Enviar" class="btn" style="margin-top: 2%; margin-bottom: 5%;">
                </ul>
            </form>
        </div>
</body>

</html>