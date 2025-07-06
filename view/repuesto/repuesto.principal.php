<?php require_once HEADER; ?>
<body class="background-container">

  <div class="products">
    <?php if (!empty($resultados)): ?>
      <?php foreach ($resultados as $rep): ?>
        <div class="product">
          <img src="assets/images/<?= htmlspecialchars($rep['rep_imagen'] ?: 'default.png') ?>" 
               alt="Imagen de <?= htmlspecialchars($rep['rep_nombre']) ?>" />
          <h4><?= htmlspecialchars($rep['rep_nombre']) ?></h4>
          <p>Marca: <?= htmlspecialchars($rep['mar_nombre']) ?></p>
          <p>Modelo: <?= htmlspecialchars($rep['mod_nombre']) ?></p>
          <p>Precio: $<?= number_format($rep['rep_precio'], 2) ?></p>
          <button class="add-to-cart">Agregar al Carrito</button>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No hay repuestos registrados.</p>
    <?php endif; ?>
  </div>

</body>
</html>
<?php require_once FOOTER; ?>
