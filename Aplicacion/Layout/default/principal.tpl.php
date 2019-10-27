<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= $this->nombreApp; ?></title>
    <!-- #meta -->
    <!-- #css.default -->

    <?= $this->imprimirMeta(); ?>
    <?= $this->imprimirLibrerias('css', 'default'); ?>
</head>
<body>
    <div class="container">
        <?php

        echo $this->incluir('elementos/header');
        echo $this->contenido();
        echo $this->incluir('elementos/footer')

        ?>
    </div>
    <?= $this->imprimirLibrerias('js', 'default'); ?>
    <!-- #css.default -->
</body>
</html>