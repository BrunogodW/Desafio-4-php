<?php
$selecionados = [];
$processado = false;
$itens = ['Arroz', 'Feijão', 'Leite', 'Ovos', 'Açúcar', 'Farinha', 'Macarrão', 'Óleo'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $processado = true;
  foreach ($_POST['itens'] ?? [] as $item)
    if (in_array($item, $itens))
      $selecionados[] = $item;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>14 - Lista de Compras</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <a class="back" href="index.html">&larr; Voltar ao índice</a>
    <h2>Lista de Compras</h2>
    <?php if ($processado): ?>
      <div class="resultado">
        <?php if (count($selecionados)): ?>
          Itens selecionados:<ul><?php foreach ($selecionados as $i)
            echo "<li>$i</li>"; ?></ul>
        <?php else: ?>Nenhum item selecionado.<?php endif; ?>
      </div>
    <?php endif; ?>
    <form method="post">
      <?php foreach ($itens as $item): ?>
        <div><label><input type="checkbox" name="itens[]" value="<?= $item ?>"
              <?= in_array($item, $selecionados) ? 'checked' : '' ?>> <?= $item ?></label></div>
      <?php endforeach; ?>
      <br><input type="submit" value="Ver Selecionados">
    </form>
  </div>
</body>

</html>