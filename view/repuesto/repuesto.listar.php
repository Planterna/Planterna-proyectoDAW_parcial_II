<!--Autor: Mero Araujo Jeremy-->
<?php require_once HEADER; ?>

<title>Listado de Repuestos</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<body class="list-replacement">
    <main class="main-container">
        <h2><i class="fas fa-tools"></i> Listado de Repuestos</h2>
    
        <div class="search-main">
            <form action="index.php?c=repuestos&f=search" method="POST" class="search-form" role="search">
                <input type="text" name="b" value="<?= isset($_POST['b']) ? htmlspecialchars($_POST['b']) : '' ?>" placeholder="Buscar" />
                <button type="submit" class="btn btn-primario">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </form>

            <a href="index.php?c=repuestos&f=view_new" class="btn btn-primario" role="button">
                <i class="fas fa-plus"></i> Nuevo Repuesto
            </a>
        </div>

        <div class="table">
            <table class="table-replacement">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($resultados)): $contador = 0; ?>
                        <?php foreach ($resultados as $fila): $contador++; ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['rep_nombre']) ?></td>
                                <td><?= htmlspecialchars($fila['rep_descripcion']) ?></td>
                                <td>$<?= number_format($fila['rep_precio'], 2) ?></td>
                                <td><?= htmlspecialchars($fila['rep_stock']) ?></td>
                                <td><?= htmlspecialchars($fila['rep_tipoRepuesto']) ?></td>
                                <td><?= htmlspecialchars($fila['mar_nombre']) ?></td>
                                <td><?= htmlspecialchars($fila['mod_nombre']) ?></td>
                                <td><?= $fila['rep_estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                                <td class="acciones">
                                    <a 
                                        class="btn btn-accion btn-editar" 
                                        href="index.php?c=repuestos&f=view_edit&id=<?= $fila['rep_id'] ?>"
                                    >
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>
                                    <a 
                                        class="btn btn-accion btn-eliminar" 
                                        href="index.php?c=repuestos&f=delete&id=<?= $fila['rep_id'] ?>" 
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este repuesto?');"
                                    >
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php  
                            $filasV = 5 - $contador;
                            for ($i = 0; $i < $filasV; $i++) {
                                echo "<tr class='fila-vacia'>";
                                echo "<td colspan='9'>&nbsp;</td>";
                                echo "</tr>";
                            }
                        ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="no-results">No se encontraron resultados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPag > 1): ?>
            <nav class="pagination" aria-label="Paginación de repuestos">
                <?php if ($paginaAct > 1): ?>
                    <a href="index.php?c=repuestos&f=search&pagina=<?= $paginaAct - 1 ?>&b=<?= urlencode($busqueda) ?>">&laquo; Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPag; $i++): ?>
                    <a 
                        href="index.php?c=repuestos&f=search&pagina=<?= $i ?>&b=<?= urlencode($busqueda) ?>" 
                        class="<?= $i === $paginaAct ? 'active' : '' ?>"
                    >
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($paginaAct < $totalPag): ?>
                    <a href="index.php?c=repuestos&f=search&pagina=<?= $paginaAct + 1 ?>&b=<?= urlencode($busqueda) ?>">Siguiente &raquo;</a>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </main>

    <?php require_once FOOTER; ?>
</body>
</html>
