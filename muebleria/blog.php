<?php
$titulo_pagina = "Nuestro Blog";

$nav_links = [
    'index.php'    => 'Inicio',
    'tienda.php'   => 'Tienda',
    'blog.php'     => 'Blog',
    'carrito.php'  => 'Carrito',
    'contacto.php' => 'Contacto',
];

$entradas = [
    [
        'imagen'  => 'img/nosotros.jpg',
        'fecha'   => '22 de Octubre de 2022',
        'autor'   => 'TiendaMuebles',
        'parrafos' => [
            'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium id numquam ducimus alias commodi eveniet, impedit amet! Quidem et tempore obcaecati vitae voluptatibus ipsam? Quae repudiandae sequi quas numquam nam.',
            'Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati provident beatae fugiat laudantium possimus harum, magnam architecto soluta doloribus itaque dolores amet maiores pariatur ea quisquam voluptatem numquam? In, nobis!',
        ],
        'url' => 'entrada.php',
    ],
    [
        'imagen'  => 'img/nosotros.jpg',
        'fecha'   => '22 de Octubre de 2022',
        'autor'   => 'TiendaMuebles',
        'parrafos' => [
            'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium id numquam ducimus alias commodi eveniet, impedit amet! Quidem et tempore obcaecati vitae voluptatibus ipsam? Quae repudiandae sequi quas numquam nam.',
            'Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati provident beatae fugiat laudantium possimus harum, magnam architecto soluta doloribus itaque dolores amet maiores pariatur ea quisquam voluptatem numquam? In, nobis!',
        ],
        'url' => 'entrada.php',
    ],
];

$otras_entradas = [
    'Guía de Colores'               => 'entrada.php',
    'Nuevos Modelos'                => 'entrada.php',
    'Guía para diseño de interiores'=> 'entrada.php',
    'Guía para diseño de exteriores'=> 'entrada.php',
];

$sobre_nosotros    = ['Nuestra Historia', 'Misión, Visión y Valores', 'Carreras', 'Política de Privacidad', 'Términos del Servicio'];
$soporte           = ['Preguntas Frecuentes', 'Ayuda en línea', 'Confianza y Seguridad'];
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
        <h1 class="nombre-sitio">Tienda <span> Muebles </span></h1>
    </header>

    <div class="contenedor-navegacion">
        <nav class="nav-principal contenedor">
            <?php foreach ($nav_links as $url => $label): ?>
                <a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($label); ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <main class="contenido-principal contenedor">
        <h2 class="text-center"><?php echo htmlspecialchars($titulo_pagina); ?></h2>

        <section class="contenedor-blog">
            <div class="blog">
                <?php foreach ($entradas as $entrada): ?>
                    <article class="entrada">
                        <h2><?php echo htmlspecialchars($entrada['titulo']); ?></h2>

                        <div class="imagen">
                            <img src="<?php echo htmlspecialchars($entrada['imagen']); ?>"
                                 alt="imagen blog">
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

                        <a href="<?php echo htmlspecialchars($entrada['url']); ?>" class="btn max-width-30">Leer</a>
                    </article>
                <?php endforeach; ?>
            </div>

            <aside>
                <h3>Otras Entradas de Blog</h3>
                <ul>
                    <?php foreach ($otras_entradas as $titulo => $url): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($titulo); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </section>
    </main>

    <footer class="site-footer">
        <div class="grid-footer contenedor">

            <div>
                <h3>Categorías</h3>
                <nav class="footer-menu">
                    <?php foreach ($categorias_footer as $cat): ?>
                        <a href="#"><?php echo htmlspecialchars($cat); ?></a>
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
