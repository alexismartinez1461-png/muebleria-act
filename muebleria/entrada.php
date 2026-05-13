<?php
// Configuración de la entrada del blog
$titulo_sitio = "Tienda Muebles";
$titulo_pagina = "Entrada Blog";




$nav_links = [
    'index.php'    => 'Inicio',
    'nosotros.php' => 'Nosotros',
    'tienda.php'   => 'Tienda',
    'blog.php'     => 'Blog',
    'contacto.php' => 'Contacto',
    'citas.php'    => 'Citas',
    'carrito.php'  => 'Carrito',
];

$categorias = ['Cocina', 'Oficina', 'Jardín', 'Cochera', 'Dormitorios'];

$sobre_nosotros = [
    'Nuestra Historia',
    'Misión, Visión y Valores',
    'Carreras',
    'Política de Privacidad',
    'Términos del Servicio',
];

$soporte = [
    'Preguntas Frecuentes',
    'Ayuda en línea',
    'Confianza y Seguridad',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - <?php echo htmlspecialchars($titulo_pagina); ?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Raleway:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <header>
        <h1 class="nombre-sitio">
            <?php echo htmlspecialchars($titulo_sitio); ?>
        </h1>
    </header>

    <div class="contenedor-navegacion">
        <nav class="nav-principal contenedor">
            <?php foreach ($nav_links as $url => $label): ?>
                <a href="<?php echo htmlspecialchars($url); ?>">
                    <?php echo htmlspecialchars($label); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <main class="contenido-principal contenedor">
        <h2 class="text-center"><?php echo htmlspecialchars($titulo_pagina); ?></h2>

        <article class="entrada contenido-entrada-blog">

            <div class="imagen">
                <img src="<?php echo htmlspecialchars($entrada['imagen']); ?>"
                     alt="<?php echo htmlspecialchars($entrada['alt']); ?>">
            </div>

            <div class="entrada-meta">
                <p>Fecha: <span><?php echo htmlspecialchars($entrada['fecha']); ?></span></p>
                <p>Escrito por: <span><?php echo htmlspecialchars($entrada['autor']); ?></span></p>
            </div>

            <div class="entrada-blog">
                <?php foreach ($entrada['parrafos'] as $parrafo): ?>
                    <p><?php echo htmlspecialchars($parrafo); ?></p>
                <?php endforeach; ?>
            </div>

        </article>
    </main>

    <footer class="site-footer">
        <div class="grid-footer contenedor">

            <div>
                <h3>Categorías</h3>
                <nav class="footer-menu">
                    <?php foreach ($categorias as $categoria): ?>
                        <a href="#"><?php echo htmlspecialchars($categoria); ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>

            <div>
                <h3>Sobre Nosotros</h3>
                <nav class="footer-menu">
                    <?php foreach ($sobre_nosotros as $item): ?>
                        <a href="#"><?php echo htmlspecialchars($item); ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>

            <div>
                <h3>Soporte</h3>
                <nav class="footer-menu">
                    <?php foreach ($soporte as $item): ?>
                        <a href="#"><?php echo htmlspecialchars($item); ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>

        </div>

        <p class="copyright">Todos los derechos Reservados, TiendaMuebles</p>
    </footer>

</body>
</html>
