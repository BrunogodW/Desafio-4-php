<?php
$numero = "";
$resultado = null;
$erros = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $v = filter_var(trim($_POST['numero'] ?? ''), FILTER_VALIDATE_INT);
  if ($v === false) {
    $erros[] = "Digite um número inteiro válido.";
    $numero = htmlspecialchars($_POST['numero']);
  } else {
    $numero = $v;
    $resultado = ($numero % 2 == 0) ? "PAR" : "ÍMPAR";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>06 - Par ou Ímpar</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Par ou Ímpar</h2>
    <?php if ($erros): ?>
      <div class="erro">
        <ul><?php foreach ($erros as $e)
          echo "<li>$e</li>"; ?></ul>
      </div><?php endif; ?>
    <?php if ($resultado !== null): ?>
      <div class="resultado">O número <?= $numero ?> é <strong><?= $resultado ?></strong></div><?php endif; ?>
    <form method="post">
      <div><label>Número:<br><input type="text" name="numero" value="<?= htmlspecialchars($numero) ?>"></label></div>
      <input type="submit" value="Verificar">
    </form>
  </div>
</body>

</html>