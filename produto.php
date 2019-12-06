<?php
    include("variaveis.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Produto</title>
</head>
<body>
    <main class="mt-5">
        <section class="container bg-light rounded-lg px-4 pt-4">
            <div class="row">
                <?php if(isset($produtos) && $produtos != []){
                    foreach($produtos as $produto){
                    if($_GET["idProduto"] == $produto["idProduto"] ){ ?>
                        
                        <div class="col-5 m-2">
                            <img src="<?php echo $produto["img"]; ?>" class="img-fluid rounded-lg" style="width: 500px;" alt="imagem do produto">
                        </div>
                        <div class="col-6">
                            <div class="card-body">
                                <h1><?php echo $produto["nome"]?></h1>
                                <h3>Preco do Produto: <?php echo "R$".$produto["preco"]?> </h3>
                                <h3>Categoria do Produto: <?php echo $produto["categoria"]?> </3>
                                <h4>Descricao do Produto: <?php echo $produto["descricao"]?> </h4>
                                <h5>Quantidade em Estoque: <?php echo $produto["quantidade"]?> </h5>
                            </div>
                        </div>
                        <?php } } }?>
                </div>
            <div class="d-flex justify-content-end">
                <button class="m-3 rounded-lg"><a href="desafio.php">Voltar para lista de produtos</a></button>
            </div>
        </section>
    </main>
</body>
</html>