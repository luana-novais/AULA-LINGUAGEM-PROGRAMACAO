<?php
    $nome = "Luana";
    echo "<p>Todas em maiúscula: ".strtoupper($nome)."</p>";
    echo"<p>Todas em minúsculas: ".strtolower($nome)."</p>";
    echo"<p>Quantidade de caracteres: ".strlen($nome)."</p>";
    $posicao = strpos($nome, "n");
    echo "<p>Caractere A na posição: $posicao</p>";
    date_default_timezone_set('America/Sao_Paulo');
    $data1 = date("d/m/Y");
    $dia = date("d");
    $hora = date("H:i:s");
    echo "<p>Data: $data1</p>";
    echo "<p>Dia: $dia</p>";
    echo"<p>Hora: $hora</p>";

    if(checkdate(2, 30, 2025)){
        echo "<p>A data informada existe (30/02/2025</p>";
    }else {
        echo "<p>A data informada não existe!";
    }

    $valor = -10;
    echo "<p>Valor absoluto: ".abs($valor)."</p>";

    $valor = 5.9;
    echo "<p>Valor arredondado: ".round($valor)."</p>";

    $valor = rand(1,100);
    echo "<p>Valor aleatorio: $valor</p>";

    echo "<p>Raiz quadrada de 16: ".sqrt(16)."</p>";

    $valor = 13.5;
    echo "<p>Valor formatado: R$".number_format($valor, 2 ,",", ".")."</p>";


//criar função sem retorno

function ExibirSaudacao(){
    echo "<p>Olá Mundo</p>";
}
ExibirSaudacao();

//criar função com parametro
function ExibirSaudacaoComNome($nome){
    echo"<p>Seja bem vindo $nome</p>";
}
ExibirSaudacaoComNome("Luana");

function MenorValor($valor1, $valor2){
    return min($valor1, $valor2);
}
echo"Menor valor entre 4 e 8: ".MenorValor(8,4);

//quando tem varios valores no parametro
function SomarValores(...$numeros){
    return array_sum($numeros);
}
$soma = SomarValores(1,2,3,4,5,6);
echo "<p>A soma dos valores é: $soma</p>";
?>