<?php

session_start();


$titulo = "Tienda - Nuestros Productos";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Raleway:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <style>
        /* Estilos para el carrito flotante */
        .cart-icon-fixed {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #5f3d2b;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 999;
            transition: transform 0.2s;
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
        }
        .cart-icon-fixed:hover {
            transform: scale(1.05);
        }
        .cart-icon-fixed span {
            background: #f6bd7a;
            color: #3a2418;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.75rem;
        }

        /* Sidebar del carrito */
        .cart-sidebar {
            position: fixed;
            right: -100%;
            top: 0;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 25px rgba(0,0,0,0.15);
            z-index: 1000;
            transition: right 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }
        .cart-sidebar.open {
            right: 0;
        }
        .cart-header {
            background: #4f3222;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .close-cart {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }
        .cart-footer {
            padding: 1rem;
            border-top: 2px dashed #e2cfbe;
        }
        .btn-clear, .btn-checkout {
            width: 100%;
            padding: 10px;
            border-radius: 2rem;
            margin-top: 8px;
            border: none;
            cursor: pointer;
        }
        .btn-clear {
            background: #f0e0d3;
            color: #8c5a3b;
        }
        .btn-checkout {
            background: #5f3d2b;
            color: white;
        }
        .toast-msg {
            position: fixed;
            bottom: 100px;
            left: 20px;
            background: #2c4b32;
            color: white;
            padding: 10px 18px;
            border-radius: 40px;
            z-index: 1100;
        }
        @media (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1 class="nombre-sitio">Tienda <span> Muebles </span></h1>
    </header>
    
    <div class="contenedor-navegacion">
        <nav class="nav-principal contenedor">
            <a href="index.php">Inicio</a>
            <a href="nosotros.php">Nosotros</a>
            <a href="tienda.php">Tienda</a>
            <a href="blog.php">Blog</a>
            <a href="galeria.php">Galería</a>
            <a href="contacto.php">Contacto</a>
            <a href="citas.php">Citas</a>
            <a href="carrito.php">Carrito 🛒</a>
        </nav>
    </div>

    <main class="contenido-principal contenedor">
        <h2 class="text-center">Nuestros Productos</h2>
        
        <div class="listado-productos">
            <?php
            // Array de productos (puedes moverlo a una base de datos después)
            $productos = [
                1 => [
                    'id' => 1,
                    'nombre' => 'Bufetero',
                    'descripcion' => 'Bufetero mediano perfecto para acompañar tu sala.',
                    'precio' => 6000,
                    'imagen' => 'img/producto1.jpg',
                    'stock' => true
                ],
                2 => [
                    'id' => 2,
                    'nombre' => 'Sofá en L gris',
                    'descripcion' => 'Sofá gris claro, acompañado de un conjunto de 3 cojines.',
                    'precio' => 40000,
                    'imagen' => 'img/producto2.jpg',
                    'stock' => true
                ],
                3 => [
                    'id' => 3,
                    'nombre' => 'Sofá mediano gris',
                    'descripcion' => 'Perfecto para tu sala de estar con espacio de tres personas.',
                    'precio' => 49000,
                    'imagen' => 'img/producto3.jpg',
                    'stock' => true
                ],
                4 => [
                    'id' => 4,
                    'nombre' => 'Mesa de descanso ejecutiva',
                    'descripcion' => 'Mesa mediana acompañada de dos sillas perfectas para tu oficina.',
                    'precio' => 7000,
                    'imagen' => 'img/producto4.jpg',
                    'stock' => true
                ],
                5 => [
                    'id' => 5,
                    'nombre' => 'Base de recámara gris',
                    'descripcion' => 'Base matrimonial de piel color gris.',
                    'precio' => 8500,
                    'imagen' => 'img/producto5.jpg',
                    'stock' => true
                ],
                6 => [
                    'id' => 6,
                    'nombre' => 'Sillón reclinable',
                    'descripcion' => 'Sillón reclinable en piel negra, ideal para home theater.',
                    'precio' => 12500,
                    'imagen' => 'img/producto6.jpg',
                    'stock' => true
                ]
            ];

            // Generar productos dinámicamente
            foreach($productos as $producto):
            ?>
            <div class="producto">
                <img src="<?php echo $producto['imagen']; ?>" alt="Imagen Producto">
                <div class="texto-producto">
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <p><?php echo $producto['descripcion']; ?></p>
                    <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                    <button class="btn" onclick="agregarAlCarrito(<?php echo $producto['id']; ?>, '<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>, '<?php echo $producto['imagen']; ?>')">
                        Agregar al Carrito
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="grid-footer contenedor">
            <div>
                <h3>Categorías</h3>
                <nav class="footer-menu">
                    <a href="#">Cocina</a>
                    <a href="#">Oficina</a>
                    <a href="#">Jardín</a>
                    <a href="#">Cochera</a>
                    <a href="#">Dormitorios</a>
                </nav>
            </div>
            <div>
                <h3>Sobre Nosotros</h3>
                <nav class="footer-menu">
                    <a href="#">Nuestra Historia</a>
                    <a href="#">Misión, Visión y Valores</a>
                    <a href="#">Carreras</a>
                    <a href="#">Política de Privacidad</a>
                    <a href="#">Términos del Servicio</a>
                </nav>
            </div>
            <div>
                <h3>Soporte</h3>
                <nav class="footer-menu">
                    <a href="#">Preguntas Frecuentes</a>
                    <a href="#">Ayuda en línea</a>
                    <a href="#">Confianza y Seguridad</a>
                </nav>
            </div>
        </div>
        <p class="copyright">Todos los derechos Reservados, TiendaMuebles</p>
    </footer>

    <!-- Botón flotante del carrito -->
    <div class="cart-icon-fixed" id="cartIcon">
        🛒 <span id="cartCounter">0</span>
    </div>

    <!-- Sidebar del carrito -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>🛒 Mi Carrito</h3>
            <button class="close-cart" id="closeCartBtn">&times;</button>
        </div>
        <div class="cart-items" id="cartItems">
            <div style="text-align: center; color: #ba9a7c; padding: 2rem;">🪑 Tu carrito está vacío</div>
        </div>
        <div class="cart-footer" id="cartFooter" style="display: none;">
            <div style="text-align: right; font-size: 1.2rem; font-weight: bold; margin-bottom: 1rem;">
                Total: <span id="cartTotal">$0</span>
            </div>
            <button class="btn-clear" id="clearCartBtn">Vaciar carrito</button>
            <button class="btn-checkout" id="checkoutBtn">Finalizar compra</button>
        </div>
    </div>

    <script>
        // ========== SISTEMA DE CARRITO COMPLETO ==========
        let cart = [];

        // Cargar carrito desde localStorage
        function loadCart() {
            const stored = localStorage.getItem('tienda_muebles_carrito');
            if (stored) {
                try {
                    cart = JSON.parse(stored);
                } catch(e) { 
                    cart = []; 
                }
            }
            updateCartUI();
        }

        // Guardar carrito
        function saveCart() {
            localStorage.setItem('tienda_muebles_carrito', JSON.stringify(cart));
        }

        // Agregar producto al carrito
        function agregarAlCarrito(id, nombre, precio, imagen) {
            const existing = cart.find(item => item.id === id);
            if (existing) {
                existing.cantidad += 1;
                mostrarToast(`➕ ${nombre} · Cantidad: ${existing.cantidad}`);
            } else {
                cart.push({
                    id: id,
                    nombre: nombre,
                    precio: precio,
                    cantidad: 1,
                    imagen: imagen
                });
                mostrarToast(`🪑 ${nombre} agregado al carrito`);
            }
            saveCart();
            updateCartUI();
        }

        // Actualizar cantidad
        function actualizarCantidad(id, delta) {
            const index = cart.findIndex(item => item.id === id);
            if (index === -1) return;
            const nuevaCantidad = cart[index].cantidad + delta;
            if (nuevaCantidad <= 0) {
                const nombre = cart[index].nombre;
                cart.splice(index, 1);
                mostrarToast(`❌ ${nombre} eliminado`);
            } else {
                cart[index].cantidad = nuevaCantidad;
            }
            saveCart();
            updateCartUI();
        }

        // Eliminar item
        function eliminarItem(id) {
            const item = cart.find(i => i.id === id);
            if (item) {
                cart = cart.filter(i => i.id !== id);
                mostrarToast(`🗑️ ${item.nombre} removido`);
                saveCart();
                updateCartUI();
            }
        }

        // Vaciar carrito
        function vaciarCarrito() {
            if (cart.length === 0) return;
            if (confirm("¿Vaciar completamente el carrito?")) {
                cart = [];
                saveCart();
                updateCartUI();
                mostrarToast("🧹 Carrito vaciado");
            }
        }

        // Finalizar compra
        function finalizarCompra() {
            if (cart.length === 0) {
                alert("Tu carrito está vacío");
                return;
            }
            const total = cart.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
            const totalFormateado = new Intl.NumberFormat('es-MX', {style: 'currency', currency: 'MXN'}).format(total);
            if (confirm(`Finalizar compra por ${totalFormateado}?`)) {
                alert("✨ ¡Gracias por tu compra! ✨");
                cart = [];
                saveCart();
                updateCartUI();
                mostrarToast("✅ Compra exitosa");
                cerrarCarrito();
            }
        }

        // Actualizar interfaz del carrito
        function updateCartUI() {
            const container = document.getElementById('cartItems');
            const footer = document.getElementById('cartFooter');
            const counterSpan = document.getElementById('cartCounter');
            const totalSpan = document.getElementById('cartTotal');

            const totalItems = cart.reduce((sum, item) => sum + item.cantidad, 0);
            counterSpan.textContent = totalItems;

            if (cart.length === 0) {
                container.innerHTML = '<div style="text-align: center; color: #ba9a7c; padding: 2rem;">🪑 Tu carrito está vacío</div>';
                footer.style.display = 'none';
                return;
            }

            footer.style.display = 'block';
            container.innerHTML = '';
            let totalGeneral = 0;

            cart.forEach(item => {
                const subtotal = item.precio * item.cantidad;
                totalGeneral += subtotal;
                container.innerHTML += `
                    <div style="display: flex; gap: 10px; background: #fefaf5; padding: 10px; border-radius: 1rem; margin-bottom: 10px; border-left: 4px solid #dbaa76;">
                        <img src="${item.imagen}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                        <div style="flex: 1;">
                            <strong>${item.nombre}</strong><br>
                            <small>${new Intl.NumberFormat('es-MX', {style: 'currency', currency: 'MXN'}).format(item.precio)} c/u</small>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; background: #f1e6dd; padding: 4px 8px; border-radius: 2rem;">
                            <button onclick="actualizarCantidad(${item.id}, -1)" style="background: none; border: none; font-size: 1.1rem; cursor: pointer;">−</button>
                            <span>${item.cantidad}</span>
                            <button onclick="actualizarCantidad(${item.id}, 1)" style="background: none; border: none; font-size: 1.1rem; cursor: pointer;">+</button>
                        </div>
                        <div style="font-weight: bold; min-width: 60px; text-align: right;">${new Intl.NumberFormat('es-MX', {style: 'currency', currency: 'MXN'}).format(subtotal)}</div>
                        <button onclick="eliminarItem(${item.id})" style="background: #eedbcb; border: none; border-radius: 30px; padding: 5px 10px; cursor: pointer;">✖</button>
                    </div>
                `;
            });
            totalSpan.textContent = new Intl.NumberFormat('es-MX', {style: 'currency', currency: 'MXN'}).format(totalGeneral);
        }

        // Mostrar notificación
        function mostrarToast(mensaje) {
            const toast = document.createElement('div');
            toast.className = 'toast-msg';
            toast.textContent = mensaje;
            document.body.appendChild(toast);
            setTimeout(() => {
                if (toast) toast.remove();
            }, 2500);
        }

        // Abrir/cerrar carrito
        function abrirCarrito() {
            document.getElementById('cartSidebar').classList.add('open');
        }
        function cerrarCarrito() {
            document.getElementById('cartSidebar').classList.remove('open');
        }

        // Eventos
        document.getElementById('cartIcon').addEventListener('click', abrirCarrito);
        document.getElementById('closeCartBtn').addEventListener('click', cerrarCarrito);
        document.getElementById('clearCartBtn').addEventListener('click', vaciarCarrito);
        document.getElementById('checkoutBtn').addEventListener('click', finalizarCompra);

        // Inicializar
        loadCart();
    </script>
</body>
</html>