<?php

    include("cabecalho.php");

    $diaSemana = 3;
    
    switch($diaSemana){
        case 1:
            echo"Hoje é domingo!";
            break;
        case 2:
            echo"Hoje é segunda!";
            break;
        case 3:
            echo"Hoje é terça!";
            break;
        default:
        echo "Hoje pode ser quarta, quinta, sexta ou sabado!";
    }

    include("rodape.php");