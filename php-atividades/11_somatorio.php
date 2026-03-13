<?php
$numero = "";
$resultado = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $v = filter_var(trim($_POST['numero'] ?? ''), FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
  if ($v === false) {
    $erros[] = "Digite um inteiro positivo.";
    $numero = htmlspecialchars($_POST['numero']);
  } else {
    $numero = $v;
    $resultado = 0;
    for ($i = 1; $i <= $numero; $i++)
      $resultado += $i;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>11 - Somatório</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Somatório de 1 a N</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado">A soma de 1 a <?= $numero ?> é <strong><?= $resultado ?></strong></div><?php endif; ?>
    <form method="post">
      <div><label>N:<br><input type="text" name="numero" value="<?= htmlspecialchars($numero) ?>"></label></div>
      <input type="submit" value="Calcular">
    </form>
  </div>
</body>

</html>