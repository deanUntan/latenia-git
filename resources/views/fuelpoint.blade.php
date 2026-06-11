<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FuelPoint Manager – Latenia GIS</title>
  <meta name="description" content="Kelola dan flag lokasi SPBU di peta interaktif." />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    .spbu-marker {
      width: 36px; height: 36px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
      border: 3px solid;
      box-shadow: 0 4px 14px rgba(0,0,0,.5);
      background: var(--bg-card);
    }
    .spbu-marker.h24 { border-color: #10b981; }
    .spbu-marker.noth24 { border-color: #f59e0b; }

    .coord-display {
      background: var(--bg-surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      padding: 8px 12px;
      font-size: 12px; font-family: monospace;
      color: var(--text-muted);
      display: flex; gap: 6px; align-items: center;
      flex-wrap: wrap;
    }
    .coord-val { color: var(--accent); font-weight: 600; }

    .mode-banner {
      position: absolute; top: 14px; right: 14px; z-index: 800;
      background: rgba(245,158,11,.15);
      border: 1px solid rgba(245,158,11,.4);
      border-radius: var(--radius-sm);
      padding: 8px 16px;
      font-size: 12px; font-weight: 600; color: #f59e0b;
      display: none; align-items: center; gap: 8px;
    }
    .mode-banner.visible { display: flex; }
  </style>
</head>
<body>

  <nav class="nav">
    <a href="{{ url('/') }}" class="nav-brand">
      <div class="nav-logo">🌐</div>
      <div class="nav-title">Latenia <span>GIS</span></div>
    </a>
    <div class="nav-links">
      <a href="{{ url('/geotrace') }}"   class="nav-link">GeoTrace Studio</a>
      <a href="{{ url('/fuelpoint') }}"  class="nav-link active">FuelPoint Manager</a>
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

  <!-- Sidebar -->
  <aside class="panel" id="sidebar">
    <div class="panel-header">
      <div class="panel-title">⛽ FuelPoint Manager</div>
      <div class="panel-subtitle">Manajemen lokasi SPBU</div>
    </div>

    <div class="panel-body">

      <!-- Stats -->
      <div class="stat-row">
        <div class="stat-box">
          <div class="stat-val" id="count-total" style="color:var(--accent-fuel)">0</div>
          <div class="stat-lbl">Total SPBU</div>
        </div>
        <div class="stat-box">
          <div class="stat-val" id="count-24h" style="color:var(--accent-3)">0</div>
          <div class="stat-lbl">24 Jam</div>
        </div>
      </div>

      <button class="btn btn-primary w-full" id="btn-add-mode" style="margin-top:4px;">
        📍 Tambah SPBU (Klik Peta)
      </button>
      <button class="btn btn-secondary w-full hidden" id="btn-cancel-mode">
        ✕ Batalkan Mode Penempatan
      </button>

      <div class="divider"></div>
      <div class="section-label">Daftar SPBU</div>

      <div id="spbu-list" style="display:flex;flex-direction:column;gap:8px;"></div>
    </div>
  </aside>

  <!-- Map -->
  <div class="map-wrap">
    <div class="mode-banner" id="mode-banner">
      📍 Mode Penempatan Aktif – Klik peta untuk menempatkan SPBU baru
    </div>
    <div id="map"></div>
  </div>

  <!-- Add/Edit Modal -->
  <div class="modal-overlay" id="spbu-modal">
    <div class="modal">
      <div class="modal-header">
        <div class="modal-title" id="modal-title">Tambah SPBU</div>
        <button class="modal-close" id="close-spbu-modal">✕</button>
      </div>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <div class="form-group">
          <label class="form-label">Nama SPBU *</label>
          <input type="text" class="form-input" id="sp-name" placeholder="e.g. SPBU Pertamina Sudirman" />
        </div>
        <div class="form-group">
          <label class="form-label">Deskripsi</label>
          <textarea class="form-textarea" id="sp-desc" placeholder="Keterangan SPBU..."></textarea>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
          <div class="form-group">
            <label class="form-label">Latitude</label>
            <input type="number" step="any" class="form-input" id="sp-lat" placeholder="-6.2088" />
          </div>
          <div class="form-group">
            <label class="form-label">Longitude</label>
            <input type="number" step="any" class="form-input" id="sp-lng" placeholder="106.823" />
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Status Operasional</label>
          <div class="toggle-wrapper">
            <label class="toggle">
              <input type="checkbox" id="sp-24h" />
              <span class="toggle-slider"></span>
            </label>
            <span id="sp-24h-label" style="font-size:13px;color:var(--text-muted);">Tidak 24 Jam</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm hidden" id="btn-delete-spbu">🗑️ Hapus</button>
        <button class="btn btn-secondary" id="btn-cancel-spbu">Batal</button>
        <button class="btn btn-primary" id="btn-save-spbu">💾 Simpan</button>
      </div>
    </div>
  </div>

  <div class="toast-container" id="toast-container"></div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const API = '/api/fuelpoint';

    // -- Map --------------------------------------------------------
    const map = L.map('map', { zoomControl: false }).setView([-0.02, 109.34], 13);
    L.control.zoom({ position: 'bottomright' }).addTo(map);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);

    // -- State ------------------------------------------------------
    let placingMode = false;
    let stations    = {};   // id => { data, marker }
    let editingId   = null;

    // -- Helpers ----------------------------------------------------
    function showToast(msg, type = 'success') {
      const tc = document.getElementById('toast-container');
      const t  = document.createElement('div');
      t.className = `toast ${type}`;
      t.innerHTML = (type === 'success' ? '✅' : '❌') + ' ' + msg;
      tc.appendChild(t); setTimeout(() => t.remove(), 3200);
    }
    function openModal()  { document.getElementById('spbu-modal').classList.add('open'); }
    function closeModal() { document.getElementById('spbu-modal').classList.remove('open'); }

    function updateStats() {
      const all = Object.values(stations);
      document.getElementById('count-total').textContent = all.length;
      document.getElementById('count-24h').textContent   = all.filter(s => +s.data.is_24_hours).length;
    }

    // -- Toggle 24h label -------------------------------------------
    document.getElementById('sp-24h').addEventListener('change', e => {
      document.getElementById('sp-24h-label').textContent =
        e.target.checked ? '24 Jam' : 'Tidak 24 Jam';
    });

    // -- Placing mode -----------------------------------------------
    document.getElementById('btn-add-mode').addEventListener('click', () => {
      placingMode = true;
      map.getContainer().style.cursor = 'crosshair';
      document.getElementById('mode-banner').classList.add('visible');
      document.getElementById('btn-add-mode').classList.add('hidden');
      document.getElementById('btn-cancel-mode').classList.remove('hidden');
    });
    document.getElementById('btn-cancel-mode').addEventListener('click', cancelPlace);

    function cancelPlace() {
      placingMode = false;
      map.getContainer().style.cursor = '';
      document.getElementById('mode-banner').classList.remove('visible');
      document.getElementById('btn-add-mode').classList.remove('hidden');
      document.getElementById('btn-cancel-mode').classList.add('hidden');
    }

    map.on('click', e => {
      if (!placingMode) return;
      cancelPlace();
      editingId = null;
      document.getElementById('modal-title').textContent = '✏️ Tambah SPBU Baru';
      document.getElementById('sp-name').value = '';
      document.getElementById('sp-desc').value = '';
      document.getElementById('sp-lat').value  = e.latlng.lat.toFixed(7);
      document.getElementById('sp-lng').value  = e.latlng.lng.toFixed(7);
      document.getElementById('sp-24h').checked = false;
      document.getElementById('sp-24h-label').textContent = 'Tidak 24 Jam';
      document.getElementById('btn-delete-spbu').classList.add('hidden');
      openModal();
    });

    // -- Create icon ------------------------------------------------
    function makeIcon(is24) {
      return L.divIcon({
        html: `<div class="spbu-marker ${is24 ? 'h24' : 'noth24'}">⛽</div>`,
        iconSize: [36,36], iconAnchor: [18,18], popupAnchor: [0,-20],
        className: ''
      });
    }

    // -- Add station to map -----------------------------------------
    function addStation(data) {
      const is24 = +data.is_24_hours === 1;
      const marker = L.marker([+data.latitude, +data.longitude], { icon: makeIcon(is24) });

      marker.bindPopup(makePopupHtml(data));
      marker.on('click', () => marker.openPopup());
      marker.addTo(map);

      stations[data.id] = { data, marker };
      renderList();
      updateStats();
    }

    function makePopupHtml(data) {
      const is24 = +data.is_24_hours === 1;
      return `
        <div style="min-width:180px;">
          <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:15px;margin-bottom:4px;">
            ⛽ ${data.name}
          </div>
          <span class="badge ${is24 ? 'badge-green' : 'badge-yellow'}">
            ${is24 ? '24 Jam' : 'Tidak 24 Jam'}
          </span>
          <div style="font-size:11px;color:#6b7a99;margin:8px 0 4px;">
            ${data.description || 'Tidak ada deskripsi'}
          </div>
          <div style="font-size:10px;color:#3d4a66;font-family:monospace;margin-bottom:10px;">
            ${(+data.latitude).toFixed(6)}, ${(+data.longitude).toFixed(6)}
          </div>
          <button onclick="openEdit(${data.id})"
            style="width:100%;padding:7px;border-radius:6px;border:1px solid rgba(245,158,11,.3);
                   background:rgba(245,158,11,.1);color:#f59e0b;font-size:12px;cursor:pointer;font-weight:600;">
            ✏️ Edit SPBU
          </button>
        </div>`;
    }

    // -- Render list ------------------------------------------------
    function renderList() {
      const list = document.getElementById('spbu-list');
      const all  = Object.values(stations);
      if (!all.length) {
        list.innerHTML = `<div style="text-align:center;padding:24px 0;color:var(--text-dim);font-size:12px;">
          Belum ada SPBU. Klik tombol di atas untuk menambahkan.</div>`;
        return;
      }
      list.innerHTML = all.map(s => {
        const is24 = +s.data.is_24_hours === 1;
        return `
        <div class="list-item" onclick="flyTo(${s.data.id})">
          <div class="list-item-icon" style="background:${is24 ? 'rgba(16,185,129,.15)' : 'rgba(245,158,11,.15)'};">
            ⛽
          </div>
          <div class="list-item-info">
            <div class="list-item-name">${s.data.name}</div>
            <div class="list-item-meta">
              <span class="badge ${is24 ? 'badge-green' : 'badge-yellow'}" style="font-size:9px;">
                ${is24 ? '24 Jam' : 'Tidak 24 Jam'}
              </span>
            </div>
          </div>
          <div class="list-item-actions">
            <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation();openEdit(${s.data.id})">✏️</button>
          </div>
        </div>`;
      }).join('');
    }

    window.flyTo = (id) => {
      const s = stations[id]; if (!s) return;
      map.setView([+s.data.latitude, +s.data.longitude], 16);
      s.marker.openPopup();
    };

    // -- Edit -------------------------------------------------------
    window.openEdit = (id) => {
      editingId = id;
      const s = stations[id];
      document.getElementById('modal-title').textContent = '✏️ Edit SPBU';
      document.getElementById('sp-name').value  = s.data.name;
      document.getElementById('sp-desc').value  = s.data.description || '';
      document.getElementById('sp-lat').value   = s.data.latitude;
      document.getElementById('sp-lng').value   = s.data.longitude;
      document.getElementById('sp-24h').checked = +s.data.is_24_hours === 1;
      document.getElementById('sp-24h-label').textContent = +s.data.is_24_hours ? '24 Jam' : 'Tidak 24 Jam';
      document.getElementById('btn-delete-spbu').classList.remove('hidden');
      openModal();
    };

    // -- Modal buttons ----------------------------------------------
    document.getElementById('close-spbu-modal').addEventListener('click', closeModal);
    document.getElementById('btn-cancel-spbu').addEventListener('click', closeModal);

    document.getElementById('btn-save-spbu').addEventListener('click', async () => {
      const name = document.getElementById('sp-name').value.trim();
      const lat  = parseFloat(document.getElementById('sp-lat').value);
      const lng  = parseFloat(document.getElementById('sp-lng').value);
      if (!name)           { showToast('Nama wajib diisi', 'error'); return; }
      if (isNaN(lat)||isNaN(lng)) { showToast('Koordinat tidak valid', 'error'); return; }

      const payload = {
        name, description: document.getElementById('sp-desc').value,
        latitude: lat, longitude: lng,
        is_24_hours: document.getElementById('sp-24h').checked
      };

      try {
        let res, j;
        if (editingId) {
          res = await fetch(`${API}/${editingId}`, {
            method: 'PUT', headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          });
          j = await res.json();
          if (!j.success) throw new Error(j.message);
          const s = stations[editingId];
          Object.assign(s.data, payload);
          s.marker.setLatLng([lat, lng]);
          s.marker.setIcon(makeIcon(payload.is_24_hours));
          s.marker.setPopupContent(makePopupHtml(s.data));
          showToast('SPBU diperbarui');
        } else {
          res = await fetch(API, {
            method: 'POST', headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          });
          j = await res.json();
          if (!j.success) throw new Error(j.message);
          addStation(j.data);
          showToast('SPBU berhasil ditambahkan');
        }
        renderList(); updateStats();
        closeModal();
      } catch(e) { showToast(e.message, 'error'); }
    });

    document.getElementById('btn-delete-spbu').addEventListener('click', async () => {
      if (!confirm('Hapus SPBU ini?')) return;
      try {
        const res = await fetch(`${API}/${editingId}`, { method: 'DELETE' });
        const j   = await res.json();
        if (!j.success) throw new Error(j.message);
        map.removeLayer(stations[editingId].marker);
        delete stations[editingId];
        renderList(); updateStats();
        showToast('SPBU dihapus');
        closeModal();
      } catch(e) { showToast(e.message, 'error'); }
    });

    // -- Load -------------------------------------------------------
    async function loadStations() {
      try {
        const res = await fetch(API);
        const j   = await res.json();
        if (!j.success) return;
        j.data.forEach(addStation);
      } catch(e) { showToast('Gagal memuat data', 'error'); }
    }

    loadStations();
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
