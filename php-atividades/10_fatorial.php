<?php
$numero = "";
$resultado = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $v = filter_var(trim($_POST['numero'] ?? ''), FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 20]]);
  if ($v === false) {
    $erros[] = "Digite um inteiro entre 0 e 20.";
    $numero = htmlspecialchars($_POST['numero']);
  } else {
    $numero = $v;
    $resultado = 1;
    for ($i = 1; $i <= $numero; $i++)
      $resultado *= $i;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>10 - Fatorial</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Fatorial de um Número</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado">O fatorial de <?= $numero ?> é <strong><?= $resultado ?></strong></div><?php endif; ?>
    <form method="post">
      <div><label>Número (0–20):<br><input type="text" name="numero" value="<?= htmlspecialchars($numero) ?>"></label>
      </div>
      <input type="submit" value="Calcular">
    </form>
  </div>
</body>

</html>