<?php
//Excluir imagem

session_start();
include_once 'pdoconfig.php';

if($_GET['acao'] == 'excluirFilho'){
    
    $id = $_GET['idImg'];
    $idPai = $_GET['idPai'];
    $sqlPai = "SELECT * FROM produtos WHERE id=$idPai";
    $resultPai = mysqli_query($link, $sqlPai);
    $arrayPai = mysqli_fetch_assoc($resultPai);
    $tabelaFilho = $arrayPai['tabelaImg'];
    $sqlFilho ="DELETE FROM $tabelaFilho WHERE id=$id";
    $resultFilho = mysqli_query($link, $sqlFilho);
    if($resultFilho){
        echo "<script>alert('Imagem excluída com sucesso!');</script>";
        echo "<script>window.location.href = 'editarProduto.php?id=$idPai';</script>";
    } else{
        echo "<script>alert('Imagem não foi possível de ser excluida!');</script>";
        echo "<script>window.location.href = 'editarProduto.php?id=$idPai';</script>";
    }
}

if ($_GET['acao'] == 'add') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id=$id";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_assoc($result);
    $nomeTable = $array['imagem'];
    $nomeTable = md5($nomeTable);
    $sqlCreate = "CREATE TABLE $nomeTable (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, imagem VARCHAR(200) NOT NULL, paiImg VARCHAR(200) NOT NULL)";
    $resultCreate = mysqli_query($link, $sqlCreate)or die(mysqli_error($link));
    if ($resultCreate) {
        $sqlEdit = "UPDATE produtos SET tabelaImg = '$nomeTable' WHERE id =$id";
        $resultEdit = mysqli_query($link, $sqlEdit) or die(mysqli_error($link));
        if ($resultEdit) {
            echo "<script>alert('Tabela criada com sucesso!');</script>";
            echo "<script>window.location.href = 'editarProduto.php?id=$id';</script>";
        } else {
            echo "<script>alert('Erro ao editar tabela!');</script>";
            echo "<script>window.location.href = 'editarProduto.php?id=$id';</script>";
        }
        echo "<script>alert('Imagem adicionada com sucesso!');</script>";
        echo "<script>window.location.href = 'editarProduto.php?id=$id';</script>";
    } else {
        echo "<script>alert('Erro ao criar tabela!');</script>";
        echo "<script>window.location.href = 'editarProduto.php?id=$id';</script>";
    }
}
//excluir a tag
if ($_GET['acao'] == 'excluirTag') {
    $id = $_GET['id'];
    $sql = "DELETE FROM tags WHERE id=$id";
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo "<script>alert('Tag excluída com sucesso!');</script>";
        echo "<script>window.location.href = 'gerenciadorTags.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir tag!');</script>";
        echo "<script>window.location.href = 'gerenciadorTags.php';</script>";
    }
}
// excluir o produto e a imagem
if ($_GET['acao'] == 'excluir') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id=$id";
    $result = mysqli_query($link, $sql);
    $array = mysqli_fetch_assoc($result);
    // $tabela = $array['tabelaImg'];
    // $sqlSon = "DROP TABLE $tabela";
    // $resultSon = mysqli_query($link, $sqlSon);
    // $query_del = "DELETE FROM produtos WHERE id=$id";
    if (mysqli_query($link, $query_del)) {
        if (unlink('upload/' . $array['imagem']) == true) {
            echo '<script>alert("Produto excluido com sucesso!");</script>';
            echo '<script>window.location="admHomeListarProdutos.php";</script>';
        }
    }
}
//editar o produto
if ($_GET['acao'] == 'edit') {
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
