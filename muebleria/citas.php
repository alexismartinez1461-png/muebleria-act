<?php
$titulo_pagina  = "Sistema de Gestión de Citas";
$nombre_tienda  = "Muebles Elegantes";
$subtitulo      = "Asesoría personalizada · Diseño y calidad · Agenda tu visita";

$productos_interes = [
    'Sofás y butacas',
    'Mesas y escritorios',
    'Armarios y cómodas',
    'Iluminación decorativa',
    'Colección premium',
    'Asesoría de espacios',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title><?php echo htmlspecialchars($nombre_tienda); ?> - <?php echo htmlspecialchars($titulo_pagina); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: system-ui, 'Segoe UI', 'Poppins', 'Inter', sans-serif; }
        body { background: linear-gradient(145deg, #e9e4dd 0%, #d9cec0 100%); min-height: 100vh; padding: 2rem 1.5rem; }
        .app-container { max-width: 1400px; margin: 0 auto; background: rgba(255,255,245,0.92); border-radius: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.15), 0 5px 12px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #0c45e2; padding: 1.5rem 2rem; color: #fef7e6; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; border-bottom: 6px solid #309db1; }
        .title-section h1 { font-size: 1.9rem; font-weight: 700; display: flex; align-items: center; gap: 12px; }
        .title-section h1::before { content: "🪑"; font-size: 2rem; }
        .title-section p { font-size: 0.9rem; opacity: 0.85; margin-top: 6px; }
        .stats { background: #221d38e7; padding: 0.6rem 1.2rem; border-radius: 60px; font-weight: 500; text-align: center; }
        .stats span { font-size: 1.8rem; font-weight: 800; color: #f7d9a8; margin-right: 6px; }
        .main-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 1.8rem; padding: 2rem; }
        .form-card { background: white; border-radius: 1.8rem; padding: 1.8rem; box-shadow: 0 8px 20px rgba(0,0,0,0.05); border: 1px solid #f0e2d4; }
        .form-card h2 { font-size: 1.6rem; color: #4b2e1e; border-left: 8px solid #c9a87b; padding-left: 1rem; margin-bottom: 1.5rem; font-weight: 600; }
        .input-group { margin-bottom: 1.3rem; display: flex; flex-direction: column; gap: 6px; }
        .input-group label { font-weight: 600; color: #5a3a28; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .input-group input, .input-group select { padding: 12px 16px; border: 1.5px solid #e2d4c8; border-radius: 1.2rem; font-size: 0.95rem; background: #fffcf8; transition: 0.2s; }
        .input-group input:focus, .input-group select:focus { border-color: #b8875a; outline: none; box-shadow: 0 0 0 3px rgba(41,11,211,0.2); }
        .double-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }
        .btn { border: none; cursor: pointer; padding: 12px 20px; border-radius: 3rem; font-weight: 700; font-size: 1rem; transition: all 0.2s ease; }
        .btn-primary { background: #7e5a42; color: white; box-shadow: 0 2px 6px rgba(0,0,0,0.1); width: 100%; }
        .btn-primary:hover { background: #5e3c2b; transform: translateY(-2px); }
        .appointments-list { background: white; border-radius: 1.8rem; padding: 1.5rem; box-shadow: 0 8px 20px rgba(0,0,0,0.05); display: flex; flex-direction: column; overflow: hidden; }
        .list-header { display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; margin-bottom: 1.5rem; border-bottom: 2px dashed #ecd9c9; padding-bottom: 0.8rem; }
        .list-header h2 { font-size: 1.5rem; color: #4b2e1e; display: flex; align-items: center; gap: 8px; }
        .filter-buttons { display: flex; gap: 8px; }
        .filter-btn { background: #f3ede7; border: none; padding: 5px 14px; border-radius: 40px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s; color: #5e3c2b; }
        .filter-btn.active { background: #7e5a42; color: white; }
        .cards-container { max-height: 520px; overflow-y: auto; padding-right: 5px; }
        .cita-card { background: #fefaf5; border-radius: 1.2rem; padding: 1rem 1.2rem; margin-bottom: 1rem; border-left: 6px solid #dbba95; display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center; gap: 0.8rem; }
        .cita-info { flex: 3; }
        .cita-info h3 { font-size: 1.1rem; font-weight: 700; color: #4c351f; }
        .cita-details { display: flex; flex-wrap: wrap; gap: 0.8rem; margin-top: 6px; font-size: 0.8rem; color: #7c6351; }
        .badge { background: #e9dbcf; padding: 4px 12px; border-radius: 50px; font-weight: 500; font-size: 0.7rem; }
        .estado-badge { background: #e1cfbe; color: #6b3e26; font-weight: 600; }
        .acciones { display: flex; gap: 0.6rem; }
        .btn-sm { padding: 8px 14px; font-size: 0.75rem; border-radius: 2rem; font-weight: 600; border: none; cursor: pointer; }
        .btn-complete { background: #c7e2d1; color: #2a6b47; }
        .btn-delete { background: #f3ded5; color: #bb5e3a; }
        .empty-state { text-align: center; padding: 2.5rem; color: #b4906e; font-style: italic; }
        footer { background: #f3ede7; padding: 1rem; text-align: center; font-size: 0.75rem; color: #947b64; border-top: 1px solid #e6d6c8; }
        @media (max-width: 800px) { .main-grid { grid-template-columns: 1fr; padding: 1.2rem; } body { padding: 1rem; } .header { flex-direction: column; text-align: center; } }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #ece1d6; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #c5aa8b; border-radius: 10px; }
    </style>
</head>
<body>
<div class="app-container">

    <div class="header">
        <div class="title-section">
            <h1><?php echo htmlspecialchars($nombre_tienda); ?></h1>
            <p><?php echo htmlspecialchars($subtitulo); ?></p>
        </div>
        <div class="stats">
            📅 <span id="totalCitasCount">0</span> citas registradas
        </div>
    </div>

    <div class="main-grid">

        <!-- FORMULARIO DE REGISTRO -->
        <div class="form-card">
            <h2>➕ Nueva cita</h2>
            <form id="appointmentForm">
                <div class="input-group">
                    <label>👤 Nombre completo</label>
                    <input type="text" id="clienteNombre" placeholder="Ej: Laura Fernández" required>
                </div>
                <div class="input-group">
                    <label>📞 Teléfono / contacto</label>
                    <input type="text" id="clienteTelefono" placeholder="+52 331 234 5678" required>
                </div>
                <div class="double-row">
                    <div class="input-group">
                        <label>📅 Fecha</label>
                        <input type="date" id="fechaCita" required>
                    </div>
                    <div class="input-group">
                        <label>⏰ Hora</label>
                        <input type="time" id="horaCita" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>🛋️ Interés / Producto</label>
                    <select id="productoInteres">
                        <?php foreach ($productos_interes as $producto): ?>
                            <option value="<?php echo htmlspecialchars($producto); ?>">
                                <?php echo htmlspecialchars($producto); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <label>✏️ Notas adicionales (opcional)</label>
                    <input type="text" id="notasCita" placeholder="Ej: traer medidas, acompañante...">
                </div>
                <button type="submit" class="btn btn-primary">📌 Agendar cita</button>
            </form>
        </div>

        <!-- LISTA Y GESTIÓN DE CITAS -->
        <div class="appointments-list">
            <div class="list-header">
                <h2>📋 Mis citas agendadas</h2>
                <div class="filter-buttons">
                    <button data-filter="all" class="filter-btn active">Todas</button>
                    <button data-filter="pendiente" class="filter-btn">Pendientes</button>
                    <button data-filter="completada" class="filter-btn">Completadas</button>
                </div>
            </div>
            <div id="citasContainer" class="cards-container">
                <div class="empty-state">✨ No hay citas registradas. Completa el formulario para comenzar.</div>
            </div>
        </div>

    </div>

    <footer>🪑 <?php echo htmlspecialchars($nombre_tienda); ?> - Sistema integral de gestión de citas | Estado: pendiente / completada</footer>
</div>

<script>
    let citas = [];

    function loadFromStorage() {
        const stored = localStorage.getItem('muebles_citas_system');
        if (stored) {
            try {
                citas = JSON.parse(stored);
                citas = citas.map(c => ({ ...c, estado: c.estado || 'pendiente' }));
            } catch(e) { console.warn(e); }
        } else {
            citas = [
                { id: "cita_demo_1", nombre: "Carlos Mendoza", telefono: "555-1234", fecha: "2025-04-18", hora: "11:00", producto: "Sofás y butacas", notas: "Interesado en sofá esquinero color gris", estado: "pendiente" },
                { id: "cita_demo_2", nombre: "Valeria Sánchez", telefono: "555-9876", fecha: "2025-04-20", hora: "16:30", producto: "Mesas y escritorios", notas: "Escritorio de roble macizo", estado: "completada" }
            ];
        }
        updateUI();
    }

    function saveToStorage() { localStorage.setItem('muebles_citas_system', JSON.stringify(citas)); }

    let currentFilter = "all";

    function getFilteredCitas() {
        return currentFilter === "all" ? citas : citas.filter(c => c.estado === currentFilter);
    }

    function renderCitas() {
        const container = document.getElementById('citasContainer');
        const filtered = getFilteredCitas();
        document.getElementById('totalCitasCount').textContent = citas.length;

        if (filtered.length === 0) {
            container.innerHTML = `<div class="empty-state">📭 No hay citas${currentFilter !== 'all' ? (currentFilter === 'pendiente' ? ' pendientes' : ' completadas') : ''}. ¡Agenda una nueva!</div>`;
            return;
        }

        container.innerHTML = "";
        filtered.forEach(cita => {
            const card = document.createElement('div');
            card.className = 'cita-card';
            const fechaLegible = cita.fecha ? cita.fecha.split('-').reverse().join('/') : 'Sin fecha';
            const estadoTexto = cita.estado === 'pendiente' ? '⏳ Pendiente' : '✅ Completada';
            card.innerHTML = `
                <div class="cita-info">
                    <h3>${escapeHtml(cita.nombre)}</h3>
                    <div class="cita-details">
                        <span>📞 ${escapeHtml(cita.telefono)}</span>
                        <span>📅 ${fechaLegible} - ⏰ ${cita.hora}</span>
                        <span class="badge">🪑 ${escapeHtml(cita.producto)}</span>
                        <span class="badge estado-badge">${estadoTexto}</span>
                    </div>
                    ${cita.notas ? `<div style="font-size:0.75rem;margin-top:6px;color:#8b6b50;">📝 ${escapeHtml(cita.notas)}</div>` : ''}
                </div>
                <div class="acciones">
                    ${cita.estado === 'pendiente' ? `<button class="btn-sm btn-complete" data-id="${cita.id}">✔ Completar</button>` : ''}
                    <button class="btn-sm btn-delete" data-id="${cita.id}">🗑 Eliminar</button>
                </div>`;
            container.appendChild(card);
        });

        container.querySelectorAll('.btn-complete').forEach(btn =>
            btn.addEventListener('click', () => marcarComoCompletada(btn.dataset.id)));
        container.querySelectorAll('.btn-delete').forEach(btn =>
            btn.addEventListener('click', () => eliminarCita(btn.dataset.id)));
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;' }[m]));
    }

    function agregarCita(e) {
        e.preventDefault();
        const nombre   = document.getElementById('clienteNombre').value.trim();
        const telefono = document.getElementById('clienteTelefono').value.trim();
        const fecha    = document.getElementById('fechaCita').value;
        const hora     = document.getElementById('horaCita').value;
        const producto = document.getElementById('productoInteres').value;
        const notas    = document.getElementById('notasCita').value.trim();

        if (!nombre || !telefono || !fecha || !hora) {
            alert("❌ Completa todos los campos obligatorios.");
            return;
        }

        citas.push({ id: 'cita_' + Date.now(), nombre, telefono, fecha, hora, producto, notas, estado: 'pendiente' });
        saveToStorage();
        document.getElementById('appointmentForm').reset();
        setDefaultDate();
        updateUI();
        mostrarNotificacion("📆 ¡Cita agendada para " + nombre + "!");
    }

    function marcarComoCompletada(id) {
        const cita = citas.find(c => c.id === id);
        if (cita && cita.estado === 'pendiente') {
            cita.estado = 'completada';
            saveToStorage(); updateUI();
            mostrarNotificacion("✅ Cita completada: " + cita.nombre);
        }
    }

    function eliminarCita(id) {
        const cita = citas.find(c => c.id === id);
        if (!cita) return;
        if (confirm(`¿Eliminar la cita de ${cita.nombre}?`)) {
            citas = citas.filter(c => c.id !== id);
            saveToStorage(); updateUI();
            mostrarNotificacion("🗑️ Cita eliminada.");
        }
    }

    function updateUI() {
        renderCitas();
        document.querySelectorAll('.filter-btn').forEach(btn =>
            btn.classList.toggle('active', btn.dataset.filter === currentFilter));
    }

    function mostrarNotificacion(msg) {
        const toast = document.createElement('div');
        Object.assign(toast.style, { position:'fixed', bottom:'20px', right:'20px', background:'#5e3c2b', color:'#faeedb', padding:'12px 22px', borderRadius:'3rem', fontWeight:'500', boxShadow:'0 8px 18px rgba(0,0,0,0.2)', zIndex:'999', fontSize:'0.9rem', borderLeft:'5px solid #e9bc7d' });
        toast.innerText = msg;
        document.body.appendChild(toast);
        setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.3s'; setTimeout(() => toast.remove(), 400); }, 2800);
    }

    function setDefaultDate() {
        const dateInput = document.getElementById('fechaCita');
        const today = new Date();
        const pad = n => String(n).padStart(2, '0');
        dateInput.min = `${today.getFullYear()}-${pad(today.getMonth()+1)}-${pad(today.getDate())}`;
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        dateInput.value = `${tomorrow.getFullYear()}-${pad(tomorrow.getMonth()+1)}-${pad(tomorrow.getDate())}`;
        const timeInput = document.getElementById('horaCita');
        if (!timeInput.value) timeInput.value = "10:00";
    }

    function init() {
        loadFromStorage();
        setDefaultDate();
        document.querySelectorAll('.filter-btn').forEach(btn =>
            btn.addEventListener('click', () => { currentFilter = btn.dataset.filter; updateUI(); }));
        document.getElementById('appointmentForm').addEventListener('submit', agregarCita);
        updateUI();
    }

    init();
</script>
</body>
</html>