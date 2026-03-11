 <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['base']) && isset($_POST['altura']) && !empty($_POST['base']) && !empty($_POST['altura'])) {
            $base = $_POST['base'];
            $altura = $_POST['altura'];
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
        <form action="exercicio2.php" method="post">
            <label for="base">Base:</label>
            <input type="number" name="base" id="base">
            <br>
            <label for="altura">Altura:</label>
            <input type="number" name="altura" id="altura">
            <br>
            <input type="submit" value="Calcular">
        </form>
    
        <?php
            if (isset($base) && isset($altura)) {
                $area = ($base * $altura);
                $perimetro = 2 * ($base + $altura);

                echo "A área do retângulo é: " . $area;
                echo "<br>";
                echo "O perímetro do retângulo é: " . $perimetro;

            }

            ?>


 </body>

 </html>