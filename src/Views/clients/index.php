<header class="page-header">
    <h1><?= e($title) ?></h1>
    <div class="page-actions">
        <a class="btn btn-primary" href="<?= url('clients/create') ?>">
            <span>+</span> Nuevo cliente
        </a>
    </div>
</header>

<?php if (empty($items)): ?>
    <div class="empty-state">
        <h2>No hay clientes registrados</h2>
        <p>Comienza creando el primer registro desde el botón de arriba.</p>
        <a class="btn btn-primary" href="<?= url('clients/create') ?>">Crear cliente</a>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="table-wrap">
                <table class="data">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha de nacimiento</th>
                            <th>Creado</th>
                            <th class="actions-col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= e($item->id) ?></td>
                            <td><?= e($item->name) ?></td>
                            <td><?= e($item->email) ?></td>
                            <td><?= e($item->phone ?? '-') ?></td>
                            <td><?= e($item->address ?? '-') ?></td>
                            <td><?= e($item->born_date ?? '-') ?></td>
                            <td><?= e($item->created_at) ?></td>
                            <td class="actions-col actions">
                                <div class="btn-group">
                                    <a class="btn btn-ghost btn-sm" href="<?= url('clients/edit/' . $item->id) ?>" title="Editar">Editar</a>
                                    <form method="post"
                                          action="<?= url('clients/delete/' . $item->id) ?>"
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?')"
                                          style="margin: 0;">
                                        <button class="btn btn-danger btn-sm" type="submit" title="Eliminar">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
