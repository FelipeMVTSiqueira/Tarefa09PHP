<?php
    function cadastroProduto($nomeProd, $descricaoProd, $quantidadeProd, $categoriaProd, $precoProd, $imgProd){
        $nomeArquivo = "produto.json";
        if (file_exists($nomeArquivo)){
            $arquivo = file_get_contents($nomeArquivo);
            $produtos = json_decode($arquivo, true);

            if($produtos==[]){
                $produtos[] = [
                    "idProduto"=>1,
                    "nome"=>$nomeProd,
                    "descricao"=>$descricaoProd,
                    "quantidade"=>$quantidadeProd,
                    "categoria"=>$categoriaProd,
                    "preco"=>$precoProd,
                    "img"=>$imgProd
                ];
            } else {
                $ultimoId = end($produtos);
                $proximoId = $ultimoId["idProduto"]+1;
                $produtos[] = [
                    "idProduto"=>$proximoId,
                    "nome"=>$nomeProd,
                    "descricao"=>$descricaoProd,
                    "quantidade"=>$quantidadeProd,
                    "categoria"=>$categoriaProd,
                    "preco"=>$precoProd,
                    "img"=>$imgProd
                ];
            }
            $json = json_encode($produtos);
            $sucesso = file_put_contents($nomeArquivo, $json);
            if($sucesso){
                return "";
            } else {
                return "Aconteceu algum erro, produto não cadastrado!";
            }
        } else {
            $produtos = [];
            $produtos[] = [
                "idProduto"=>1,
                "nome"=>$nomeProd,
                "descricao"=>$descricaoProd,
                "quantidade"=>$quantidadeProd,
                "categoria"=>$categoriaProd,
                "preco"=>$precoProd,
                "img"=>$imgProd
            ];
            $json = json_encode($produtos);
            $sucesso = file_put_contents($nomeArquivo, $json);
            if($sucesso){
                return "";
            } else {
                return "Aconteceu algum erro, produto não cadastrado!";
            }
        }
    }
    if($_POST){
        $nomeImg = $_FILES["imgProd"]["name"];
        $pastaTemporaria = $_FILES["imgProd"]["tmp_name"];
        $data = date("d-m-y_H_i_s_");
        $pastaImg = "img/".$data.$nomeImg;
        $sucesso = move_uploaded_file($pastaTemporaria, $pastaImg);
        echo cadastroProduto($_POST["nomeProd"], $_POST["descricaoProd"],$_POST["quantidadeProd"], $_POST["categoriaProd"], $_POST["precoProd"], $pastaImg);
    }
        
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Desafio PHP</title>
</head>
<body>
    <?php
        include_once("variaveis.php");
        include_once("config/validacao.php");
    ?>

    <main class="m-5">
        <section class="container-fluid">
            <div class="row">
                <div class=col-9>
                    <h1>Todos os Produtos</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($produtos) && $produtos != []){ 
                                    foreach($produtos as $produto){ 
                                ?>
                                <tr>
                                    <?php if($produto["nome"] != []){ ?>
                                    <td><a href="produto.php?idProduto=<?php echo $produto["idProduto"];?>"><?php echo $produto["nome"]; ?></a></td> 
                                    <?php } else{ ?>
                                    <td><a href="produto.php<?php echo $produto["idProduto"];?>"><?php echo $produto["categoria"]; ?></a></td>
                                    <?php } ?>
                                    <td><?php echo $produto["categoria"]; ?></td>
                                    <td><?php echo "R$".$produto["preco"]; ?></td>
                                    <td><?php echo $produto["quantidade"]; ?></td>
                                    <td><div class="container-fluid">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $produto["nome"];?>">Editar</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Apagar</button>
                                            </div>
                                        </div></td>
                                </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { ?>
                            <h2>Ops! Não há nenhum item cadastrado!</h2>
                            <?php } ?>
                </div>
                <div class="col-3 bg-light pt-4 rounded">
                    <h3 class="mx-3">Cadastrar novo produto:</h3>
                    <div class="font-weight-bold mx-3">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nomeProd">Nome do Produto</label>
                                <input type="text" class="form-control" name="nomeProd" id="nomeProd" maxlenght=70 placeholder="O que vc vai desapegar?" required />
                            </div>
                            <div class="form-group">
                                <label for="descricaoProd">Descricao do produto acima:</label>
                                <textarea name="descricaoProd" class="form-control noresize" placeholder="Descreva aqui as caracteristicas do produto."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categoriaProd">Categoria</label>
                                <?php if (isset($categorias) && $categorias != []){ ?>
                                <select class="form-control" id="categoriaProd" name="categoriaProd" required>
                                <?php foreach($categorias as $categoria){ ?>
                                <option value="<?php echo $categoria ?>"><?php echo $categoria ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="precoProd">Preço</label>
                                <input type="text" class="form-control" name="precoProd" placeholder="Quanto voce quer por ele?">
                            <div class="form-group">
                                <label for="quantidadeProd">Quantidade</label>
                                <input type="number" class="form-control" name="quantidadeProd" placeholder="Quantidade do produto caso não seja unico" required>
                            </div>
                            <div class="form-group">
                                <label for="imgProd">Imagem do Produto</label>
                                <input type="file" class="form-control-file" name="imgProd" placeholder="Selecione uma imagem" required/>
                            </div>
                            <div class="container-fluid">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success ">Cadastrar!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $produto["nome"];  ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="col-form-label">Descricao:</label>
                        <textarea class="form-control"><?php echo $produto["descricao"] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="quantidade" class="col-form-label">Quantidade:</label>
                        <textarea class="form-control"><?php echo $produto["quantidade"] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria" class="col-form-label">Categoria:</label>
                        <textarea class="form-control"><?php echo $produto["categoria"] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="preco" class="col-form-label">Preco:</label>
                        <textarea class="form-control"><?php echo $produto["preco"] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="img" class="col-form-label">Foto:</label><?php echo "<br>"."<br>"; ?>
                        <img src="<?php echo $produto["img"] ?>" class="container" style="width: 80px;">
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
                </div>
            </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript"> $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Editar as infos do produto: ' + recipient)
  modal.find('.modal-body input').val(recipient)
})    
</script>
</body>
</html>