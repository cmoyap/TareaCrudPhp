<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#2563eb">

    <title><?= e($title ?? 'App') ?> · <?= e(\App\Core\Env::get('APP_NAME', 'App')) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpEeISj2a8J7mHrnz2B0B3N1Nn1B2Gq0vM/3R9P6tFhF0wWl6qJ6QZ0m1m"
          crossorigin="anonymous">
    <link rel="stylesheet" href="<?= url('/css/style.css') ?>">
</head>
<body>
<header class="site-header">
    <div class="nav-wrap">
        <a href="<?= url('') ?>" class="brand">
            Tarea<span class="brand-accent">CRUD</span>
        </a>

        <button class="mobile-menu-btn" aria-label="Abrir menú" aria-expanded="false" id="menuBtn">
            ☰
        </button>

        <nav class="nav-links" id="menuLinks">
            <a href="<?= url('') ?>" <?= ($title ?? '') === 'Inicio' ? 'class="active"' : '' ?>>Inicio</a>
            <a href="<?= url('clients') ?>" <?= ($title ?? '') === 'Clients' ? 'class="active"' : '' ?>>Clients</a>
        </nav>
    </div>
</header>

<main>
    <?php if ($flash = \App\Core\Flash::pull()): ?>
        <div class="flash <?= e($flash['t']) ?>" role="alert">
            <?= e($flash['m']) ?>
            <button class="dismiss" aria-label="Cerrar mensaje">&times;</button>
        </div>
    <?php endif; ?>

    <?= $content ?>
</main>

<script>
    document.getElementById('menuBtn')?.addEventListener('click', function () {
        const links = document.getElementById('menuLinks');
        const open = links.classList.toggle('open');
        this.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    // Cerrar flash al hacer clic en la X
    document.querySelectorAll('.flash .dismiss').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.flash').style.display = 'none';
        });
    });
</script>
</body>
</html>
