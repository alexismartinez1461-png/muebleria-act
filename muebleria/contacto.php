<?php
$titulo_pagina = "Contacto";

$nav_links = [
    'index.php'    => 'Inicio',
    'nosotros.php' => 'Nosotros',
    'tienda.php'   => 'Tienda',
    'blog.php'     => 'Blog',
    'galeria.php'  => 'Galería',
    'contacto.php' => 'Contacto',
];

$paises = [
    'MX' => 'México',
    'PR' => 'Perú',
    'CO' => 'Colombia',
    'AR' => 'Argentina',
    'ES' => 'España',
    'CL' => 'Chile',
];

$categorias_datalist = ['Cocina', 'Exterior', 'Recamaras', 'Oficina', 'Televisión'];

$categorias_footer  = ['Cocina', 'Oficina', 'Jardín', 'Cochera', 'Dormitorios'];
$sobre_nosotros     = ['Nuestra Historia', 'Misión, Visión y Valores', 'Carreras', 'Política de Privacidad', 'Términos del Servicio'];
$soporte            = ['Preguntas Frecuentes', 'Ayuda en línea', 'Confianza y Seguridad'];


$mensaje_enviado = false;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre  = trim($_POST['nombre']  ?? '');
    $asunto  = trim($_POST['asunto']  ?? '');
    $email   = trim($_POST['email']   ?? '');
    $tel     = trim($_POST['tel']     ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');
    $pais    = $_POST['pais']         ?? '';
    $tipo    = $_POST['tipo']         ?? '';

    if (empty($nombre)) $errores[] = 'El nombre es obligatorio.';
    if (empty($asunto)) $errores[] = 'El asunto es obligatorio.';
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email no tiene un formato válido.';
    }

    if (empty($errores)) {
        
        $mensaje_enviado = true;
    }
}
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

        <?php if ($mensaje_enviado): ?>
            <p class="aviso-exito">✅ Tu mensaje ha sido enviado correctamente. ¡Gracias!</p>
        <?php endif; ?>

        <?php if (!empty($errores)): ?>
            <ul class="aviso-error">
                <?php foreach ($errores as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form class="formulario" method="POST" action="contacto.php">

            <fieldset>
                <legend>Tus Datos</legend>

                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" name="nombre" type="text" placeholder="Tu Nombre"
                           value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>" required>
                </div>

                <div class="campo">
                    <label for="asunto">Asunto:</label>
                    <input id="asunto" name="asunto" type="text" placeholder="Tu Asunto"
                           value="<?php echo htmlspecialchars($_POST['asunto'] ?? ''); ?>" required>
                </div>

                <div class="campo">
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="email" placeholder="Tu Email"
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="campo">
                    <label for="tel">Teléfono:</label>
                    <input id="tel" name="tel" type="tel" placeholder="Tu Teléfono"
                           value="<?php echo htmlspecialchars($_POST['tel'] ?? ''); ?>">
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="10" cols="20"><?php echo htmlspecialchars($_POST['mensaje'] ?? ''); ?></textarea>
                </div>
            </fieldset>

            <fieldset>
                <legend>País</legend>
                <div class="campo">
                    <label for="pais">País</label>
                    <select id="pais" name="pais">
                        <option value="">-- Seleccione --</option>
                        <?php foreach ($paises as $codigo => $nombre_pais): ?>
                            <option value="<?php echo htmlspecialchars($codigo); ?>"
                                <?php echo (($_POST['pais'] ?? '') === $codigo) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($nombre_pais); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Información Extra</legend>

                <div class="campo">
                    <label for="cliente">Cliente</label>
                    <input id="cliente" type="radio" name="tipo" value="cliente"
                           <?php echo (($_POST['tipo'] ?? '') === 'cliente') ? 'checked' : ''; ?>>
                </div>

                <div class="campo">
                    <label for="proveedor">Proveedor</label>
                    <input id="proveedor" type="radio" name="tipo" value="proveedor"
                           <?php echo (($_POST['tipo'] ?? '') === 'proveedor') ? 'checked' : ''; ?>>
                </div>

                <div class="campo">
                    <label for="categorias">Categoría de Interés</label>
                    <input list="categorias" name="categorias"
                           value="<?php echo htmlspecialchars($_POST['categorias'] ?? ''); ?>">
                    <datalist id="categorias">
                        <?php foreach ($categorias_datalist as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>
            </fieldset>

            <input class="btn" type="submit" value="Enviar Formulario">
        </form>
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