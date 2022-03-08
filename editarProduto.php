<?php
session_start();
include_once 'pdoconfig.php';
$value = $_SESSION['user'];
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id=$id";
$result = mysqli_query($link, $sql);
$array = mysqli_fetch_assoc($result);

$sql = ("SELECT * FROM tags ORDER BY tag ASC");
$resultTag = mysqli_query($link, $sql);
$rowTag = mysqli_num_rows($result);

$imagem = $array['tabelaImg'];
//adicão das imagens filhas 
if (isset($_FILES['arquivo']) && count($_FILES['arquivo']['tmp_name']) > 0) {
    $imagemPai = $array['imagem'];
    for ($q = 0; $q < count($_FILES['arquivo']['tmp_name']); $q++) {
        $nomeArquivo = md5($_FILES['arquivo']['name'][$q] . time() . rand(0, 99)) . '.jpeg';
        move_uploaded_file($_FILES['arquivo']['tmp_name'][$q], 'upload/' . $nomeArquivo);
        $sqlArrayImg = "INSERT INTO $imagem (imagem,paiImg) VALUES ('$nomeArquivo','$imagemPai')";
        $resultArrayImg = mysqli_query($link, $sqlArrayImg) or die(mysqli_error($link));
        if ($resultArrayImg) {
            echo '<script>alert("Imagem adicionada com sucesso!");</script>';
        } else {
            echo '<script>alert("Imagem não foi adicionada!");</script>';
        }
    } // ARRAY COM NOME DOS ARQUIVOS
    header('Location: editarProduto.php?id=' . $id);
}
//query das imagens filhas 




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

    h4 {

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

<body class="site" style="margin-bottom: 5%;">
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
        <!-- fim da nav bar -->

        <div class="formProdutos" style="background-color:#696969">
            <h1 style=" margin:5%;margin-top:3%; text-align: center">Adicionar produtos</h1>
            <form method="POST" action="controleImg.php?acao=edit&id=<?= $id ?>">
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
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">

                            </div>
                            <select class="custom-select" name="tag" id="inputGroupSelect01" style=" width:96%; height:10%;margin-left:2%;margin-right:2%">

                                <?php
                                while ($rowTag = mysqli_fetch_assoc($resultTag)) {
                                    echo "<option required value='" . $rowTag['id'] . "'>" . $rowTag['tag'] . "</option>";
                                } ?>
                    </li>
                    <!-- <div class="inputFile" style="margin-top:2%">
                        <input type="file" name="arquivo" id="arquivo">
                    </div> -->
                    <input type="submit" value="Enviar" class="btn" style="margin-top: 2%; margin-bottom: 5%;">
                </ul>
            </form>
        </div>
        <?php
        if ($array['tabelaImg'] == NULL) {
            // se não tiver tabela ele vem para ca para adicionar
        ?>
            <div class="formProdutos" style="background-color:#696969">
                <h1 style="margin-top:5%; text-align: center">Apenas uma imagem adicionada</h1>
                <h4 style="color:white;margin-top:1%; text-align: center">para adicionar mais imagens clieque em criar tabela</h4>
                <form method="POST" action="controleImg.php?acao=add&id=<?= $id ?>">
                    <ul>
                        <input type="submit" value="Criar tabela" class="btn" style="margin-top: 2%; margin-bottom: 5%;">
                    </ul>

            </div>
        <?php
        } else {
            // se a tabela já estiver sido criada ela vem para ca para depois adicionar mais 
        ?>

            <div class="formProdutos inline-block" style="background-color:#696969">
                <h1 style="margin-top:5%; text-align: center">Tabela já criada</h1>
                <h4 style="color:white;margin-top:1%; text-align: center">Selecione as imagens para adicionalas</h4>
                <form method="POST" enctype="multipart/form-data">
                    <ul>
                        <input type="file" name="arquivo[]" multiple />
                    </ul>
                    <ul>
                        <input type="submit" value="Enviar" class="btn" style="margin-top: 2%; margin-bottom: 5%;">
                    </ul>

                </form>
            </div>
        <?php
        }
        ?>
        <div class="Imgs">
            <?php
            if ($array['tabelaImg'] != NULL) {
                $sqlShowImg = "SELECT * FROM $imagem ";
                $sqlShowImgQuery = mysqli_query($link, $sqlShowImg) or die(mysqli_error($link));
                $rowShowImg = mysqli_num_rows($sqlShowImgQuery);
            } else{
                $rowShowImg = 0;
            }
            ?>
            <?php
            if ($rowShowImg > 0) {
                while ($imgs = mysqli_fetch_assoc($sqlShowImgQuery)) {
            ?>
                    <div class="img inline-block" >
                        <div class="img" style="float: left; margin-left:80px;margin-top:20px;">
                            <img src="upload/<?= $imgs['imagem'] ?>" style="margin-left:15%;
                    margin-top:4%;
                    max-width: 100%;
                    width: 200px;
                    height: 200px;
                    object-fit: cover;
                    ">
                             <a href="controleImg.php?acao=excluirFilho" class="bn3637 bn37" style="color:white" onclick="return confirm('Deseja excluir o produto?')">Excluir</a>
                        </div>
                <?php
                }
            }
                ?>
                    </div>

</body>

</html>