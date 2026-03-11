<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['numero']) && isset($_POST['numero2']) && isset($_POST['operacao']) && !empty($_POST['numero']) && !empty($_POST['numero2']) && !empty($_POST['operacao'])) {
        $n1 = $_POST['numero'];
        $n2 = $_POST['numero2'];
        $operacao = $_POST['operacao'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="exercicio8.php" method="post">
        <label for="numero">Digite o primeiro número:</label>
        <input type="number" name="numero" id="numero">
        <br>
        <label for="numero2">Digite o segundo número:</label>
        <input type="number" name="numero2" id="numero2">
        <br>
        <label for="operacao">Selecione a operação:</label>
        <select name="operacao" id="operacao">
            <option value="somar">Somar</option>
            <option value="subtrair">Subtrair</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select>
        <br>
        <input type="submit" value="Verificar">
    </form>

    <?php
    if ($_POST) {
        $n1 = $_POST['numero'];
        $n2 = $_POST['numero2'];
        $operacao = $_POST['operacao'];

        switch ($operacao) {
            case 'somar':
                $resultado = $n1 + $n2;
                echo "$n1 + $n2 = $resultado";
                break;
            case 'subtrair':
                $resultado = $n1 - $n2;
                echo "$n1 - $n2 = $resultado";
                break;
            case 'multiplicar':
                $resultado = $n1 * $n2;
                echo "$n1 * $n2 = $resultado";
                break;
            case 'dividir':
                if ($n2 != 0) {
                    $resultado = $n1 / $n2;
                    echo "$n1 / $n2 = $resultado";
                } else {
                    echo "Erro: Divisão por zero não é permitida.";
                }
                break;
        }
    }
    ?>
</body>

</html>