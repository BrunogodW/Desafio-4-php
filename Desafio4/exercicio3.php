<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['Km']) && isset($_POST['Litros']) && !empty($_POST['Km']) && !empty($_POST['Litros'])) {
            $Km = $_POST['Km'];
            $Litros = $_POST['Litros'];
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
    <form action="exercicio3.php" method="post">
    <label for="Km">Distancia percorrida (Km):</label>
    <input type="number" name="Km" id="Km">
    <br>
    <label for="Litros">Quantidade de combustível gasto (Litros):</label>
    <input type="number" name="Litros" id="Litros">
    <br>
    <input type="submit" value="Calcular">

    </form>

    <?php
        if (isset($Km) && isset($Litros)) {
            $consumo = ($Km / $Litros);
            echo "O consumo médio do veículo é: " . $consumo . " Km/L";
        }
    ?>

</body>
</html>