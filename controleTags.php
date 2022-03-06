<?php
session_start();
include_once 'pdoconfig.php';
if($_GET['acao'] == 'excluirTag'){
    $id = $_GET['id'];
    $sql = "DELETE FROM tags WHERE id=$id";
    echo $id;
    $result = mysqli_query($link, $sql);
    if($result){
        echo "<script>alert('Tag excluída com sucesso!');</script>";
        echo "<script>window.location.href = 'gerenciadorTags.php';</script>";
    }else{
        echo "<script>alert('Erro ao excluir tag!');</script>";
        echo "<script>window.location.href = 'gerenciadorTags.php';</script>";
    }
}
    ?>