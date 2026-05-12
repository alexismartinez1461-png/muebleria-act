
<?php
// Iniciar sesión si necesitas carrito o citas
session_start();

// Incluir funciones comunes (las crearemos después)
// include 'includes/funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - Home</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Raleway:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <!-- Estilos adicionales para el carrito -->
    <style>
        /* Estilos rápidos para que el carrito se vea bien */
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
        }
        .cart-sidebar {
            position: fixed;
            right: 0;
            top: 0;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 25px rgba(0,0,0,0.15);
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .cart-sidebar.open {
            transform: translateX(0);
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

    <div class="hero"></div>

    <section class="contenedor categorias">
        <h2 class="text-center">Categorías de Productos</h2>
        <div class="listado-categorias">
            <div class="categoria">
                <img src="img/categoria1.jpg" alt="Imagen Categoría" />
                <a href="#">Oficina</a>
            </div>
            <div class="categoria">
                <img src="img/categoria2.jpg" alt="Imagen Categoría" />
                <a href="#">Hogar</a>
            </div>
            <div class="categoria">
                <img src="img/categoria3.jpg" alt="Imagen Categoría" />
                <a href="#">Cocina</a>
            </div>
        </div>
    </section>

    <section class="sobre-nosotros">
        <div class="contenedor sobre-nosotros-grid">
            <div class="texto-nosotros">
                <h2>Sobre Nosotros</h2>
                <p>Tu mueblería de confianza, hechas a mano y carpintería de calidad!</p>
            </div>
        </div>
    </section>

    <main class="contenido-principal contenedor">
        <h2 class="text-center">Nuestros Productos</h2>
        
        <div class="listado-productos">
            <!-- Producto 1 -->
            <div class="producto">
                <img src="img/producto1.jpg" alt="Imagen Producto">
                <div class="texto-producto">
                    <h3>Bufetero</h3>
                    <p>Bufetero mediano perfecto para acompañar tu sala.</p>
                    <p class="precio">$6,000.00</p>
                    <button class="btn" onclick="agregarAlCarrito(1, 'Bufetero', 6000, 'img/producto1.jpg')">Agregar al Carrito</button>
                </div>
            </div>

            <!-- Producto 2 -->
            <div class="producto">
                <img src="img/producto2.jpg" alt="Imagen Producto">
                <div class="texto-producto">
                    <h3>Sofá en L gris</h3>
                    <p>Sofá gris claro, acompañado de un conjunto de 3 cojines.</p>
                    <p class="precio">$40,000.00</p>
                    <button class="btn" onclick="agregarAlCarrito(2, 'Sofá en L gris', 40000, 'img/producto2.jpg')">Agregar al Carrito</button>
                </div>
            </div>

            <!-- Producto 3 -->
            <div class="producto">
                <img src="img/producto3.jpg" alt="Imagen Producto">
                <div class="texto-producto">
                    <h3>Sofá mediano gris</h3>
                    <p>Perfecto para tu sala de estar con espacio de tres personas.</p>
                    <p class="precio">$49,000.00</p>
                    <button class="btn" onclick="agregarAlCarrito(3, 'Sofá mediano gris', 49000, 'img/producto3.jpg')">Agregar al Carrito</button>
                </div>
            </div>

            <!-- Producto 4 -->
            <div class="producto">
                <img src="img/producto4.jpg" alt="Imagen Producto">
                <div class="texto-producto">
                    <h3>Mesa de descanso ejecutiva</h3>
                    <p>Mesa mediana acompañada de dos sillas perfectas para tu oficina.</p>
                    <p class="precio">$7,000.00</p>
                    <button class="btn" onclick="agregarAlCarrito(4, 'Mesa de descanso ejecutiva', 7000, 'img/producto4.jpg')">Agregar al Carrito</button>
                </div>
            </div>

            <!-- Producto 5 -->
            <div class="producto">
                <img src="img/producto5.jpg" alt="Imagen Producto">
                <div class="texto-producto">
                    <h3>Base de recámara gris</h3>
                    <p>Base matrimonial de piel color gris.</p>
                    <p class="precio">$8,500.00</p>
                    <button class="btn" onclick="agregarAlCarrito(5, 'Base de recámara gris', 8500, 'img/producto5.jpg')">Agregar al Carrito</button>
                </div>
            </div>
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

    <!-- Panel del carrito -->
    <div class="cart-sidebar" id="cartSidebar">
        <div style="background: #4f3222; color: white; padding: 1rem; display: flex; justify-content: space-between;">
            <h3>🛒 Mi Carrito</h3>
            <button id="closeCartBtn" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div id="cartItemsContainer" style="padding: 1rem; max-height: 70vh; overflow-y: auto;">
            <div style="text-align: center; color: #ba9a7c;">🪑 Tu carrito está vacío</div>
        </div>
        <div id="cartFooter" style="padding: 1rem; border-top: 2px dashed #e2cfbe; display: none;">
            <div style="text-align: right; font-size: 1.2rem; font-weight: bold; margin-bottom: 1rem;">
                Total: <span id="cartTotal">$0</span>
            </div>
            <button id="clearCartBtn" style="width: 100%; padding: 10px; margin-bottom: 8px; border-radius: 2rem; border: none; background: #f0e0d3;">Vaciar carrito</button>
            <button id="checkoutBtn" style="width: 100%; padding: 10px; border-radius: 2rem; border: none; background: #5f3d2b; color: white;">Finalizar compra</button>
        </div>
    </div>

    <script>
        // ========== SISTEMA DE CARRITO ==========
        let cart = [];

        // Cargar carrito guardado
        function loadCart() {
            const stored = localStorage.getItem('tienda_muebles_carrito');
            if (stored) {
                try {
                    cart = JSON.parse(stored);
                } catch(e) { cart = []; }
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
            const container = document.getElementById('cartItemsContainer');
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
            toast.textContent = mensaje;
            toast.style.position = 'fixed';
            toast.style.bottom = '100px';
            toast.style.left = '20px';
            toast.style.background = '#2c4b32';
            toast.style.color = 'white';
            toast.style.padding = '10px 18px';
            toast.style.borderRadius = '40px';
            toast.style.zIndex = '1100';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2500);
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