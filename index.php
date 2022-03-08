<?php
session_start();
include 'pdoconfig.php';
//verifica se esta sendo passado na url a pagina atual, senao é atribuido 1 a pagina
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

//Selecionar todos os cursos da tabela
$result_curso = "SELECT * FROM produtos";
$resultado_curso = mysqli_query($link, $result_curso);

//Contar o total de cursos
$total_cursos = mysqli_num_rows($resultado_curso);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 5;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_cursos / $quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os cursos a serem apresentado na página
$result_produtos = "SELECT * FROM produtos LIMIT $incio, $quantidade_pg";
$resultado_produto = mysqli_query($link, $result_produtos);
$total_produtos = mysqli_num_rows($resultado_produto);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title> Decoração presentes</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    h1 {
        text-decoration: none;
        color: white;
        font-family: "Arial", Helvetica, sans-serif;
    }

    .site {
        margin: 0%;
        padding: 0%;
    }

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }

    h3 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        color: #696969;
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

    .topnav {
        background-color: #696969;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .styleNav {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 20px;
        text-decoration: none;
        padding: 0.5rem 1rem;
        transition: 0.3s;
        margin-left: auto;
 
    }
</style>

<body class="site">
    <div class="body">
        <div class="topnav">
            <h3 class="login"><a HREF="login.php?p=login" style="text-decoration: none; color:white">Login</a></h3>
            <div class="imgLogo">
                <img src="imgProject/semFundo.png" width="400px" height="120px">
                <input type="text" name="pesquisa" class="pesquisa" placeholder="O que você esta procurando?" style="margin-left:10% ;">
                <ul>
                    <li><a href="#home">HOME</a></li>
                    <li><a href="#news">NOVIDADES</a></li>
                    <li><a href="#contact">CONTATO</a></li>
                    <li><a href="#about">SOBRE</a></li>
                </ul>
            </div>
        </div>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="filtros">
                <h1 style="color: #f1f1f1; margin-left:40px">Filtros</h1>
            </div>

        </div>
        <div style="margin-left: 20px;">
            <h2 style="font-family:  'Arial', Helvetica, sans-serif;">Filtros</h2>
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        </div>
        <!-- <div style="float:right; margin-right:4%;">
            <h3>Total de produtos: <?php echo $total_produtos; ?></h3>
        </div> -->

        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "230px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>

        <div class="container theme-showcase" role="main">

            <div class="row" style="margin-left:4%">
                <?php while ($rows_produtos = mysqli_fetch_assoc($resultado_produto)) { ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a> <img src="upload/<?= $rows_produtos['imagem'] ?>" style="margin-left:15%;
                    margin-top:4%;
                    max-width: 100%;
                    width: 200px;
                    height: 200px;
                    object-fit: cover;
                    "></a>
                            <h3><?php echo $rows_produtos['nome'] ?></h3>
                            <h3>R$ <?php echo $rows_produtos['preco'] ?></h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
            //Verificar a pagina anterior e posterior
            $pagina_anterior = $pagina - 1;
            $pagina_posterior = $pagina + 1;
            ?>
            <div class="styleNav">
                <nav class="text-center">
                    <ul class="pagination">
                        <li class="page-link">
                            <?php
                            if ($pagina_anterior != 0) { ?>
                                <a href="index.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            <?php } else { ?>
                                <span aria-hidden="true">&laquo;</span>
                            <?php }  ?>
                        </li>
                        <?php
                        //Apresentar a paginacao
                        for ($i = 1; $i < $num_pagina + 1; $i++) { ?>
                            <li class="page-link"><a style="color: #000;" href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li class="page-link">
                            <?php
                            if ($pagina_posterior <= $num_pagina) { ?>
                                <a href="index.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            <?php } else { ?>
                                <span aria-hidden="true">&raquo;</span>
                            <?php }  ?>
                        </li>
                    </ul>
                </nav>
            </div>



</body>

</html>