<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <title>Daftar KK Miskin — Latenia GIS</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #f0f4ff;
      min-height: 100vh;
    }

    /* ── Header ── */
    .app-header {
      background: linear-gradient(135deg, #7c3aed 0%, #4f8ef7 100%);
      color: #fff;
      padding: 16px 20px 20px;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 4px 20px rgba(124,58,237,.3);
    }
    .app-header h1 { font-size: 18px; font-weight: 700; }
    .app-header p  { font-size: 12px; opacity: .8; margin-top: 2px; }

    /* ── Content ── */
    .content { padding: 16px; max-width: 480px; margin: 0 auto; }

    /* ── GPS Card ── */
    .gps-card {
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 14px;
      box-shadow: 0 2px 12px rgba(0,0,0,.07);
    }
    .gps-card h2 { font-size: 14px; font-weight: 700; color: #1a1f3a; margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }

    /* ── GPS Status ── */
    .gps-status {
      background: #f8f9fc;
      border-radius: 12px;
      padding: 16px;
      text-align: center;
      border: 2px dashed #d0d7f5;
      margin-bottom: 12px;
      transition: all .3s;
    }
    .gps-status.searching { border-color: #f59e0b; background: #fffbeb; }
    .gps-status.found     { border-color: #10b981; background: #ecfdf5; }
    .gps-status.error     { border-color: #ef4444; background: #fef2f2; }
    .gps-icon { font-size: 36px; margin-bottom: 8px; }
    .gps-label { font-size: 13px; color: #6b7a99; font-weight: 600; }
    .gps-coords { font-size: 12px; color: #1a1f3a; margin-top: 6px; font-family: monospace; background: #e8ecf5; padding: 6px 10px; border-radius: 8px; display: inline-block; }
    .gps-accuracy { font-size: 11px; color: #10b981; margin-top: 4px; }

    /* ── Btn ── */
    .btn {
      display: block; width: 100%; padding: 14px;
      border: none; border-radius: 12px; font-size: 15px;
      font-weight: 700; cursor: pointer; transition: all .2s;
      text-align: center; letter-spacing: .2px;
    }
    .btn-gps   { background: linear-gradient(135deg, #7c3aed, #4f8ef7); color: #fff; margin-bottom: 8px; }
    .btn-gps:active   { transform: scale(.97); }
    .btn-gps:disabled { opacity: .5; cursor: not-allowed; }
    .btn-save  { background: linear-gradient(135deg, #10b981, #059669); color: #fff; }
    .btn-save:active  { transform: scale(.97); }
    .btn-save:disabled { opacity: .5; cursor: not-allowed; }
    .btn-secondary { background: #e8ecf5; color: #6b7a99; font-size: 13px; padding: 10px; }

    /* ── Map ── */
    #preview-map { height: 200px; border-radius: 12px; overflow: hidden; display: none; margin-bottom: 12px; border: 2px solid #d0d7f5; }
    #preview-map.visible { display: block; }

    /* ── Form ── */
    .form-group { margin-bottom: 12px; }
    .form-label { font-size: 12px; font-weight: 700; color: #4f5b7a; margin-bottom: 6px; display: block; }
    .form-input, .form-textarea, .form-select {
      width: 100%; padding: 12px 14px;
      border: 2px solid #e0e5f2; border-radius: 10px;
      font-size: 14px; color: #1a1f3a; background: #fff;
      outline: none; transition: border-color .2s;
      font-family: inherit;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: #7c3aed; }
    .form-textarea { resize: vertical; min-height: 80px; }
    .coord-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .coord-input { background: #f0f4ff !important; font-family: monospace !important; font-size: 12px !important; }

    /* ── Badge ── */
    .badge { display: inline-block; padding: 3px 10px; border-radius: 99px; font-size: 11px; font-weight: 700; }
    .badge-green { background: #d1fae5; color: #065f46; }
    .badge-red   { background: #fee2e2; color: #991b1b; }

    /* ── Toast ── */
    .toast-container { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); z-index: 9999; display: flex; flex-direction: column; gap: 8px; width: calc(100% - 32px); max-width: 360px; }
    .toast { padding: 14px 18px; border-radius: 12px; font-size: 13px; font-weight: 600; box-shadow: 0 4px 20px rgba(0,0,0,.15); animation: slideUp .3s ease; }
    .toast.success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
    .toast.error   { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
    @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

    /* ── Success Screen ── */
    .success-screen { display: none; text-align: center; padding: 40px 20px; }
    .success-screen.visible { display: block; }
    .success-screen .icon { font-size: 72px; margin-bottom: 16px; }
    .success-screen h2 { font-size: 20px; font-weight: 800; color: #1a1f3a; margin-bottom: 8px; }
    .success-screen p { font-size: 14px; color: #6b7a99; line-height: 1.6; margin-bottom: 24px; }
    .coverage-result { background: #fff; border-radius: 14px; padding: 16px; margin: 0 auto 24px; max-width: 280px; box-shadow: 0 2px 12px rgba(0,0,0,.07); }
    .coverage-result .label { font-size: 12px; color: #6b7a99; margin-bottom: 6px; }

    /* ── Divider ── */
    .divider { height: 1px; background: #e8ecf5; margin: 14px 0; }
    
    /* ── Pulse animation ── */
    @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.5; } }
    .pulse { animation: pulse 1.5s infinite; }

    /* ── Back link ── */
    .back-link { display: flex; align-items: center; gap: 6px; font-size: 13px; color: rgba(255,255,255,.8); text-decoration: none; margin-bottom: 8px; }
    .back-link:hover { color: #fff; }
  </style>
</head>
<body>

<div class="app-header">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'pemerintah'))
      <a href="{{ url('/povertymap') }}" class="back-link" style="margin-bottom: 0;">← Kembali ke Peta</a>
    @else
      <div></div>
    @endif
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
      @csrf
      <button type="submit" style="background: transparent; border: none; color: rgba(255,255,255,0.8); cursor: pointer; font-size: 13px; font-weight: 600; font-family: inherit; display: flex; align-items: center; gap: 4px;">
        🚪 Keluar
      </button>
    </form>
  </div>
  <h1>📋 Pendataan KK Miskin</h1>
  <p>Surveyor: <strong>{{ auth()->user()->name }}</strong></p>
</div>

<div class="content">

  <!-- Success Screen (hidden by default) -->
  <div class="success-screen" id="success-screen">
    <div class="icon">✅</div>
    <h2>Data Berhasil Disimpan!</h2>
    <p>Data kepala keluarga telah berhasil didaftarkan ke sistem Latenia GIS.</p>
    <div class="coverage-result">
      <div class="label">Status Jangkauan Bantuan</div>
      <div id="result-coverage-badge"></div>
    </div>
    <button class="btn btn-gps" onclick="resetForm()">➕ Daftar KK Lainnya</button>
    <button class="btn btn-secondary" style="margin-top:8px;" onclick="window.location='/povertymap'">🗺️ Lihat di Peta</button>
  </div>

  <!-- Registration Form -->
  <div id="form-area">

    <!-- Step 1: GPS -->
    <div class="gps-card">
      <h2>📍 Langkah 1 — Ambil Lokasi GPS</h2>

      <div class="gps-status" id="gps-status">
        <div class="gps-icon">📡</div>
        <div class="gps-label">Tekan tombol di bawah untuk mengambil lokasi GPS</div>
      </div>

      <div id="preview-map"></div>

      <button class="btn btn-gps" id="btn-gps" onclick="getGPS()">
        📍 Ambil Lokasi GPS Sekarang
      </button>
      <button class="btn btn-secondary" id="btn-retry" onclick="getGPS()" style="display:none;">
        🔄 Ambil Ulang Lokasi
      </button>
    </div>

    <!-- Step 2: Form Data -->
    <div class="gps-card">
      <h2>👤 Langkah 2 — Isi Data Kepala Keluarga</h2>

      <div class="form-group">
        <label class="form-label">Nama Kepala Keluarga *</label>
        <input class="form-input" id="f-name" placeholder="cth. Ahmad Fauzi" />
      </div>

      <div class="form-group">
        <label class="form-label">Alamat / Keterangan</label>
        <textarea class="form-textarea" id="f-desc" placeholder="cth. RT 03 RW 07, Jl. Imam Bonjol No. 12, Pontianak Selatan"></textarea>
      </div>

      <div class="divider"></div>

      <div class="form-group">
        <label class="form-label">📍 Koordinat GPS (otomatis dari lokasi)</label>
        <div class="coord-row">
          <div>
            <label class="form-label">Latitude</label>
            <input type="number" step="any" class="form-input coord-input" id="f-lat" placeholder="-0.0432..." readonly />
          </div>
          <div>
            <label class="form-label">Longitude</label>
            <input type="number" step="any" class="form-input coord-input" id="f-lng" placeholder="109.324..." readonly />
          </div>
        </div>
        <p style="font-size:11px;color:#6b7a99;margin-top:6px;">⚠️ Koordinat diambil otomatis dari GPS perangkat Anda</p>
      </div>

      <button class="btn btn-save" id="btn-save" onclick="saveData()" disabled>
        💾 Simpan Data KK
      </button>
    </div>

  </div><!-- /#form-area -->
</div>

<div class="toast-container" id="toast-container"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const HAPI = '/api/household';
let gpsLat = null, gpsLng = null, previewMap = null, previewMarker = null;

// ── Toast ──────────────────────────────────────────────────
function showToast(msg, type = 'success') {
  const tc = document.getElementById('toast-container');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.textContent = (type === 'success' ? '✅ ' : '❌ ') + msg;
  tc.appendChild(t);
  setTimeout(() => t.remove(), 3500);
}

// ── GPS ─────────────────────────────────────────────────────
function getGPS() {
  const statusEl = document.getElementById('gps-status');

  if (!navigator.geolocation) {
    statusEl.className = 'gps-status error';
    statusEl.innerHTML = `<div class="gps-icon">❌</div><div class="gps-label">Browser tidak mendukung Geolocation</div>`;
    showToast('Geolocation tidak tersedia', 'error');
    return;
  }

  document.getElementById('btn-gps').disabled = true;
  statusEl.className = 'gps-status searching';
  statusEl.innerHTML = `<div class="gps-icon pulse">🛰️</div><div class="gps-label">Mencari sinyal GPS...</div><div class="gps-accuracy">Mohon tunggu, jangan tutup aplikasi</div>`;

  navigator.geolocation.getCurrentPosition(
    (pos) => {
      gpsLat = pos.coords.latitude;
      gpsLng = pos.coords.longitude;
      const accuracy = pos.coords.accuracy.toFixed(1);

      statusEl.className = 'gps-status found';
      statusEl.innerHTML = `
        <div class="gps-icon">✅</div>
        <div class="gps-label">Lokasi berhasil ditemukan!</div>
        <div class="gps-coords">Lat: ${gpsLat.toFixed(7)}<br>Lng: ${gpsLng.toFixed(7)}</div>
        <div class="gps-accuracy">📏 Akurasi: ±${accuracy} meter</div>`;

      document.getElementById('f-lat').value = gpsLat.toFixed(7);
      document.getElementById('f-lng').value = gpsLng.toFixed(7);
      document.getElementById('btn-gps').style.display = 'none';
      document.getElementById('btn-retry').style.display = 'block';
      document.getElementById('btn-save').disabled = false;

      // Show mini map preview
      initPreviewMap(gpsLat, gpsLng);
    },
    (err) => {
      document.getElementById('btn-gps').disabled = false;
      statusEl.className = 'gps-status error';
      let msg = 'Gagal mengambil lokasi GPS';
      if (err.code === 1) msg = 'Izin lokasi ditolak. Aktifkan izin di pengaturan browser.';
      if (err.code === 2) msg = 'Sinyal GPS tidak tersedia. Coba di tempat terbuka.';
      if (err.code === 3) msg = 'Waktu GPS habis. Coba lagi.';
      statusEl.innerHTML = `<div class="gps-icon">❌</div><div class="gps-label">${msg}</div>`;
      showToast(msg, 'error');
    },
    { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
  );
}

// ── Preview Map ──────────────────────────────────────────────
function initPreviewMap(lat, lng) {
  const mapEl = document.getElementById('preview-map');
  mapEl.classList.add('visible');

  if (!previewMap) {
    previewMap = L.map('preview-map', { zoomControl: true, attributionControl: false }).setView([lat, lng], 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(previewMap);
    const icon = L.divIcon({
      html: `<div style="width:36px;height:36px;border-radius:50%;background:rgba(124,58,237,.9);border:3px solid #fff;display:flex;align-items:center;justify-content:center;font-size:18px;box-shadow:0 4px 14px rgba(124,58,237,.5);">📍</div>`,
      iconSize: [36, 36], iconAnchor: [18, 18], className: ''
    });
    previewMarker = L.marker([lat, lng], { icon }).addTo(previewMap);
  } else {
    previewMap.setView([lat, lng], 17);
    previewMarker.setLatLng([lat, lng]);
  }

  // Trigger map resize after CSS animation
  setTimeout(() => previewMap.invalidateSize(), 100);
}

// ── Save ─────────────────────────────────────────────────────
async function saveData() {
  const name = document.getElementById('f-name').value.trim();
  const desc = document.getElementById('f-desc').value.trim();

  if (!name) { showToast('Nama kepala keluarga wajib diisi', 'error'); return; }
  if (!gpsLat || !gpsLng) { showToast('Ambil lokasi GPS terlebih dahulu', 'error'); return; }

  const btn = document.getElementById('btn-save');
  btn.disabled = true;
  btn.textContent = '⏳ Menyimpan...';

  try {
    const res = await fetch(HAPI, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, description: desc, latitude: gpsLat, longitude: gpsLng })
    });
    const j = await res.json();
    if (!j.success) throw new Error(j.message || 'Gagal menyimpan');

    const isCovered = +j.data.is_covered === 1;
    document.getElementById('result-coverage-badge').innerHTML =
      isCovered
        ? '<span class="badge badge-green">✅ Tercover Bantuan</span>'
        : '<span class="badge badge-red">❌ Belum Tercover</span>';

    document.getElementById('form-area').style.display = 'none';
    document.getElementById('success-screen').classList.add('visible');

  } catch (e) {
    showToast(e.message, 'error');
    btn.disabled = false;
    btn.textContent = '💾 Simpan Data KK';
  }
}

// ── Reset ────────────────────────────────────────────────────
function resetForm() {
  gpsLat = null; gpsLng = null;
  document.getElementById('f-name').value = '';
  document.getElementById('f-desc').value = '';
  document.getElementById('f-lat').value = '';
  document.getElementById('f-lng').value = '';

  const statusEl = document.getElementById('gps-status');
  statusEl.className = 'gps-status';
  statusEl.innerHTML = `<div class="gps-icon">📡</div><div class="gps-label">Tekan tombol di bawah untuk mengambil lokasi GPS</div>`;

  document.getElementById('btn-gps').style.display = 'block';
  document.getElementById('btn-gps').disabled = false;
  document.getElementById('btn-retry').style.display = 'none';
  document.getElementById('btn-save').disabled = true;
  document.getElementById('preview-map').classList.remove('visible');

  document.getElementById('success-screen').classList.remove('visible');
  document.getElementById('form-area').style.display = '';
}
</script>
</body>
</html>
