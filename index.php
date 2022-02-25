<?php
session_start();
include 'pdoconfig.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title> Decoração presentes</title>
    <link rel="stylesheet" type="text/css" href="index.css">
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


        <div class="corpo" style="background-color:orange; margin:3% ;margin-left:15%">
            <?php
            $query = "SELECT * FROM produtos";
            $result = mysqli_query($link, $query);
            while ($array = mysqli_fetch_assoc($result)) {


            ?>
                <div class="img" style="float: left; margin-left:80px;margin-top:20px;">
                <a href="" style="color:white"> <img src="upload/<?= $array['imagem'] ?>" 
                    style="margin-left:15%;
                        margin-top:4%;
                        max-width: 100%;
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                    "> </a>
                    <h3><?php echo $array['nome'] ?></h3>
                    <h3>R$ <?php echo $array['preco'] ?></h3>
                   
                </div>
            <?php } ?>
        </div>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
</body>

</html>