<?php
$inicio = $fim = "";
$pares = [];
$processado = false;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $iv = filter_var(trim($_POST['inicio'] ?? ''), FILTER_VALIDATE_INT);
  $fv = filter_var(trim($_POST['fim'] ?? ''), FILTER_VALIDATE_INT);
  if ($iv === false) {
    $erros[] = "Número inicial inválido.";
    $inicio = htmlspecialchars($_POST['inicio']);
  } else {
    $inicio = $iv;
  }
  if ($fv === false) {
    $erros[] = "Número final inválido.";
    $fim = htmlspecialchars($_POST['fim']);
  } else {
    $fim = $fv;
  }
  if (count($erros) == 0) {
    if ($inicio >= $fim)
      $erros[] = "O inicial deve ser menor que o final.";
    else {
      $processado = true;
      for ($i = $inicio; $i <= $fim; $i++)
        if ($i % 2 == 0)
          $pares[] = $i;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>12 - Pares no Intervalo</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Sequência de Pares no Intervalo</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($processado): ?>
      <div class="resultado">
        <?= count($pares) ? "Pares entre $inicio e $fim: " . implode(', ', $pares) : "Nenhum par no intervalo." ?></div>
    <?php endif; ?>
    <form method="post">
      <div><label>Número inicial:<br><input type="text" name="inicio" value="<?= htmlspecialchars($inicio) ?>"></label>
      </div>
      <div><label>Número final:<br><input type="text" name="fim" value="<?= htmlspecialchars($fim) ?>"></label></div>
      <input type="submit" value="Listar Pares">
    </form>
  </div>
</body>

</html>