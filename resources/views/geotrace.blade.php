<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GeoTrace Studio – Latenia GIS</title>
  <meta name="description" content="Gambar polyline jalan dan polygon wilayah di peta interaktif." />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    .color-dot {
      width: 10px; height: 10px; border-radius: 50%;
      display: inline-block; flex-shrink: 0;
    }
    .drawing-hint {
      position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
      z-index: 800;
      background: rgba(10,13,20,.92);
      backdrop-filter: blur(10px);
      border: 1px solid var(--border-glow);
      border-radius: var(--radius-sm);
      padding: 10px 18px;
      font-size: 12px; font-weight: 500; color: var(--text-muted);
      pointer-events: none;
      transition: var(--transition);
    }
    .drawing-hint.hidden { opacity: 0; }
    .type-pill {
      padding: 2px 8px; border-radius: 99px; font-size: 10px; font-weight: 700;
    }
    .pill-polyline { background: rgba(79,142,247,.2); color: #4f8ef7; }
    .pill-polygon  { background: rgba(124,58,237,.2); color: #7c3aed; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="nav">
    <a href="{{ url('/') }}" class="nav-brand">
      <div class="nav-logo">🌐</div>
      <div class="nav-title">Latenia <span>GIS</span></div>
    </a>
    <div class="nav-links">
      <a href="{{ url('/geotrace') }}"   class="nav-link active">GeoTrace Studio</a>
      <a href="{{ url('/fuelpoint') }}"  class="nav-link">FuelPoint Manager</a>
      <a href="{{ url('/povertymap') }}" class="nav-link">Poverty Map</a>
      <button id="theme-toggle" class="nav-link" style="background: transparent; border: none; cursor: pointer; padding: 6px 14px; display: flex; align-items: center; gap: 4px;" title="Toggle Light/Dark Mode">
        <span id="theme-icon">🌙</span>
      </button>
      @auth
      <span style="font-size:12px;color:var(--text-muted);padding:0 6px;">👤 {{ auth()->user()->name }}</span>
      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="nav-link" style="background:transparent;border:none;cursor:pointer;color:var(--accent-poor);padding:6px 12px;font-size:12px;font-weight:600;">🚪 Keluar</button>
      </form>
      @endauth
    </div>
  </nav>

  <!-- Sidebar Panel -->
  <aside class="panel" id="sidebar">
    <div class="panel-header">
      <div class="panel-title">🗺️ GeoTrace Studio</div>
      <div class="panel-subtitle">Gambar & kelola feature spasial</div>
    </div>

    <div class="panel-body">

      <!-- Stats -->
      <div class="stat-row">
        <div class="stat-box">
          <div class="stat-val" id="count-polyline">0</div>
          <div class="stat-lbl">Polyline</div>
        </div>
        <div class="stat-box">
          <div class="stat-val" id="count-polygon">0</div>
          <div class="stat-lbl">Polygon</div>
        </div>
      </div>

      <div class="divider"></div>
      <div class="section-label">Warna Gambar</div>

      <!-- Color picker -->
      <div class="color-swatches" id="color-swatches">
        <div class="swatch selected" data-color="#4f8ef7" style="background:#4f8ef7"></div>
        <div class="swatch" data-color="#7c3aed" style="background:#7c3aed"></div>
        <div class="swatch" data-color="#10b981" style="background:#10b981"></div>
        <div class="swatch" data-color="#f59e0b" style="background:#f59e0b"></div>
        <div class="swatch" data-color="#ef4444" style="background:#ef4444"></div>
        <div class="swatch" data-color="#ec4899" style="background:#ec4899"></div>
        <div class="swatch" data-color="#f97316" style="background:#f97316"></div>
        <div class="swatch" data-color="#06b6d4" style="background:#06b6d4"></div>
      </div>

      <div class="divider"></div>
      <div class="section-label">Feature List</div>

      <!-- Feature list -->
      <div id="feature-list" style="display:flex;flex-direction:column;gap:8px;">
        <div style="text-align:center;padding:24px 0;color:var(--text-dim);font-size:12px;">
          Belum ada feature. Gunakan toolbar di atas peta untuk mulai menggambar.
        </div>
      </div>

    </div>
  </aside>

  <!-- Map -->
  <div class="map-wrap">
    <!-- Toolbar -->
    <div class="map-toolbar">
      <button class="tool-btn" id="tool-none">
        🗺️ Pilih
      </button>
      <button class="tool-btn" id="tool-polyline">
        〰️ Polyline
      </button>
      <button class="tool-btn" id="tool-polygon">
        ⬡ Polygon
      </button>
      <button class="tool-btn btn-danger" id="tool-undo" style="border:none;padding:8px 12px;">
        ↩️ Undo
      </button>
      <button class="tool-btn" id="tool-finish" style="display:none;">
        ✓ Selesai
      </button>
    </div>

    <!-- Hint -->
    <div class="drawing-hint hidden" id="drawing-hint">
      Klik untuk menambah titik · Klik titik pertama atau tekan ✓ Selesai untuk menutup
    </div>

    <div id="map"></div>
  </div>

  <!-- Save Modal -->
  <div class="modal-overlay" id="save-modal">
    <div class="modal">
      <div class="modal-header">
        <div class="modal-title" id="save-modal-title">Simpan Feature</div>
        <button class="modal-close" id="close-save-modal">✕</button>
      </div>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <div class="form-group">
          <label class="form-label">Nama Feature *</label>
          <input type="text" class="form-input" id="f-name" placeholder="e.g. Jalan Sudirman" />
        </div>
        <div class="form-group">
          <label class="form-label">Deskripsi</label>
          <textarea class="form-textarea" id="f-desc" placeholder="Keterangan tambahan..."></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" id="btn-cancel-save">Batal</button>
        <button class="btn btn-primary" id="btn-confirm-save">💾 Simpan</button>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal-overlay" id="edit-modal">
    <div class="modal">
      <div class="modal-header">
        <div class="modal-title">Edit Feature</div>
        <button class="modal-close" id="close-edit-modal">✕</button>
      </div>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <div class="form-group">
          <label class="form-label">Nama Feature *</label>
          <input type="text" class="form-input" id="ef-name" />
        </div>
        <div class="form-group">
          <label class="form-label">Deskripsi</label>
          <textarea class="form-textarea" id="ef-desc"></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Warna</label>
          <div class="color-swatches" id="edit-color-swatches">
            <div class="swatch" data-color="#4f8ef7" style="background:#4f8ef7"></div>
            <div class="swatch" data-color="#7c3aed" style="background:#7c3aed"></div>
            <div class="swatch" data-color="#10b981" style="background:#10b981"></div>
            <div class="swatch" data-color="#f59e0b" style="background:#f59e0b"></div>
            <div class="swatch" data-color="#ef4444" style="background:#ef4444"></div>
            <div class="swatch" data-color="#ec4899" style="background:#ec4899"></div>
            <div class="swatch" data-color="#f97316" style="background:#f97316"></div>
            <div class="swatch" data-color="#06b6d4" style="background:#06b6d4"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" id="btn-delete-feature">🗑️ Hapus</button>
        <button class="btn btn-secondary" id="btn-cancel-edit">Batal</button>
        <button class="btn btn-primary" id="btn-confirm-edit">Simpan</button>
      </div>
    </div>
  </div>

  <!-- Toast container -->
  <div class="toast-container" id="toast-container"></div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    // ── Config ─────────────────────────────────────────────────────
    const API = '/api/geotrace';

    // ── Map Setup ──────────────────────────────────────────────────
    const map = L.map('map', { zoomControl: false }).setView([-0.02, 109.34], 13);
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
      maxZoom: 19
    }).addTo(map);

    // ── State ──────────────────────────────────────────────────────
    let activeTool   = 'none';
    let drawPoints   = [];
    let drawLayer    = null;
    let tempMarkers  = [];
    let selectedColor = '#4f8ef7';
    let features     = {};
    let editingId    = null;
    let editColor    = '#4f8ef7';
    let pendingCoords = null;
    let pendingType   = null;

    // ── Helpers ────────────────────────────────────────────────────
    function showToast(msg, type = 'success') {
      const tc = document.getElementById('toast-container');
      const t  = document.createElement('div');
      t.className = `toast ${type}`;
      t.innerHTML = (type === 'success' ? '✅' : '❌') + ' ' + msg;
      tc.appendChild(t);
      setTimeout(() => t.remove(), 3200);
    }

    function openModal(id)  { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }

    function updateStats() {
      let pl = 0, pg = 0;
      Object.values(features).forEach(f => {
        if (f.data.type === 'polyline') pl++; else pg++;
      });
      document.getElementById('count-polyline').textContent = pl;
      document.getElementById('count-polygon').textContent  = pg;
    }

    // ── Tool switching ─────────────────────────────────────────────
    function setTool(tool) {
      activeTool = tool;
      document.querySelectorAll('.tool-btn').forEach(b => b.classList.remove('active'));
      document.getElementById(`tool-${tool}`)?.classList.add('active');

      const hint   = document.getElementById('drawing-hint');
      const finish = document.getElementById('tool-finish');

      if (tool === 'none') {
        hint.classList.add('hidden');
        finish.style.display = 'none';
        clearDraw();
        map.getContainer().style.cursor = '';
      } else {
        hint.classList.remove('hidden');
        finish.style.display = 'flex';
        map.getContainer().style.cursor = 'crosshair';
        if (tool === 'polyline') {
          hint.textContent = 'Klik untuk menambah titik · Klik Selesai untuk menyimpan';
        } else {
          hint.textContent = 'Klik untuk menambah titik · Klik titik pertama atau Selesai untuk menutup polygon';
        }
      }
    }

    document.getElementById('tool-none').addEventListener('click', () => setTool('none'));
    document.getElementById('tool-polyline').addEventListener('click', () => setTool('polyline'));
    document.getElementById('tool-polygon').addEventListener('click', () => setTool('polygon'));

    // ── Color picker ───────────────────────────────────────────────
    document.querySelectorAll('#color-swatches .swatch').forEach(sw => {
      sw.addEventListener('click', () => {
        document.querySelectorAll('#color-swatches .swatch').forEach(s => s.classList.remove('selected'));
        sw.classList.add('selected');
        selectedColor = sw.dataset.color;
        if (drawLayer) redrawTemp();
      });
    });

    document.querySelectorAll('#edit-color-swatches .swatch').forEach(sw => {
      sw.addEventListener('click', () => {
        document.querySelectorAll('#edit-color-swatches .swatch').forEach(s => s.classList.remove('selected'));
        sw.classList.add('selected');
        editColor = sw.dataset.color;
      });
    });

    // ── Draw on map ────────────────────────────────────────────────
    function clearDraw() {
      drawPoints = [];
      if (drawLayer) { map.removeLayer(drawLayer); drawLayer = null; }
      tempMarkers.forEach(m => map.removeLayer(m));
      tempMarkers = [];
    }

    function redrawTemp() {
      if (drawLayer) map.removeLayer(drawLayer);
      if (drawPoints.length < 2) { drawLayer = null; return; }

      const opts = { color: selectedColor, weight: 3, dashArray: '6 4', opacity: .85 };
      drawLayer = activeTool === 'polygon'
        ? L.polygon(drawPoints, { ...opts, fillColor: selectedColor, fillOpacity: .15 })
        : L.polyline(drawPoints, opts);
      drawLayer.addTo(map);
    }

    map.on('click', (e) => {
      if (activeTool === 'none') return;
      if (activeTool === 'polygon' && drawPoints.length >= 3) {
        const first = drawPoints[0];
        const pxFirst = map.latLngToContainerPoint(L.latLng(first));
        const pxClick = map.latLngToContainerPoint(e.latlng);
        const dist = pxFirst.distanceTo(pxClick);
        if (dist < 16) { finishDrawing(); return; }
      }

      drawPoints.push([e.latlng.lat, e.latlng.lng]);

      const vMarker = L.circleMarker(e.latlng, {
        radius: 5, color: selectedColor, fillColor: '#fff', fillOpacity: 1, weight: 2
      }).addTo(map);
      tempMarkers.push(vMarker);
      redrawTemp();
    });

    // ── Undo ───────────────────────────────────────────────────────
    document.getElementById('tool-undo').addEventListener('click', () => {
      if (!drawPoints.length) return;
      drawPoints.pop();
      const last = tempMarkers.pop();
      if (last) map.removeLayer(last);
      redrawTemp();
    });

    // ── Finish ─────────────────────────────────────────────────────
    document.getElementById('tool-finish').addEventListener('click', finishDrawing);

    function finishDrawing() {
      if (activeTool === 'polyline' && drawPoints.length < 2) {
        showToast('Minimal 2 titik untuk polyline', 'error'); return;
      }
      if (activeTool === 'polygon' && drawPoints.length < 3) {
        showToast('Minimal 3 titik untuk polygon', 'error'); return;
      }
      pendingCoords = [...drawPoints];
      pendingType   = activeTool;

      document.getElementById('save-modal-title').textContent =
        pendingType === 'polyline' ? '💾 Simpan Polyline' : '💾 Simpan Polygon';
      document.getElementById('f-name').value = '';
      document.getElementById('f-desc').value = '';
      openModal('save-modal');
    }

    // ── Save modal ─────────────────────────────────────────────────
    document.getElementById('close-save-modal').addEventListener('click', () => closeModal('save-modal'));
    document.getElementById('btn-cancel-save').addEventListener('click', () => closeModal('save-modal'));
    document.getElementById('btn-confirm-save').addEventListener('click', async () => {
      const name = document.getElementById('f-name').value.trim();
      if (!name) { showToast('Nama wajib diisi', 'error'); return; }

      try {
        const res = await fetch(API, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            name, description: document.getElementById('f-desc').value,
            type: pendingType, color: selectedColor, coordinates: pendingCoords
          })
        });
        const j = await res.json();
        if (!j.success) throw new Error(j.message);
        addFeatureToMap(j.data);
        showToast(`${pendingType} "${name}" disimpan`);
        closeModal('save-modal');
        clearDraw();
        setTool('none');
      } catch(e) { showToast(e.message, 'error'); }
    });

    // ── Add feature to map ─────────────────────────────────────────
    function addFeatureToMap(data) {
      const coords = typeof data.coordinates === 'string'
        ? JSON.parse(data.coordinates) : data.coordinates;

      const opts = { color: data.color, weight: 3, opacity: .9 };
      let layer;
      if (data.type === 'polygon') {
        layer = L.polygon(coords, { ...opts, fillColor: data.color, fillOpacity: .2 });
      } else {
        layer = L.polyline(coords, opts);
      }

      const popHtml = `
        <div style="min-width:160px;">
          <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:14px;margin-bottom:4px;">${data.name}</div>
          <div style="font-size:11px;color:#6b7a99;margin-bottom:10px;">${data.description || 'Tidak ada deskripsi'}</div>
          <span class="type-pill pill-${data.type}">${data.type}</span>
          <button onclick="openEditModal(${data.id})"
            style="margin-top:10px;width:100%;padding:6px;border-radius:6px;border:1px solid rgba(255,255,255,.1);
                   background:rgba(79,142,247,.15);color:#4f8ef7;font-size:12px;cursor:pointer;font-weight:600;">
            ✏️ Edit
          </button>
        </div>`;

      layer.bindPopup(popHtml);
      layer.addTo(map);
      features[data.id] = { data, layer };
      renderList();
      updateStats();
    }

    // ── List rendering ─────────────────────────────────────────────
    function renderList() {
      const list = document.getElementById('feature-list');
      const all  = Object.values(features);

      if (!all.length) {
        list.innerHTML = `<div style="text-align:center;padding:24px 0;color:var(--text-dim);font-size:12px;">
          Belum ada feature.</div>`;
        return;
      }

      list.innerHTML = all.map(f => `
        <div class="list-item" onclick="flyToFeature(${f.data.id})">
          <div class="list-item-icon" style="background:${f.data.color}22;">
            ${f.data.type === 'polyline' ? '〰️' : '⬡'}
          </div>
          <div class="list-item-info">
            <div class="list-item-name">${f.data.name}</div>
            <div class="list-item-meta">
              <span class="type-pill pill-${f.data.type}">${f.data.type}</span>
            </div>
          </div>
          <div class="list-item-actions">
            <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation();openEditModal(${f.data.id})">✏️</button>
          </div>
        </div>
      `).join('');
    }

    window.flyToFeature = (id) => {
      const f = features[id];
      if (!f) return;
      map.fitBounds(f.layer.getBounds(), { padding: [40,40] });
      f.layer.openPopup();
    };

    // ── Edit modal ─────────────────────────────────────────────────
    window.openEditModal = (id) => {
      editingId = id;
      const f   = features[id];
      document.getElementById('ef-name').value = f.data.name;
      document.getElementById('ef-desc').value = f.data.description || '';
      editColor = f.data.color;
      document.querySelectorAll('#edit-color-swatches .swatch').forEach(s => {
        s.classList.toggle('selected', s.dataset.color === editColor);
      });
      openModal('edit-modal');
    };

    document.getElementById('close-edit-modal').addEventListener('click', () => closeModal('edit-modal'));
    document.getElementById('btn-cancel-edit').addEventListener('click', () => closeModal('edit-modal'));

    document.getElementById('btn-confirm-edit').addEventListener('click', async () => {
      const name = document.getElementById('ef-name').value.trim();
      if (!name) { showToast('Nama wajib diisi', 'error'); return; }
      try {
        const res = await fetch(`${API}/${editingId}`, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, description: document.getElementById('ef-desc').value, color: editColor })
        });
        const j = await res.json();
        if (!j.success) throw new Error(j.message);

        const f = features[editingId];
        f.data.name  = name;
        f.data.color = editColor;
        f.data.description = document.getElementById('ef-desc').value;
        f.layer.setStyle({ color: editColor, fillColor: editColor });
        renderList(); updateStats();
        showToast('Feature diperbarui');
        closeModal('edit-modal');
      } catch(e) { showToast(e.message, 'error'); }
    });

    document.getElementById('btn-delete-feature').addEventListener('click', async () => {
      if (!confirm('Hapus feature ini?')) return;
      try {
        const res = await fetch(`${API}/${editingId}`, { method: 'DELETE' });
        const j   = await res.json();
        if (!j.success) throw new Error(j.message);
        map.removeLayer(features[editingId].layer);
        delete features[editingId];
        renderList(); updateStats();
        showToast('Feature dihapus');
        closeModal('edit-modal');
      } catch(e) { showToast(e.message, 'error'); }
    });

    // ── Load features from API ─────────────────────────────────────
    async function loadFeatures() {
      try {
        const res = await fetch(API);
        const j   = await res.json();
        if (!j.success) return;
        j.data.forEach(addFeatureToMap);
      } catch(e) { showToast('Gagal memuat data', 'error'); }
    }

    // ── Init ───────────────────────────────────────────────────────
    loadFeatures();
    setTool('none');
  </script>

  <script>
    // Theme toggle functionality
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const htmlElement = document.documentElement;
    
    function initTheme() {
      const savedTheme = localStorage.getItem('theme');
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      const isDarkMode = savedTheme ? savedTheme === 'dark' : prefersDark;
      
      if (!isDarkMode) {
        htmlElement.classList.add('light-mode');
        themeIcon.textContent = '☀️';
      }
    }
    
    themeToggle.addEventListener('click', () => {
      const isLightMode = htmlElement.classList.toggle('light-mode');
      localStorage.setItem('theme', isLightMode ? 'light' : 'dark');
      themeIcon.textContent = isLightMode ? '☀️' : '🌙';
    });
    
    initTheme();
  </script>

</body>
</html>
