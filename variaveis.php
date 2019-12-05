<?php 
    // ainda não entendi o porque disso mas estou indo atrás pra saber o porque dessas variáveis ficarem aqui
    $nomeArquivo = "produto.json";
    $produtos = json_decode(file_get_contents($nomeArquivo), true);

    // As categorias estão armazenadas neste array pra acesso depois usando php
    $categorias=[
        "Escolher",
        "Pranchas",
        "Vestuário",
        "Acessórios",
        "Quilhas",
        "Wetsuit",
        "Leash"
    ];