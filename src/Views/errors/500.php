<section class="error-page">
    <h1>500</h1>
    <h2>Error del servidor</h2>
    <p><?= e($message ?? 'Ocurrió un error inesperado.') ?></p>
    <a class="btn btn-primary" href="<?= url('') ?>">Volver al inicio</a>
</section>
