<?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dibuhazoh</title>
        <meta name="description" content="Series de dibujos de los 90, 80, 70...">
        <meta name="author" content="Fran Marin"/>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="./js/imagesloaded.pkgd.min.js"></script>
        <script type="text/javascript" src="./js/masonry.pkgsd.min.js"></script>
        <script type="text/javascript" src="./js/dibuhazoh.js"></script>
    </head>
    <body>
        <?php require_once 'src/menu.php'; ?>
        <div id="main-page">
            <header>
                <a href="#main-nav" class="open-menu">&#9776;</a>
                <a href="#" class="close-menu">&#9776;</a>
                <p id="total-dibuhazoh"></p>
            </header>
            <div id="content">
                <div id="grid">
                    <div id="grid-sizer"></div>
                </div>
                <div class="next" id="0">Continuar</div>
                <div id="spinner-container"><div id="spinner">Cargando</div></div>
                <div id="end">No hay m&aacute;s resultados con los filtros seleccionados</div>
            </div>
        </div>
    </body>
</html>
