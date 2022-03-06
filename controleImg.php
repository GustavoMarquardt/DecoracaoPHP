<?php
//Excluir imagem

session_start();
include_once 'pdoconfig.php';
if($_GET['acao'] == 'excluirTag'){
    $id = $_GET['id'];
    $sql = "DELETE FROM tags WHERE id=$id";
    $result = mysqli_query($link, $sql);
    if($result){
        echo "<script>alert('Tag excluída com sucesso!');</script>";
        echo "<script>window.location.href = 'gerenciadorTags.php';</script>";
    }else{
        echo "<script>alert('Erro ao excluir tag!');</script>";
        echo "<script>window.location.href = 'controleImg.php';</script>";
    }

}
if ($_GET['acao'] == 'excluir') {
    echo 'entrei';
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id=$id";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_assoc($result);
    $query_del = "DELETE FROM produtos WHERE id=$id";
    if (mysqli_query($link, $query_del)) {
        if (unlink('upload/' . $array['imagem']) == true) {
            echo '<script>alert("Produto excluido com sucesso!");</script>';
            echo '<script>window.location="admHomeListarProdutos.php";</script>';
        }
    }
} 

if($_GET['acao'] == 'edit'){
    $id = $_GET['id'];
    $novo_nome =  $_POST['nome'];
    $novo_descricao = $_POST['descricao'];
    $novo_preco = $_POST['preco'];
    $nova_tag = $_POST['tag'];
    // ficara para o futuro
    // $novo_imagem = $_FILES['imagem']['name'];
    $query_edit = "UPDATE produtos SET nome='$novo_nome', descricao='$novo_descricao', preco='$novo_preco', tag='$nova_tag' WHERE id=$id";
    if (mysqli_query($link, $query_edit)) {
        echo '<script>alert("Produto editado com sucesso!");</script>';
        echo '<script>window.location="admHomeListarProdutos.php";</script>';
    }
    

}
