<?php
    $nomeArquivo = "produto.json";
    $produtos = json_decode(file_get_contents($nomeArquivo), true);

    $categorias=[
        "Escolher",
        "Pranchas",
        "Vestuário",
        "Acessórios",
        "Quilhas",
        "Wetsuit",
        "Leash"
    ];
?>