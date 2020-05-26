<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- favicons -->
    <link rel="shortcut icon" href="<?= $this->media('img/favicons', 'favicon-32x32.png', false) ?>">
    <?= $this->imprimirLibrerias('head', 'default') ?>
</head>
<body>
<?= $this->contenido() ?>
<?= $this->imprimirLibrerias('js', 'default') ?>
</body>
</html>