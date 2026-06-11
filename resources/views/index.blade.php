<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Latenia — Geographic Information System</title>
  <meta name="description" content="Latenia GIS — platform peta interaktif untuk manajemen jalan, wilayah, SPBU, dan peta kemiskinan." />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <style>
    /* ── Landing-specific styles ───────────────────────── */
    .hero {
      min-height: 100vh;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 80px 24px 40px;
      text-align: center;
      position: relative; overflow: hidden;
    }

    /* animated grid bg */
    .hero::before {
      content: '';
      position: absolute; inset: 0;
      background-image:
        linear-gradient(rgba(79,142,247,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(79,142,247,.06) 1px, transparent 1px);
      background-size: 48px 48px;
      animation: gridScroll 20s linear infinite;
    }
    @keyframes gridScroll {
      from { background-position: 0 0; }
      to   { background-position: 0 48px; }
    }

    /* radial glow */
    .hero::after {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(ellipse 70% 60% at 50% 40%, rgba(79,142,247,.1) 0%, transparent 70%);
      pointer-events: none;
    }

    .hero-content { position: relative; z-index: 1; max-width: 700px; }

    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 6px 16px; border-radius: 99px;
      background: rgba(79,142,247,.12);
      border: 1px solid rgba(79,142,247,.3);
      font-size: 12px; font-weight: 600; color: var(--accent);
      text-transform: uppercase; letter-spacing: .08em;
      margin-bottom: 28px;
    }
    .hero-badge-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: var(--accent);
      animation: pulse 2s ease infinite;
    }
    @keyframes pulse {
      0%,100% { opacity: 1; transform: scale(1); }
      50%      { opacity: .5; transform: scale(1.5); }
    }

    .hero-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(42px, 6vw, 68px);
      font-weight: 800; line-height: 1.1;
      color: var(--text-primary);
      margin-bottom: 18px;
    }
    .hero-title span {
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }

    .hero-sub {
      font-size: 17px; color: var(--text-muted);
      line-height: 1.7; margin-bottom: 48px;
    }

    /* ── System Cards ─────────────────────────────── */
    .systems-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      max-width: 1080px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative; z-index: 1;
    }

    .sys-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius-xl);
      padding: 32px 28px 28px;
      cursor: pointer;
      text-decoration: none;
      transition: all .3s cubic-bezier(.4,0,.2,1);
      position: relative; overflow: hidden;
      display: block;
    }

    .sys-card::before {
      content: '';
      position: absolute; inset: 0;
      opacity: 0; transition: opacity .3s;
    }
    .sys-card:nth-child(1)::before { background: radial-gradient(circle at 30% 30%, rgba(79,142,247,.12), transparent 65%); }
    .sys-card:nth-child(2)::before { background: radial-gradient(circle at 30% 30%, rgba(245,158,11,.12), transparent 65%); }
    .sys-card:nth-child(3)::before { background: radial-gradient(circle at 30% 30%, rgba(239,68,68,.12), transparent 65%); }

    .sys-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 48px rgba(0,0,0,.4);
    }
    .sys-card:nth-child(1):hover { border-color: rgba(79,142,247,.4); }
    .sys-card:nth-child(2):hover { border-color: rgba(245,158,11,.4); }
    .sys-card:nth-child(3):hover { border-color: rgba(239,68,68,.4);  }
    .sys-card:hover::before { opacity: 1; }

    .sys-icon {
      width: 56px; height: 56px;
      border-radius: 16px;
      display: flex; align-items: center; justify-content: center;
      font-size: 26px;
      margin-bottom: 20px;
    }
    .sys-card:nth-child(1) .sys-icon { background: rgba(79,142,247,.15); }
    .sys-card:nth-child(2) .sys-icon { background: rgba(245,158,11,.15); }
    .sys-card:nth-child(3) .sys-icon { background: rgba(239,68,68,.15);  }

    .sys-num {
      font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: .1em;
      margin-bottom: 8px;
    }
    .sys-card:nth-child(1) .sys-num { color: var(--accent); }
    .sys-card:nth-child(2) .sys-num { color: var(--accent-fuel); }
    .sys-card:nth-child(3) .sys-num { color: var(--accent-poor); }

    .sys-name {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px; font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 10px;
    }
    .sys-desc {
      font-size: 13px; color: var(--text-muted);
      line-height: 1.65;
      margin-bottom: 20px;
    }

    .sys-tags { display: flex; flex-wrap: wrap; gap: 6px; }
    .sys-tag {
      padding: 3px 10px; border-radius: 99px;
      font-size: 11px; font-weight: 600;
      background: var(--bg-surface);
      border: 1px solid var(--border);
      color: var(--text-muted);
    }

    .sys-arrow {
      position: absolute; bottom: 24px; right: 24px;
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--bg-surface);
      border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; color: var(--text-muted);
      transition: var(--transition);
    }
    .sys-card:hover .sys-arrow {
      background: var(--accent); border-color: var(--accent); color: #fff;
      transform: rotate(45deg);
    }
    .sys-card:nth-child(2):hover .sys-arrow { background: var(--accent-fuel); border-color: var(--accent-fuel); }
    .sys-card:nth-child(3):hover .sys-arrow { background: var(--accent-poor); border-color: var(--accent-poor); }

    /* ── Footer ───────────────────────────────────── */
    .landing-footer {
      text-align: center;
      padding: 40px 24px;
      color: var(--text-dim);
      font-size: 12px;
    }

    @media (max-width: 900px) {
      .systems-grid { grid-template-columns: 1fr; }
    }
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
      <a href="{{ url('/geotrace') }}"   class="nav-link">GeoTrace Studio</a>
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

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-badge">
        <div class="hero-badge-dot"></div>
        Geographic Information System
      </div>
      <h1 class="hero-title">
        Petakan Dunia<br/>dengan <span>Latenia</span>
      </h1>
      <p class="hero-sub">
        Platform GIS modern untuk analisis spasial, manajemen infrastruktur,
        dan visualisasi data sosial — semua dalam satu ekosistem interaktif.
      </p>
    </div>
  </section>

  <!-- System Cards -->
  <div class="systems-grid">

    <!-- 1. GeoTrace Studio -->
    <a href="{{ url('/geotrace') }}" class="sys-card">
      <div class="sys-icon">🗺️</div>
      <div class="sys-num">Sistem 01</div>
      <div class="sys-name">GeoTrace Studio</div>
      <p class="sys-desc">
        Gambar polyline untuk jalan dan polygon tertutup untuk batas wilayah langsung di atas peta interaktif.
        Simpan, edit, dan kelola semua layer spasial.
      </p>
      <div class="sys-tags">
        <span class="sys-tag">Polyline</span>
        <span class="sys-tag">Polygon</span>
        <span class="sys-tag">Layer Management</span>
      </div>
      <div class="sys-arrow">↗</div>
    </a>

    <!-- 2. FuelPoint Manager -->
    <a href="{{ url('/fuelpoint') }}" class="sys-card">
      <div class="sys-icon">⛽</div>
      <div class="sys-num">Sistem 02</div>
      <div class="sys-name">FuelPoint Manager</div>
      <p class="sys-desc">
        Flag dan kelola lokasi SPBU di peta. Catat nama, deskripsi, koordinat,
        dan status operasional 24 jam langsung ke database.
      </p>
      <div class="sys-tags">
        <span class="sys-tag">SPBU Mapping</span>
        <span class="sys-tag">24 Jam Status</span>
        <span class="sys-tag">Geo Database</span>
      </div>
      <div class="sys-arrow">↗</div>
    </a>

    <!-- 3. Poverty Map -->
    <a href="{{ url('/povertymap') }}" class="sys-card">
      <div class="sys-icon">🏠</div>
      <div class="sys-num">Sistem 03</div>
      <div class="sys-name">Poverty Map</div>
      <p class="sys-desc">
        Flag tempat ibadah dengan radius jangkauan dan kepala keluarga miskin.
        Sistem otomatis mendeteksi coverage dan menandai keluarga yang terbantu.
      </p>
      <div class="sys-tags">
        <span class="sys-tag">Tempat Ibadah</span>
        <span class="sys-tag">Radius Coverage</span>
        <span class="sys-tag">Poverty Analysis</span>
      </div>
      <div class="sys-arrow">↗</div>
    </a>

  </div>

  <footer class="landing-footer">
    <p>Latenia GIS &copy; 2025 – Built with Leaflet.js &amp; PHP/MySQL</p>
  </footer>

  <script>
    // Theme toggle functionality
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const htmlElement = document.documentElement;
    
    // Initialize theme from localStorage or system preference
    function initTheme() {
      const savedTheme = localStorage.getItem('theme');
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      const isDarkMode = savedTheme ? savedTheme === 'dark' : prefersDark;
      
      if (!isDarkMode) {
        htmlElement.classList.add('light-mode');
        themeIcon.textContent = '☀️';
      }
    }
    
    // Toggle theme
    themeToggle.addEventListener('click', () => {
      const isLightMode = htmlElement.classList.toggle('light-mode');
      localStorage.setItem('theme', isLightMode ? 'light' : 'dark');
      themeIcon.textContent = isLightMode ? '☀️' : '🌙';
    });
    
    // Initialize on page load
    initTheme();
  </script>

</body>
</html>
