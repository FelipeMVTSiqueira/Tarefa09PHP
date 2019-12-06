<?php
    function validaNome($nomeProd){
        global $erros;
        if(strlen($nomeProd) == " "){
            array_push($erros, "Nome inválido.");
        }
    }
    function validaDescricao($descricaoProd){
        global $erros;
        if(strlen($descricaoProd) == " "){
            array_push($erros, "Descrição inválida.");
        }
    }
?>