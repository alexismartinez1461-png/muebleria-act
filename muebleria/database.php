<?php
/**
 * database.php — Configuración y creación de la base de datos SQLite
 * TiendaMuebles
 *
 * Uso:
 *   - Incluir este archivo en cualquier página: require_once 'database.php';
 *   - Para inicializar/recrear las tablas desde CLI: php database.php
 */

define('DB_PATH', __DIR__ . '/db/tienda_muebles.sqlite');

// -------------------------------------------------------------------
// Conexión singleton
// -------------------------------------------------------------------
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dir = dirname(DB_PATH);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Activar claves foráneas (SQLite las ignora por defecto)
        $pdo->exec('PRAGMA foreign_keys = ON;');
        // Mejor rendimiento en escrituras
        $pdo->exec('PRAGMA journal_mode = WAL;');
    }

    return $pdo;
}

// -------------------------------------------------------------------
// Creación de tablas
// -------------------------------------------------------------------
function crearTablas(): void {
    $db = getDB();

    $db->exec("
        -- ============================================================
        -- CATEGORÍAS de productos
        -- ============================================================
        CREATE TABLE IF NOT EXISTS categorias (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre      TEXT    NOT NULL UNIQUE,
            descripcion TEXT,
            creado_en   TEXT    NOT NULL DEFAULT (datetime('now'))
        );

        -- ============================================================
        -- PRODUCTOS
        -- ============================================================
        CREATE TABLE IF NOT EXISTS productos (
            id            INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre        TEXT    NOT NULL,
            descripcion   TEXT,
            precio        REAL    NOT NULL CHECK(precio >= 0),
            stock         INTEGER NOT NULL DEFAULT 0 CHECK(stock >= 0),
            imagen        TEXT,
            categoria_id  INTEGER REFERENCES categorias(id) ON DELETE SET NULL,
            activo        INTEGER NOT NULL DEFAULT 1,   -- 1 = activo, 0 = inactivo
            creado_en     TEXT    NOT NULL DEFAULT (datetime('now')),
            actualizado_en TEXT   NOT NULL DEFAULT (datetime('now'))
        );

        -- ============================================================
        -- CLIENTES
        -- ============================================================
        CREATE TABLE IF NOT EXISTS clientes (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre      TEXT    NOT NULL,
            email       TEXT    UNIQUE,
            telefono    TEXT,
            pais        TEXT,
            tipo        TEXT    CHECK(tipo IN ('cliente', 'proveedor')) DEFAULT 'cliente',
            creado_en   TEXT    NOT NULL DEFAULT (datetime('now'))
        );

        -- ============================================================
        -- PEDIDOS
        -- ============================================================
        CREATE TABLE IF NOT EXISTS pedidos (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            cliente_id  INTEGER NOT NULL REFERENCES clientes(id) ON DELETE CASCADE,
            total       REAL    NOT NULL DEFAULT 0,
            estado      TEXT    NOT NULL DEFAULT 'pendiente'
                            CHECK(estado IN ('pendiente','procesando','enviado','completado','cancelado')),
            creado_en   TEXT    NOT NULL DEFAULT (datetime('now')),
            actualizado_en TEXT NOT NULL DEFAULT (datetime('now'))
        );

        -- ============================================================
        -- DETALLE DE PEDIDOS (líneas de producto por pedido)
        -- ============================================================
        CREATE TABLE IF NOT EXISTS pedido_detalle (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            pedido_id   INTEGER NOT NULL REFERENCES pedidos(id)   ON DELETE CASCADE,
            producto_id INTEGER NOT NULL REFERENCES productos(id) ON DELETE RESTRICT,
            cantidad    INTEGER NOT NULL CHECK(cantidad > 0),
            precio_unit REAL    NOT NULL CHECK(precio_unit >= 0),
            subtotal    REAL    GENERATED ALWAYS AS (cantidad * precio_unit) STORED
        );

        -- ============================================================
        -- CITAS
        -- ============================================================
        CREATE TABLE IF NOT EXISTS citas (
            id              INTEGER PRIMARY KEY AUTOINCREMENT,
            cliente_nombre  TEXT    NOT NULL,
            cliente_tel     TEXT    NOT NULL,
            fecha           TEXT    NOT NULL,   -- YYYY-MM-DD
            hora            TEXT    NOT NULL,   -- HH:MM
            producto_interes TEXT,
            notas           TEXT,
            estado          TEXT    NOT NULL DEFAULT 'pendiente'
                                CHECK(estado IN ('pendiente','completada','cancelada')),
            creado_en       TEXT    NOT NULL DEFAULT (datetime('now'))
        );

        -- ============================================================
        -- CONTACTO (mensajes del formulario)
        -- ============================================================
        CREATE TABLE IF NOT EXISTS contacto_mensajes (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre      TEXT    NOT NULL,
            asunto      TEXT    NOT NULL,
            email       TEXT,
            telefono    TEXT,
            mensaje     TEXT,
            pais        TEXT,
            tipo        TEXT    CHECK(tipo IN ('cliente','proveedor')),
            categoria   TEXT,
            leido       INTEGER NOT NULL DEFAULT 0,
            creado_en   TEXT    NOT NULL DEFAULT (datetime('now'))
        );

        -- ============================================================
        -- ENTRADAS DE BLOG
        -- ============================================================
        CREATE TABLE IF NOT EXISTS blog_entradas (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo      TEXT    NOT NULL,
            contenido   TEXT    NOT NULL,
            imagen      TEXT,
            autor       TEXT    NOT NULL DEFAULT 'TiendaMuebles',
            publicado   INTEGER NOT NULL DEFAULT 1,
            creado_en   TEXT    NOT NULL DEFAULT (datetime('now')),
            actualizado_en TEXT NOT NULL DEFAULT (datetime('now'))
        );
    ");

    echo "✅ Tablas creadas correctamente.\n";
}


function semillas(): void {
    $db = getDB();

    // Categorías
    $cats = ['Cocina', 'Oficina', 'Jardín', 'Cochera', 'Dormitorios', 'Sala'];
    $stmtCat = $db->prepare("INSERT OR IGNORE INTO categorias (nombre) VALUES (:nombre)");
    foreach ($cats as $cat) {
        $stmtCat->execute([':nombre' => $cat]);
    }

    $productos = [
        ['Sofá Chesterfield',   'Sofá clásico tapizado en tela premium.',     18990, 5,  'img/sofa.jpg',      1],
        ['Mesa de Roble Macizo','Mesa sólida de roble natural.',               12450, 8,  'img/mesa.jpg',      1],
        ['Biblioteca Flotante', 'Repisas flotantes de madera lacada.',          8790, 12, 'img/biblioteca.jpg',1],
        ['Silla Eames Premium', 'Silla de diseño ergonómica.',                  7490, 20, 'img/silla.jpg',     1],
        ['Cómoda Vintage',      'Cómoda de madera con acabado envejecido.',    15990, 4,  'img/comoda.jpg',    1],
        ['Lámpara Arco',        'Lámpara de pie con arco metálico dorado.',     5290, 15, 'img/lampara.jpg',   6],
    ];

    $stmtProd = $db->prepare("
        INSERT OR IGNORE INTO productos (nombre, descripcion, precio, stock, imagen, categoria_id)
        VALUES (:nombre, :desc, :precio, :stock, :imagen, :cat_id)
    ");
    foreach ($productos as [$nombre, $desc, $precio, $stock, $imagen, $cat_id]) {
        $stmtProd->execute([
            ':nombre' => $nombre, ':desc'   => $desc,
            ':precio' => $precio, ':stock'  => $stock,
            ':imagen' => $imagen, ':cat_id' => $cat_id,
        ]);
    }

    // Entrada de blog de ejemplo
    $db->exec("
        INSERT OR IGNORE INTO blog_entradas (id, titulo, contenido, autor)
        VALUES (1, 'Guía de Colores',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit...',
                'TiendaMuebles')
    ");

    echo "🌱 Datos de ejemplo insertados correctamente.\n";
}


function obtenerProductos(): array {
    return getDB()->query("
        SELECT p.*, c.nombre AS categoria
        FROM   productos p
        LEFT JOIN categorias c ON c.id = p.categoria_id
        WHERE  p.activo = 1
        ORDER  BY p.id
    ")->fetchAll();
}

/** Inserta un mensaje de contacto y devuelve el ID */
function guardarMensajeContacto(array $datos): int {
    $db   = getDB();
    $stmt = $db->prepare("
        INSERT INTO contacto_mensajes (nombre, asunto, email, telefono, mensaje, pais, tipo, categoria)
        VALUES (:nombre, :asunto, :email, :telefono, :mensaje, :pais, :tipo, :categoria)
    ");
    $stmt->execute([
        ':nombre'   => $datos['nombre']   ?? '',
        ':asunto'   => $datos['asunto']   ?? '',
        ':email'    => $datos['email']    ?? null,
        ':telefono' => $datos['telefono'] ?? null,
        ':mensaje'  => $datos['mensaje']  ?? null,
        ':pais'     => $datos['pais']     ?? null,
        ':tipo'     => $datos['tipo']     ?? null,
        ':categoria'=> $datos['categoria']?? null,
    ]);
    return (int) $db->lastInsertId();
}

/** Inserta una cita y devuelve el ID */
function guardarCita(array $datos): int {
    $db   = getDB();
    $stmt = $db->prepare("
        INSERT INTO citas (cliente_nombre, cliente_tel, fecha, hora, producto_interes, notas)
        VALUES (:nombre, :tel, :fecha, :hora, :producto, :notas)
    ");
    $stmt->execute([
        ':nombre'   => $datos['nombre']   ?? '',
        ':tel'      => $datos['tel']      ?? '',
        ':fecha'    => $datos['fecha']    ?? '',
        ':hora'     => $datos['hora']     ?? '',
        ':producto' => $datos['producto'] ?? null,
        ':notas'    => $datos['notas']    ?? null,
    ]);
    return (int) $db->lastInsertId();
}

/** Devuelve todas las citas ordenadas por fecha */
function obtenerCitas(string $estado = 'todas'): array {
    $db  = getDB();
    $sql = "SELECT * FROM citas";
    if ($estado !== 'todas') {
        $stmt = $db->prepare($sql . " WHERE estado = :estado ORDER BY fecha, hora");
        $stmt->execute([':estado' => $estado]);
        return $stmt->fetchAll();
    }
    return $db->query($sql . " ORDER BY fecha, hora")->fetchAll();
}

// -------------------------------------------------------------------
// Ejecución directa desde CLI: php database.php
// -------------------------------------------------------------------
if (PHP_SAPI === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    echo "🗄️  Inicializando base de datos TiendaMuebles...\n";
    crearTablas();
    semillas();
    echo "📍 Base de datos en: " . DB_PATH . "\n";
}