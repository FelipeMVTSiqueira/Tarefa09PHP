<!-- Segundo passo foi fazer o html da pagina do produto pra depois implementar o back end -->


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
                <?php if(isset($produtos) && $produtos != []){ ?>
                <?php foreach($produtos as $produto){
                    if($_GET["idProduto"] == $produto["idProduto"] ){ ?>
                <div class="col-5 m-2">
                    <img src="img/prancha.jpg" class="img-fluid rounded-lg" style="width: 500px;" alt="imagem do produto">
                </div>
                <div class="col-6">
                    <div class="card-body">
                        <h1><?php echo $produto["nomeProd"]?></h1>
                        <h3>Preco do Produto: <?php echo "R$".$produto["precoProd"]?> </h3>
                        <h3>Categoria do Produto: <?php echo $produto["categoriaProd"]?> </3>
                        <h4>Descricao do Produto: <?php echo $produto["descricaoProd"]?> </h4>
                        <h5>Quantidade em Estoque: <?php echo $produto["quantidadeProd"]?> </h5>
                    </div>
                </div>
                    <?php } } }?>
            </div>
            <div class="d-flex justify-content-end">
                <button class="m-3 rounded-lg"><a href="desafio.php">Voltar para lista de produtos</a></button>
            </div>
        </section>
    </main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>