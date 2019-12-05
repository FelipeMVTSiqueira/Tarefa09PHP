<?php
    // escrevendo a função pra assegurar que os campos do nome e descrição não sejam vazios
    function validaNome($nomeProd){
        global $erros;
        if(strlen($nomeProd) == " "){
            array_push($erros, "Nome inválido.");
        }
    }
    // função igualzinha a de cima com variáveis diferentes
    function validaDescricao($descricaoProd){
        // definindo uma variável global chama erros pra guardar todos os erros gerados com campos vazios
        global $erros;
        // se o tamanho da string do produto for igual a vazio, a descricao não será aceita
        if(strlen($descricaoProd) == " "){
            // será armazenado na array uma mensagem de erro por causa do campo não preenchido
            array_push($erros, "Descrição inválida.");
        }
    }
?>