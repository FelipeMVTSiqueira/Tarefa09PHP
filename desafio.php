

<?php
    // escrever a funcao de cadastrar produtos com seus parametros
    function cadastroProduto($nomeProd, $descricaoProd, $categoriaProd, $precoProd, $quantidadeProd, $imgProd){
        // delcarar uma variavel que é o arquivo .json que foi criado manualmente
        $nomeArquivo = "produto.json";
        // checar se o arquivo com esse nome já existe
        if (file_exists($nomeArquivo)){
            // Se o arquivo existe, declarar uma variavel que pega todo o conteudo do nome do arquivo
            $arquivo = file_get_contents($nomeArquivo);
            // Como o arquivo está em json, temos que decodificar pra uma linguagem legivel
            $produtos = json_decode($arquivo,true);
            // tentando entender esse passo: se não tiver nenhum produto ele irá receber id = 1 e os outros parametros direto do formulário
            if($produtos==[]){
                $produtos[] = [
                    "idProduto"=>1,
                    "nome"=>$nomeProd,
                    "descricao"=>$descricaoProd,
                    "categoria"=>$categoriaProd,
                    "preco"=>$precoProd,
                    "img"=>$imgProd
                ];
                // no else vamos validar para que se já existe um primeiro item cadastrado, o programa vai adicionar um numero ao ultimo id para gerar o proximo id
            } else {
                // aqui o proximo id vai entrar no final do array criando um novo produto com novo id
                $ultimoId = end($produtos);
                // Agora vamos adicionar +1 no id para gerar o proximo id para o proximo produto. O proximo id vai pegar o valor do id do utimo produto e somar 1
                $proximoId = $ultimoId["idProduto"]+1;
                // agora já temos o id seguinte para gerar novo produto, então é soh declarar que novo id é o proximoID dentro array do produto
                $produtos[] = [
                    "idProduto"=>$proximoId,
                    "nome"=>$nomeProd,
                    "descricao"=>$descricaoProd,
                    "categoria"=>$categoriaProd,
                    "preco"=>$precoProd,
                    "img"=>$imgProd
                ];
            }
            $json = json_encode($produtos);
            $sucesso = file_put_contents($nomeArquivo, $json);
            if($sucesso){
            } else {
                return "Aconteceu algum erro, produto não cadastrado!";
            }
        } else {
            $produtos = [];
            $produtos[] = [
                "idProduto"=>1,
                "nome"=>$nomeProd,
                "descricao"=>$descricaoProd,
                "categoria"=>$categoriaProd,
                "preco"=>$precoProd,
                "img"=>$imgProd
            ];
            $json = json_encode($produtos);
            $sucesso = file_put_contents($nomeArquivo, $json);
            if($sucesso){
            } else {
                return "Aconteceu algum erro, produto não cadastrado!";
            }
        }
    }
    if($_POST){
        $nome = $_FILES["imgProduto"]["name"];//nome do arquivo que será enviado = transformado em variável
        $data = date("d-m-y_H_i_s"); //nao entendi esse his dps da data
        $pastaImg = dirname(__FILE__)."/img/".$data.$nome;
        $pastaTemporaria = $_FILES["imgProduto"]["tmp_name"];
        $sucesso = move_uploaded_file($pastaTemporaria, $pastaImg);
        echo cadastroProduto($_POST["nomeProd"],$_POST["categoriaProd"],$_POST["descricaoProd"],$_POST["quantidadeProd"],$_POST["precoProd"], $pastaImg);
        
?>





<!-- Esse aqui foi o primeiro passo: bolar todo o html css pra depois fazer o back end -->
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="produto.php">Black Keys</a></td>
                                    <td>Camiseta</td>
                                    <td>R$ 55,00</td>
                                    <td>67</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <div class="col-3 bg-light pt-4 rounded-lg">
                    <h3 class="mx-3">Cadastrar novo produto:</h3>
                    <div class="font-weight-bold mx-3">
                        <form action="" class="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nomeProduto">Nome do Produto</label>
                                <input type="text" class="form-control" name="nomeProduto" id='nomeProduto' maxlenght=70 placeholder="O que vc vai desapegar?" required />
                            </div>
                            <div class="form-group">
                                <label for="descricaoProduto">Descricao do produto acima:</label>
                                <textarea name="descricaoProduto" class="form-control noresize" placeholder="Descreva aqui as caracteristicas do produto."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categoriaProduto">Categoria</label>
                                <input type="text" class="form-control" id="categoriaProduto" name="categoriaProduto" placeholder="Selecione a categoria do produto" required>
                            </div>
                            <div class="form-group">
                                <label for="precoProduto">Preço</label>
                                <input type="text" class="form-control" name="precoProduto" placeholder="Quanto voce quer por ele?">
                            <div class="form-group">
                                <label for="quantidadeProduto">Quantidade</label>
                                <input type="number" class="form-control" name="quantidadeProduto" placeholder="Quantidade do produto caso não seja unico" required>
                            </div>
                            <div class="form-group">
                                <label for="imgProduto">Imagem do Produto</label>
                                <input type="file" class="form-control-file" name="imgProduto" placeholder="Selecione uma imagem" required />
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
            </div>
        </section>
    </main>






<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>