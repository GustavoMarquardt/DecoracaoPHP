<!-- </?php
            $query = "SELECT * FROM produtos";
            $result = mysqli_query($link, $query);
            while ($rows_produtos = mysqli_fetch_assoc($resultado_produto)) { ?>
                <div class="img" style="float: left; margin-left:80px;margin-top:20px;">
                    <img src="upload/</?= $rows_produtos['imagem'] ?>" style="margin-left:15%;
                    margin-top:4%;
                    max-width: 100%;
                    width: 200px;
                    height: 200px;
                    object-fit: cover;
                    ">
                    <h3 style=""></?php echo $rows_produtos['nome'] ?></h3>
                    <h3>R$ </?php echo $rows_produtos['preco'] ?></h3>
                    <a href="editarProduto.php?id=</?= $rows_produtos['id']; ?>" class="bn3637 bn37" style="color:white">Editar</a>
                    <a href="controleImg.php?acao=excluir&id=</?= $rows_produtos['id']; ?>" class="bn3637 bn37" style="color:white"  onclick="return confirm('Deseja excluir o produto?')">Excluir</a>
                </div>
            </?php } ?> -->