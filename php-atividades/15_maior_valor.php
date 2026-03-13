<?php
$numeros = array_fill(0, 5, "");
$maior = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $np = $_POST['numeros'] ?? [];
  $validos = [];
  for ($i = 0; $i < 5; $i++) {
    $v = filter_var(str_replace(',', '.', trim($np[$i] ?? '')), FILTER_VALIDATE_FLOAT);
    if ($v === false) {
      $erros[] = "Número " . ($i + 1) . " inválido.";
      $numeros[$i] = htmlspecialchars($np[$i] ?? '');
    } else {
      $validos[] = $v;
      $numeros[$i] = $v;
    }
  }
  if (count($erros) == 0) {
    $maior = $validos[0];
    foreach ($validos as $n)
      if ($n > $maior)
        $maior = $n;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>15 - Maior Valor</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Encontrar o Maior Valor</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($maior !== null): ?>
      <div class="resultado">O maior número digitado foi: <strong><?= number_format($maior, 2, ',', '.') ?></strong></div>
    <?php endif; ?>
    <form method="post">
      <?php for ($i = 0; $i < 5; $i++): ?>
        <div><label>Número <?= $i + 1 ?>:<br><input type="text" name="numeros[]"
              value="<?= htmlspecialchars($numeros[$i]) ?>"></label></div>
      <?php endfor; ?>
      <input type="submit" value="Encontrar Maior">
    </form>
  </div>
</body>

</html>