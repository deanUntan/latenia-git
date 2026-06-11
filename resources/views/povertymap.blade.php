<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Poverty Map — Latenia GIS</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <style>
    .legend{display:flex;flex-direction:column;gap:6px;}
    .legend-row{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-muted);}
    .legend-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0;}
    .tab-group{display:flex;gap:4px;background:var(--bg-surface);border-radius:var(--radius-sm);padding:4px;}
    .tab-btn{flex:1;padding:7px 8px;border:none;border-radius:6px;font-size:12px;font-weight:600;cursor:pointer;background:transparent;color:var(--text-muted);font-family:inherit;transition:var(--transition);}
    .tab-btn.active{background:var(--bg-card2);color:var(--text-primary);}
    .mode-banner{position:absolute;top:14px;right:14px;z-index:800;background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.35);border-radius:var(--radius-sm);padding:8px 16px;font-size:12px;font-weight:600;color:#ef4444;display:none;align-items:center;gap:8px;}
    .mode-banner.visible{display:flex;}
    .hh-covered{filter:drop-shadow(0 0 6px #10b981);}
    .hh-uncovered{filter:drop-shadow(0 0 4px #ef4444);}
  </style>
</head>
<body>
<nav class="nav">
  <a href="{{ url('/') }}" class="nav-brand">
    <div class="nav-logo">🌐</div>
    <div class="nav-title">Latenia <span>GIS</span></div>
  </a>
  <div class="nav-links">
    <a href="{{ url('/geotrace') }}" class="nav-link">GeoTrace Studio</a>
    <a href="{{ url('/fuelpoint') }}" class="nav-link">FuelPoint Manager</a>
    <a href="{{ url('/povertymap') }}" class="nav-link active">Poverty Map</a>
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

<aside class="panel">
  <div class="panel-header">
    <div class="panel-title">🏠 Poverty Map</div>
    <div class="panel-subtitle">Analisis coverage bantuan sosial</div>
  </div>
  <div class="panel-body">

    <div class="stat-row">
      <div class="stat-box"><div class="stat-val" id="cnt-worship" style="color:var(--accent)">0</div><div class="stat-lbl">Ibadah</div></div>
      <div class="stat-box"><div class="stat-val" id="cnt-hh" style="color:var(--accent-poor)">0</div><div class="stat-lbl">KK Miskin</div></div>
      <div class="stat-box"><div class="stat-val" id="cnt-covered" style="color:var(--accent-3)">0</div><div class="stat-lbl">Tercover</div></div>
    </div>

    <div class="legend" style="user-select: none;">
      <label class="legend-row" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
        <input type="checkbox" id="toggle-worship-layer" checked style="cursor: pointer; width: 14px; height: 14px; accent-color: #7c3aed; margin: 0;"/>
        <div class="legend-dot" style="background:#7c3aed;"></div>
        <span>Tempat Ibadah + Radius</span>
      </label>
      <label class="legend-row" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
        <input type="checkbox" id="toggle-hh-covered-layer" checked style="cursor: pointer; width: 14px; height: 14px; accent-color: #10b981; margin: 0;"/>
        <div class="legend-dot" style="background:#10b981;"></div>
        <span>KK Miskin - Tercover ✓</span>
      </label>
      <label class="legend-row" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
        <input type="checkbox" id="toggle-hh-uncovered-layer" checked style="cursor: pointer; width: 14px; height: 14px; accent-color: #ef4444; margin: 0;"/>
        <div class="legend-dot" style="background:#ef4444;"></div>
        <span>KK Miskin - Belum Tercover ✗</span>
      </label>
    </div>

    <div class="divider"></div>

    <div class="tab-group">
      <button class="tab-btn active" id="tab-worship" onclick="switchTab('worship')">🙏 Tempat Ibadah</button>
      <button class="tab-btn" id="tab-hh" onclick="switchTab('hh')">👨‍👩‍👧‍👦 Kepala Keluarga</button>
    </div>

    <div id="panel-worship">
      <button class="btn btn-primary w-full" id="btn-add-worship">🙏 Tambah (Klik Peta)</button>
      <button class="btn btn-secondary w-full hidden" id="btn-cancel-worship">✕ Batalkan</button>
      <div class="section-label" style="margin-top:8px;">Daftar Tempat Ibadah</div>
      <div id="worship-list" style="display:flex;flex-direction:column;gap:6px;"></div>
    </div>

    <div id="panel-hh" class="hidden">
      <button class="btn btn-primary w-full" id="btn-add-hh">👨‍👩‍👧‍👦 Tambah KK Miskin</button>
      <button class="btn btn-secondary w-full hidden" id="btn-cancel-hh">✕ Batalkan</button>
      <a href="{{ url('/register-kk') }}" target="_blank"
         style="display:block;width:100%;padding:10px;margin-top:6px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;border-radius:10px;text-align:center;font-size:13px;font-weight:700;text-decoration:none;box-shadow:0 4px 12px rgba(16,185,129,.3);">
        📱 Daftar via GPS (Mobile)
      </a>
      <div class="section-label" style="margin-top:8px;">Daftar Kepala Keluarga</div>
      <div id="hh-list" style="display:flex;flex-direction:column;gap:6px;"></div>
    </div>

  </div>
</aside>

<div class="map-wrap">
  <div class="mode-banner" id="mode-banner">📍 Mode Penempatan Aktif - Klik peta</div>
  <div id="map"></div>
</div>

<!-- Worship Modal -->
<div class="modal-overlay" id="worship-modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="wm-title">Tambah Tempat Ibadah</div>
      <button class="modal-close" onclick="closeModal('worship-modal')">✕</button>
    </div>
    <div style="display:flex;flex-direction:column;gap:12px;">
      <div class="form-group"><label class="form-label">Nama *</label><input class="form-input" id="wm-name" placeholder="e.g. Masjid Al-Ikhlas"/></div>
      <div class="form-group">
        <label class="form-label">Tipe</label>
        <select class="form-select" id="wm-type">
          <option>Masjid</option><option>Gereja</option><option>Pura</option>
          <option>Vihara</option><option>Kelenteng</option><option>Lainnya</option>
        </select>
      </div>
      <div class="form-group"><label class="form-label">Deskripsi</label><textarea class="form-textarea" id="wm-desc" rows="2"></textarea></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        <div class="form-group"><label class="form-label">Latitude</label><input type="number" step="any" class="form-input" id="wm-lat"/></div>
        <div class="form-group"><label class="form-label">Longitude</label><input type="number" step="any" class="form-input" id="wm-lng"/></div>
      </div>
      <div class="form-group">
        <label class="form-label">Radius (meter)</label>
        <input type="number" min="50" max="5000" class="form-input" id="wm-radius" value="500"/>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-danger btn-sm hidden" id="btn-del-worship">🗑️ Hapus</button>
      <button class="btn btn-secondary" onclick="closeModal('worship-modal')">Batal</button>
      <button class="btn btn-primary" id="btn-save-worship">💾 Simpan</button>
    </div>
  </div>
</div>

<!-- HH Modal -->
<div class="modal-overlay" id="hh-modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="hm-title">Tambah Kepala Keluarga</div>
      <button class="modal-close" onclick="closeModal('hh-modal')">✕</button>
    </div>
    <div style="display:flex;flex-direction:column;gap:12px;">
      <div class="form-group"><label class="form-label">Nama KK *</label><input class="form-input" id="hm-name" placeholder="e.g. Budi Santoso"/></div>
      <div class="form-group"><label class="form-label">Keterangan</label><textarea class="form-textarea" id="hm-desc" rows="2"></textarea></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
        <div class="form-group"><label class="form-label">Latitude</label><input type="number" step="any" class="form-input" id="hm-lat"/></div>
        <div class="form-group"><label class="form-label">Longitude</label><input type="number" step="any" class="form-input" id="hm-lng"/></div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-danger btn-sm hidden" id="btn-del-hh">🗑️ Hapus</button>
      <button class="btn btn-secondary" onclick="closeModal('hh-modal')">Batal</button>
      <button class="btn btn-primary" id="btn-save-hh">💾 Simpan</button>
    </div>
  </div>
</div>

<div class="toast-container" id="toast-container"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const WAPI = '/api/worship';
const HAPI = '/api/household';

const map = L.map('map', { zoomControl: false }).setView([-0.02, 109.34], 13);
L.control.zoom({position:'bottomright'}).addTo(map);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
  attribution:'© OpenStreetMap contributors',maxZoom:19
}).addTo(map);

let placingMode=null, worships={}, households={}, editWId=null, editHId=null;
let activeTab='worship';

function showToast(msg,type='success'){
  const tc=document.getElementById('toast-container');
  const t=document.createElement('div');
  t.className=`toast ${type}`;
  t.innerHTML=(type==='success'?'✅':'❌')+' '+msg;
  tc.appendChild(t);setTimeout(()=>t.remove(),3200);
}
function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}

function switchTab(tab){
  activeTab=tab;
  document.getElementById('panel-worship').classList.toggle('hidden',tab!=='worship');
  document.getElementById('panel-hh').classList.toggle('hidden',tab!=='hh');
  document.getElementById('tab-worship').classList.toggle('active',tab==='worship');
  document.getElementById('tab-hh').classList.toggle('active',tab==='hh');
}

function setPlacing(mode){
  placingMode=mode;
  const banner=document.getElementById('mode-banner');
  if(mode){
    map.getContainer().style.cursor='crosshair';
    banner.classList.add('visible');
    banner.textContent=(mode==='worship'?'🙏':'👨‍👩‍👧‍👦')+' Klik peta untuk menempatkan marker';
    document.getElementById(`btn-add-${mode}`).classList.add('hidden');
    document.getElementById(`btn-cancel-${mode}`).classList.remove('hidden');
  } else {
    map.getContainer().style.cursor='';
    banner.classList.remove('visible');
    ['worship','hh'].forEach(m=>{
      document.getElementById(`btn-add-${m}`).classList.remove('hidden');
      document.getElementById(`btn-cancel-${m}`).classList.add('hidden');
    });
  }
}

document.getElementById('btn-add-worship').onclick=()=>setPlacing('worship');
document.getElementById('btn-cancel-worship').onclick=()=>setPlacing(null);
document.getElementById('btn-add-hh').onclick=()=>setPlacing('hh');
document.getElementById('btn-cancel-hh').onclick=()=>setPlacing(null);

map.on('click',e=>{
  if(!placingMode) return;
  const mode=placingMode; setPlacing(null);
  if(mode==='worship'){
    editWId=null;
    document.getElementById('wm-title').textContent='🙏 Tambah Tempat Ibadah';
    document.getElementById('wm-name').value='';
    document.getElementById('wm-desc').value='';
    document.getElementById('wm-lat').value=e.latlng.lat.toFixed(7);
    document.getElementById('wm-lng').value=e.latlng.lng.toFixed(7);
    document.getElementById('wm-radius').value=500;
    document.getElementById('wm-type').value='Masjid';
    document.getElementById('btn-del-worship').classList.add('hidden');
    openModal('worship-modal');
  } else {
    editHId=null;
    document.getElementById('hm-title').textContent='👨‍👩‍👧‍👦 Tambah Kepala Keluarga';
    document.getElementById('hm-name').value='';
    document.getElementById('hm-desc').value='';
    document.getElementById('hm-lat').value=e.latlng.lat.toFixed(7);
    document.getElementById('hm-lng').value=e.latlng.lng.toFixed(7);
    document.getElementById('btn-del-hh').classList.add('hidden');
    openModal('hh-modal');
  }
});

// ── Worship icons ─────────────────────────────────────────────
const typeEmoji={Masjid:'🕌',Gereja:'⛪',Pura:'🛕',Vihara:'🧘',Kelenteng:'⛩️',Lainnya:'🏛️'};

function makeWorshipIcon(type){
  return L.divIcon({
    html:`<div style="width:36px;height:36px;border-radius:50%;background:rgba(124,58,237,.9);border:2px solid #7c3aed;display:flex;align-items:center;justify-content:center;font-size:18px;box-shadow:0 4px 14px rgba(0,0,0,.5);">${typeEmoji[type]||'🛕'}</div>`,
    iconSize:[36,36],iconAnchor:[18,18],popupAnchor:[0,-20],className:''
  });
}

function makeHHIcon(covered){
  const color=covered?'#10b981':'#ef4444';
  return L.divIcon({
    html:`<div style="width:30px;height:30px;border-radius:50%;background:${color}22;border:2px solid ${color};display:flex;align-items:center;justify-content:center;font-size:15px;box-shadow:0 0 8px ${color}88;">👨‍👩‍👧‍👦</div>`,
    iconSize:[30,30],iconAnchor:[15,15],popupAnchor:[0,-18],className:''
  });
}

// ── Visibility Toggles ────────────────────────────────────────
function applyLayersVisibility(){
  const showWorship = document.getElementById('toggle-worship-layer').checked;
  const showHHCovered = document.getElementById('toggle-hh-covered-layer').checked;
  const showHHUncovered = document.getElementById('toggle-hh-uncovered-layer').checked;
  
  Object.values(worships).forEach(w => {
    if (showWorship) {
      if (!map.hasLayer(w.marker)) w.marker.addTo(map);
      if (!map.hasLayer(w.circle)) w.circle.addTo(map);
    } else {
      if (map.hasLayer(w.marker)) map.removeLayer(w.marker);
      if (map.hasLayer(w.circle)) map.removeLayer(w.circle);
    }
  });
  
  Object.values(households).forEach(h => {
    const covered = +h.data.is_covered === 1;
    const shouldShow = covered ? showHHCovered : showHHUncovered;
    if (shouldShow) {
      if (!map.hasLayer(h.marker)) h.marker.addTo(map);
    } else {
      if (map.hasLayer(h.marker)) map.removeLayer(h.marker);
    }
  });
}

document.getElementById('toggle-worship-layer').addEventListener('change', applyLayersVisibility);
document.getElementById('toggle-hh-covered-layer').addEventListener('change', applyLayersVisibility);
document.getElementById('toggle-hh-uncovered-layer').addEventListener('change', applyLayersVisibility);

// ── Add worship to map ────────────────────────────────────────
function addWorship(data){
  const lat=+data.latitude, lng=+data.longitude, r=+data.radius;
  const circle=L.circle([lat,lng],{radius:r,color:'#7c3aed',fillColor:'#7c3aed',fillOpacity:.08,weight:2,dashArray:'6 4'}).addTo(map);
  const marker=L.marker([lat,lng],{icon:makeWorshipIcon(data.type)}).addTo(map);
  marker.bindPopup(`
    <div style="min-width:160px;">
      <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:14px;">${typeEmoji[data.type]||'🛕'} ${data.name}</div>
      <div style="font-size:11px;color:#6b7a99;margin:4px 0;">${data.type} · Radius <b style="color:#7c3aed;">${r}m</b></div>
      <div style="font-size:11px;color:#6b7a99;margin-bottom:10px;">${data.description||''}</div>
      <button onclick="openEditWorship(${data.id})"
        style="width:100%;padding:6px;border-radius:6px;border:1px solid rgba(124,58,237,.3);background:rgba(124,58,237,.1);color:#7c3aed;font-size:12px;cursor:pointer;font-weight:600;">
        ✏️ Edit
      </button>
    </div>`);
  worships[data.id]={data,marker,circle};
  applyLayersVisibility();
  renderWorshipList();
  updateStats();
}

// ── Add household to map ──────────────────────────────────────
function addHousehold(data){
  const covered=+data.is_covered===1;
  const marker=L.marker([+data.latitude,+data.longitude],{icon:makeHHIcon(covered)}).addTo(map);
  marker.bindPopup(`
    <div style="min-width:160px;">
      <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:14px;">👨‍👩‍👧‍👦 ${data.name}</div>
      <span class="badge ${covered?'badge-green':'badge-red'}">${covered?'✅ Tercover':'❌ Belum Tercover'}</span>
      <div style="font-size:11px;color:#6b7a99;margin:8px 0;">${data.description||''}</div>
      <button onclick="openEditHH(${data.id})"
        style="width:100%;padding:6px;border-radius:6px;border:1px solid rgba(239,68,68,.3);background:rgba(239,68,68,.1);color:#ef4444;font-size:12px;cursor:pointer;font-weight:600;">
        ✏️ Edit
      </button>
    </div>`);
  households[data.id]={data,marker};
  applyLayersVisibility();
  renderHHList();
  updateStats();
}

function updateStats(){
  const wa=Object.values(worships), ha=Object.values(households);
  document.getElementById('cnt-worship').textContent=wa.length;
  document.getElementById('cnt-hh').textContent=ha.length;
  document.getElementById('cnt-covered').textContent=ha.filter(h=>+h.data.is_covered===1).length;
}

function renderWorshipList(){
  const list=document.getElementById('worship-list');
  const all=Object.values(worships);
  if(!all.length){list.innerHTML=`<div style="text-align:center;padding:20px 0;color:var(--text-dim);font-size:12px;">Belum ada tempat ibadah.</div>`;return;}
  list.innerHTML=all.map(w=>`
    <div class="list-item" onclick="flyToWorship(${w.data.id})">
      <div class="list-item-icon" style="background:rgba(124,58,237,.15);">${typeEmoji[w.data.type]||'🛕'}</div>
      <div class="list-item-info">
        <div class="list-item-name">${w.data.name}</div>
        <div class="list-item-meta">${w.data.type} · ${w.data.radius}m</div>
      </div>
      <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation();openEditWorship(${w.data.id})">✏️</button>
    </div>`).join('');
}

function renderHHList(){
  const list=document.getElementById('hh-list');
  const all=Object.values(households);
  if(!all.length){list.innerHTML=`<div style="text-align:center;padding:20px 0;color:var(--text-dim);font-size:12px;">Belum ada data KK miskin.</div>`;return;}
  list.innerHTML=all.map(h=>{
    const cov=+h.data.is_covered===1;
    return `<div class="list-item" onclick="flyToHH(${h.data.id})">
      <div class="list-item-icon" style="background:${cov?'rgba(16,185,129,.15)':'rgba(239,68,68,.15)'};">👨‍👩‍👧‍👦</div>
      <div class="list-item-info">
        <div class="list-item-name">${h.data.name}</div>
        <div class="list-item-meta"><span class="badge ${cov?'badge-green':'badge-red'}" style="font-size:9px;">${cov?'Tercover':'Belum Tercover'}</span></div>
      </div>
      <button class="btn btn-secondary btn-sm" onclick="event.stopPropagation();openEditHH(${h.data.id})">✏️</button>
    </div>`;
  }).join('');
}

window.flyToWorship=id=>{const w=worships[id];if(!w)return;map.setView([+w.data.latitude,+w.data.longitude],16);w.marker.openPopup();};
window.flyToHH=id=>{const h=households[id];if(!h)return;map.setView([+h.data.latitude,+h.data.longitude],17);h.marker.openPopup();};

// ── Edit worship ──────────────────────────────────────────────
window.openEditWorship=id=>{
  editWId=id; const w=worships[id];
  document.getElementById('wm-title').textContent='✏️ Edit Tempat Ibadah';
  document.getElementById('wm-name').value=w.data.name;
  document.getElementById('wm-desc').value=w.data.description||'';
  document.getElementById('wm-lat').value=w.data.latitude;
  document.getElementById('wm-lng').value=w.data.longitude;
  document.getElementById('wm-radius').value=w.data.radius;
  document.getElementById('wm-type').value=w.data.type;
  document.getElementById('btn-del-worship').classList.remove('hidden');
  openModal('worship-modal');
};

document.getElementById('btn-save-worship').onclick=async()=>{
  const name=document.getElementById('wm-name').value.trim();
  const lat=parseFloat(document.getElementById('wm-lat').value);
  const lng=parseFloat(document.getElementById('wm-lng').value);
  const radius=parseFloat(document.getElementById('wm-radius').value);
  if(!name||isNaN(lat)||isNaN(lng)){showToast('Isi semua field wajib','error');return;}
  const payload={name,type:document.getElementById('wm-type').value,description:document.getElementById('wm-desc').value,latitude:lat,longitude:lng,radius};
  try{
    let res,j;
    if(editWId){
      res=await fetch(`${WAPI}/${editWId}`,{method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
      j=await res.json(); if(!j.success)throw new Error(j.message);
      const w=worships[editWId];
      Object.assign(w.data,payload);
      w.marker.setLatLng([lat,lng]); w.marker.setIcon(makeWorshipIcon(payload.type));
      w.circle.setLatLng([lat,lng]); w.circle.setRadius(radius);
      showToast('Tempat ibadah diperbarui');
    } else {
      res=await fetch(WAPI,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
      j=await res.json(); if(!j.success)throw new Error(j.message);
      addWorship(j.data); showToast('Tempat ibadah ditambahkan');
    }
    await reloadHouseholds();
    renderWorshipList(); updateStats(); closeModal('worship-modal');
  }catch(e){showToast(e.message,'error');}
};

document.getElementById('btn-del-worship').onclick=async()=>{
  if(!confirm('Hapus tempat ibadah ini?'))return;
  try{
    const res=await fetch(`${WAPI}/${editWId}`,{method:'DELETE'});
    const j=await res.json(); if(!j.success)throw new Error(j.message);
    map.removeLayer(worships[editWId].marker);
    map.removeLayer(worships[editWId].circle);
    delete worships[editWId];
    await reloadHouseholds();
    renderWorshipList(); updateStats(); showToast('Dihapus'); closeModal('worship-modal');
  }catch(e){showToast(e.message,'error');}
};

// ── Edit household ────────────────────────────────────────────
window.openEditHH=id=>{
  editHId=id; const h=households[id];
  document.getElementById('hm-title').textContent='✏️ Edit Kepala Keluarga';
  document.getElementById('hm-name').value=h.data.name;
  document.getElementById('hm-desc').value=h.data.description||'';
  document.getElementById('hm-lat').value=h.data.latitude;
  document.getElementById('hm-lng').value=h.data.longitude;
  document.getElementById('btn-del-hh').classList.remove('hidden');
  openModal('hh-modal');
};

document.getElementById('btn-save-hh').onclick=async()=>{
  const name=document.getElementById('hm-name').value.trim();
  const lat=parseFloat(document.getElementById('hm-lat').value);
  const lng=parseFloat(document.getElementById('hm-lng').value);
  if(!name||isNaN(lat)||isNaN(lng)){showToast('Isi semua field wajib','error');return;}
  const payload={name,description:document.getElementById('hm-desc').value,latitude:lat,longitude:lng};
  try{
    let res,j;
    if(editHId){
      res=await fetch(`${HAPI}/${editHId}`,{method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
      j=await res.json(); if(!j.success)throw new Error(j.message);
      showToast('KK diperbarui');
    } else {
      res=await fetch(HAPI,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
      j=await res.json(); if(!j.success)throw new Error(j.message);
      addHousehold(j.data); showToast('KK ditambahkan');
    }
    await reloadHouseholds(); closeModal('hh-modal');
  }catch(e){showToast(e.message,'error');}
};

document.getElementById('btn-del-hh').onclick=async()=>{
  if(!confirm('Hapus data KK ini?'))return;
  try{
    const res=await fetch(`${HAPI}/${editHId}`,{method:'DELETE'});
    const j=await res.json(); if(!j.success)throw new Error(j.message);
    map.removeLayer(households[editHId].marker);
    delete households[editHId];
    renderHHList(); updateStats(); showToast('Dihapus'); closeModal('hh-modal');
  }catch(e){showToast(e.message,'error');}
};

// ── Reload households after coverage update ──────────────────
async function reloadHouseholds(){
  try{
    const res=await fetch(HAPI); const j=await res.json();
    if(!j.success)return;
    j.data.forEach(d=>{
      if(households[d.id]){
        const cov=+d.is_covered===1;
        households[d.id].data=d;
        households[d.id].marker.setIcon(makeHHIcon(cov));
      }
    });
    applyLayersVisibility();
    renderHHList(); updateStats();
  }catch(e){}
}

// ── Initial load ──────────────────────────────────────────────
async function loadAll(){
  try{
    const [rw,rh]=await Promise.all([fetch(WAPI),fetch(HAPI)]);
    const [jw,jh]=await Promise.all([rw.json(),rh.json()]);
    if(jw.success)jw.data.forEach(addWorship);
    if(jh.success)jh.data.forEach(addHousehold);
  }catch(e){showToast('Gagal memuat data','error');}
}
loadAll();
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
