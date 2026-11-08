<header class="page-header">
    <h1><?= e($title) ?></h1>
    <div class="page-actions">
        <a class="btn btn-ghost" href="<?= url('clients') ?>">Volver al listado</a>
    </div>
</header>

<div class="card">
    <div class="card-body">
        <form method="post" action="<?= url($action) ?>" novalidate>
            <div class="form-grid">
                <div class="field">
                    <label for="name">Nombre <span class="req">*</span></label>
                    <input type="text" id="name" name="name"
                           value="<?= e($entity->name) ?>"
                           maxlength="120" required autofocus>
                    <?php if (isset($errors['name'])): ?>
                        <small class="error"><?= e($errors['name']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="email">Email <span class="req">*</span></label>
                    <input type="email" id="email" name="email"
                           value="<?= e($entity->email) ?>"
                           maxlength="120" required>
                    <?php if (isset($errors['email'])): ?>
                        <small class="error"><?= e($errors['email']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="field full">
                    <label for="address">Dirección</label>
                    <input type="text" id="address" name="address"
                           value="<?= e($entity->address ?? '') ?>"
                           maxlength="255">
                    <?php if (isset($errors['address'])): ?>
                        <small class="error"><?= e($errors['address']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="phone">Teléfono</label>
                    <input type="tel" id="phone" name="phone"
                           value="<?= e($entity->phone ?? '') ?>"
                           maxlength="20">
                    <?php if (isset($errors['phone'])): ?>
                        <small class="error"><?= e($errors['phone']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="born_date">Fecha de nacimiento</label>
                    <input type="date" id="born_date" name="born_date"
                           value="<?= e($entity->born_date ?? '') ?>">
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                <a class="btn btn-ghost" href="<?= url('clients') ?>">Cancelar</a>
            </div>
        </form>
    </div>
</div>
