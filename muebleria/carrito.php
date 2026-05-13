<?php
$titulo_pagina = "Tienda con Carrito";
$nombre_tienda = "Muebles Elegantes";

$productos = [
    [
        'id'          => 'prod_1',
        'nombre'      => 'Sofá Chesterfield',
        'descripcion' => 'El Chesterfield es un sillón clásico de origen británico, reconocido por su diseño elegante y sofisticado.',
        'precio'      => 18990,
        'imagen'      => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=300&fit=crop',
    ],
    [
        'id'          => 'prod_2',
        'nombre'      => 'Mesa de Roble Macizo',
        'descripcion' => 'Una mesa de Mesa de roble es un mueble resistente y elegante fabricado con madera de roble, conocida por su durabilidad y acabado natural.',
        'precio'      => 12450,
        'imagen'      => 'https://images.unsplash.com/photo-1530018607912-eff2daa1bac4?w=400&h=300&fit=crop',
    ],
    [
        'id'          => 'prod_3',
        'nombre'      => 'Biblioteca Flotante',
        'descripcion' => 'Una Biblioteca flotante es un mueble moderno diseñado para instalarse directamente en la pared, creando un efecto visual ligero y elegante.',
        'precio'      => 8790,
        'imagen'      => 'https://images.unsplash.com/photo-1594620302200-3a012244e489?w=400&h=300&fit=crop',
    ],
    [
        'id'          => 'prod_4',
        'nombre'      => 'Silla Eames Premium',
        'descripcion' => 'La Silla Eames Premium es una silla inspirada en el icónico diseño moderno de Charles y Ray Eames, reconocida por su combinación de elegancia, ergonomía y comodidad.',
        'precio'      => 7490,
        'imagen'      => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?w=400&h=300&fit=crop',
    ],
    [
        'id'          => 'prod_5',
        'nombre'      => 'Cómoda Vintage',
        'descripcion' => 'La Cómoda vintage es un mueble de almacenamiento con estilo clásico y detalles decorativos inspirados en épocas pasadas.',
        'precio'      => 15990,
        'imagen'      => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=400&h=300&fit=crop',
    ],
    [
        'id'          => 'prod_6',
        'nombre'      => 'Lámpara Arco',
        'descripcion' => 'La Lámpara arco es una lámpara de pie de diseño moderno y elegante, caracterizada por su estructura curva que permite iluminar amplios espacios sin necesidad de instalación en el techo.',
        'precio'      => 5290,
        'imagen'      => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=400&h=300&fit=crop',
    ],
];

// Serializar productos para usarlos en JS sin duplicar datos
$productos_json = json_encode($productos, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title><?php echo htmlspecialchars($nombre_tienda); ?> - <?php echo htmlspecialchars($titulo_pagina); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(135deg, #e8e0d5 0%, #d6cbbc 100%); font-family: system-ui, 'Segoe UI', 'Inter', sans-serif; }
        .contenedor { max-width: 1400px; margin: 0 auto; padding: 20px; }
        .text-center { text-align: center; }
        .contenido-principal { background: #fffef7; border-radius: 2rem; margin: 2rem auto; padding: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .contenido-principal h2 { font-size: 2rem; color: #7178d3; margin-bottom: 2rem; border-left: 6px solid #c6935e; padding-left: 1rem; display: inline-block; }
        .listado-productos { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem; margin-top: 1rem; }
        .producto { background: white; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: transform 0.25s, box-shadow 0.25s; border: 1px solid #f0e2d4; }
        .producto:hover { transform: translateY(-6px); box-shadow: 0 20px 30px rgba(0,0,0,0.12); }
        .producto img { width: 100%; height: 240px; object-fit: cover; transition: transform 0.4s ease; }
        .producto:hover img { transform: scale(1.03); }
        .texto-producto { padding: 1.2rem; }
        .texto-producto h3 { font-size: 1.3rem; color: #3f2a1c; margin-bottom: 0.5rem; }
        .texto-producto p { color: #6b4f38; line-height: 1.5; font-size: 0.9rem; margin-bottom: 0.8rem; }
        .precio { font-size: 1.5rem; font-weight: 700; color: #ad6b3c; margin: 0.8rem 0; }
        .btn { display: inline-block; background: #7c5a42; color: white; border: none; padding: 10px 20px; border-radius: 3rem; font-weight: 600; cursor: pointer; text-align: center; text-decoration: none; transition: all 0.2s; width: 100%; font-size: 0.95rem; }
        .btn:hover { background: #5e3c2b; transform: scale(0.98); }
        .cart-sidebar { position: fixed; right: 0; top: 0; width: 380px; height: 100vh; background: #fffef7; box-shadow: -5px 0 25px rgba(0,0,0,0.15); z-index: 1000; transform: translateX(100%); transition: transform 0.3s ease-in-out; display: flex; flex-direction: column; }
        .cart-sidebar.open { transform: translateX(0); }
        .cart-header { background: #2f16a0; color: #fef2e0; padding: 1.2rem; display: flex; justify-content: space-between; align-items: center; }
        .cart-header h3 { font-size: 1.3rem; display: flex; align-items: center; gap: 8px; }
        .close-cart { background: none; border: none; color: white; font-size: 1.8rem; cursor: pointer; line-height: 1; }
        .cart-items { flex: 1; overflow-y: auto; padding: 1rem; }
        .cart-empty { text-align: center; color: #ba9a7c; padding: 2rem; font-style: italic; }
        .cart-item { display: flex; gap: 12px; background: #fefaf5; padding: 12px; border-radius: 1rem; margin-bottom: 12px; border-left: 4px solid #dbaa76; align-items: center; }
        .cart-item-img { width: 60px; height: 60px; border-radius: 10px; overflow: hidden; flex-shrink: 0; }
        .cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
        .cart-item-details { flex: 1; }
        .cart-item-title { font-weight: 700; color: #4e331f; font-size: 0.9rem; }
        .cart-item-price { font-size: 0.75rem; color: #a26e46; }
        .cart-item-quantity { display: flex; align-items: center; gap: 8px; background: #f1e6dd; padding: 4px 8px; border-radius: 2rem; }
        .qty-btn { background: none; border: none; font-weight: bold; font-size: 1.1rem; cursor: pointer; width: 24px; border-radius: 50%; color: #5c3d2a; }
        .cart-item-subtotal { font-weight: 700; font-size: 0.85rem; min-width: 60px; text-align: right; }
        .remove-item { background: #eedbcb; border: none; border-radius: 30px; padding: 5px 10px; cursor: pointer; color: #b1542c; }
        .cart-footer { padding: 1rem; border-top: 2px dashed #e2cfbe; }
        .cart-total { text-align: right; font-size: 1.2rem; font-weight: 800; margin-bottom: 1rem; }
        .btn-clear, .btn-checkout { width: 100%; padding: 10px; border-radius: 3rem; font-weight: bold; margin-top: 8px; border: none; cursor: pointer; }
        .btn-clear { background: #f0e0d3; color: #8c5a3b; }
        .btn-checkout { background: #5f3d2b; color: white; }
        .cart-icon-fixed { position: fixed; bottom: 30px; right: 30px; background: #5f3d2b; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.2); z-index: 999; transition: transform 0.2s; font-size: 1.5rem; }
        .cart-icon-fixed:hover { transform: scale(1.05); }
        .cart-icon-fixed span { background: #f6bd7a; color: #3a2418; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-weight: bold; position: absolute; top: -5px; right: -5px; font-size: 0.75rem; }
        .toast-msg { position: fixed; bottom: 100px; left: 20px; background: #2c4b32; color: white; padding: 10px 18px; border-radius: 40px; font-size: 0.85rem; z-index: 1100; }
        @media (max-width: 768px) { .cart-sidebar { width: 100%; } .contenido-principal { padding: 1rem; } }
    </style>
</head>
<body>

    <!-- CARRITO FLOTANTE (SIDEBAR) -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>🛒 Mi Carrito</h3>
            <button class="close-cart" id="closeCartBtn">&times;</button>
        </div>
        <div class="cart-items" id="cartItemsContainer">
            <div class="cart-empty">🪑 Tu carrito está vacío</div>
        </div>
        <div class="cart-footer" id="cartFooter" style="display:none;">
            <div class="cart-total"><strong>Total: </strong><span id="cartTotal">$0</span></div>
            <button class="btn-clear" id="clearCartBtn">Vaciar carrito</button>
            <button class="btn-checkout" id="checkoutBtn">Finalizar compra</button>
        </div>
    </div>

    <!-- BOTÓN FLOTANTE DEL CARRITO -->
    <div class="cart-icon-fixed" id="cartIcon">
        🛒 <span id="cartCounter">0</span>
    </div>

    <main class="contenido-principal contenedor">
        <h2 class="text-center">✨ Nuestros Productos ✨</h2>

        <div class="listado-productos">
            <?php foreach ($productos as $prod): ?>
                <div class="producto">
                    <img src="<?php echo htmlspecialchars($prod['imagen']); ?>"
                         alt="<?php echo htmlspecialchars($prod['nombre']); ?>" loading="lazy">
                    <div class="texto-producto">
                        <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                        <p><?php echo htmlspecialchars($prod['descripcion']); ?></p>
                        <p class="precio">$<?php echo number_format($prod['precio'], 0, '.', ','); ?> MXN</p>
                        <button class="btn agregar-carrito"
                                data-id="<?php echo htmlspecialchars($prod['id']); ?>">
                            Agregar al Carrito
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
        
        const PRODUCTS = <?php echo $productos_json; ?>;

        let cart = [];

        function loadCart() {
            const stored = localStorage.getItem('tienda_muebles_carrito');
            if (stored) { try { cart = JSON.parse(stored); if (!Array.isArray(cart)) cart = []; } catch(e) { cart = []; } }
            updateCartUI();
        }

        function saveCart() { localStorage.setItem('tienda_muebles_carrito', JSON.stringify(cart)); }

        function addToCart(productId) {
            const product = PRODUCTS.find(p => p.id === productId);
            if (!product) return;
            const existing = cart.find(i => i.productId === productId);
            if (existing) {
                existing.quantity++;
                showToast(`➕ ${product.nombre} · Cantidad: ${existing.quantity}`);
            } else {
                cart.push({ id: Date.now() + '_' + productId, productId, name: product.nombre, price: product.precio, quantity: 1, imageUrl: product.imagen });
                showToast(`🪑 ${product.nombre} agregado al carrito`);
            }
            saveCart(); updateCartUI();
        }

        function updateQuantity(itemId, delta) {
            const idx = cart.findIndex(i => i.id === itemId);
            if (idx === -1) return;
            const newQty = cart[idx].quantity + delta;
            if (newQty <= 0) { const name = cart[idx].name; cart.splice(idx, 1); showToast(`❌ ${name} eliminado`); }
            else { cart[idx].quantity = newQty; showToast(`🔄 ${cart[idx].name} x${newQty}`); }
            saveCart(); updateCartUI();
        }

        function removeItem(itemId) {
            const item = cart.find(i => i.id === itemId);
            if (item) { cart = cart.filter(i => i.id !== itemId); showToast(`🗑️ ${item.name} removido`); saveCart(); updateCartUI(); }
        }

        function clearCart() {
            if (cart.length === 0) return;
            if (confirm("¿Vaciar completamente el carrito?")) { cart = []; saveCart(); updateCartUI(); showToast("🧹 Carrito vaciado"); }
        }

        function checkout() {
            if (cart.length === 0) { alert("Tu carrito está vacío"); return; }
            const total = cart.reduce((s, i) => s + i.price * i.quantity, 0);
            const fmt = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(total);
            if (confirm(`Finalizar compra por ${fmt}?`)) {
                alert("✨ ¡Gracias por tu compra! Tu pedido ha sido procesado.");
                cart = []; saveCart(); updateCartUI(); showToast("✅ Compra exitosa"); closeCart();
            }
        }

        function updateCartUI() {
            const container = document.getElementById('cartItemsContainer');
            const footer    = document.getElementById('cartFooter');
            const counter   = document.getElementById('cartCounter');
            const totalSpan = document.getElementById('cartTotal');

            counter.textContent = cart.reduce((s, i) => s + i.quantity, 0);

            if (cart.length === 0) { container.innerHTML = `<div class="cart-empty">🪑 Tu carrito está vacío</div>`; footer.style.display = 'none'; return; }

            footer.style.display = 'block';
            container.innerHTML = '';
            let total = 0;
            cart.forEach(item => {
                const sub = item.price * item.quantity;
                total += sub;
                const div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `
                    <div class="cart-item-img"><img src="${item.imageUrl}" alt="${escapeHtml(item.name)}"></div>
                    <div class="cart-item-details">
                        <div class="cart-item-title">${escapeHtml(item.name)}</div>
                        <div class="cart-item-price">${formatCurrency(item.price)}</div>
                    </div>
                    <div class="cart-item-quantity">
                        <button class="qty-btn" data-id="${item.id}" data-delta="-1">−</button>
                        <span>${item.quantity}</span>
                        <button class="qty-btn" data-id="${item.id}" data-delta="1">+</button>
                    </div>
                    <div class="cart-item-subtotal">${formatCurrency(sub)}</div>
                    <button class="remove-item" data-id="${item.id}">✖</button>`;
                container.appendChild(div);
            });
            totalSpan.textContent = formatCurrency(total);

            container.querySelectorAll('.qty-btn').forEach(btn =>
                btn.addEventListener('click', () => updateQuantity(btn.dataset.id, parseInt(btn.dataset.delta))));
            container.querySelectorAll('.remove-item').forEach(btn =>
                btn.addEventListener('click', () => removeItem(btn.dataset.id)));
        }

        function openCart()  { document.getElementById('cartSidebar').classList.add('open'); }
        function closeCart() { document.getElementById('cartSidebar').classList.remove('open'); }

        function formatCurrency(v) { return new Intl.NumberFormat('es-MX', { style:'currency', currency:'MXN', minimumFractionDigits:0 }).format(v); }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>]/g, m => ({ '&':'&amp;', '<':'&lt;', '>':'&gt;' }[m]));
        }

        function showToast(msg) {
            document.querySelector('.toast-msg')?.remove();
            const t = document.createElement('div');
            t.className = 'toast-msg'; t.innerText = msg;
            document.body.appendChild(t);
            setTimeout(() => t.remove(), 2500);
        }

        // Eventos
        document.getElementById('cartIcon').addEventListener('click', openCart);
        document.getElementById('closeCartBtn').addEventListener('click', closeCart);
        document.getElementById('clearCartBtn').addEventListener('click', clearCart);
        document.getElementById('checkoutBtn').addEventListener('click', checkout);

        document.querySelectorAll('.agregar-carrito').forEach(btn =>
            btn.addEventListener('click', () => addToCart(btn.dataset.id)));

        loadCart();
    </script>
</body>
</html>
