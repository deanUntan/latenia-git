<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login — Latenia GIS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:    #7c3aed;
      --accent-2:  #4f8ef7;
      --accent-3:  #10b981;
      --danger:    #ef4444;
      --bg-base:   #0a0d14;
      --bg-card:   rgba(20, 25, 38, 0.85);
      --border:    rgba(255, 255, 255, 0.1);
      --text-primary: #f0f4ff;
      --text-muted:   #6b7a99;
      --input-bg:     rgba(255, 255, 255, 0.05);
      --input-text:   #f0f4ff;
    }

    /* ── Light Mode ── */
    :root.light-mode {
      --bg-base:   #f0f4ff;
      --bg-card:   rgba(255, 255, 255, 0.85);
      --border:    rgba(0, 0, 0, 0.08);
      --text-primary: #1a1f3a;
      --text-muted:   #4f5b7a;
      --input-bg:     rgba(0, 0, 0, 0.03);
      --input-text:   #1a1f3a;
    }

    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      background: var(--bg-base);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px 16px;
      overflow: hidden;
      position: relative;
      transition: background 0.3s ease;
    }

    /* ── Animated background ── */
    .bg-orbs {
      position: fixed; inset: 0; pointer-events: none; z-index: 0;
    }
    .orb {
      position: absolute; border-radius: 50%; filter: blur(80px); opacity: .18;
      animation: drift 12s ease-in-out infinite alternate;
      transition: opacity 0.3s ease;
    }
    .orb-1 { width: 500px; height: 500px; background: #7c3aed; top: -100px; left: -100px; animation-delay: 0s; }
    .orb-2 { width: 400px; height: 400px; background: #4f8ef7; bottom: -80px; right: -80px; animation-delay: -4s; }
    .orb-3 { width: 300px; height: 300px; background: #10b981; top: 50%; left: 50%; transform: translate(-50%,-50%); animation-delay: -8s; }
    @keyframes drift {
      from { transform: translate(0, 0) scale(1); }
      to   { transform: translate(30px, -30px) scale(1.1); }
    }

    :root.light-mode .orb {
      opacity: 0.10;
    }

    /* ── Theme Toggle ── */
    #theme-toggle {
      position: fixed; top: 20px; right: 20px; z-index: 10;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 50%; width: 44px; height: 44px;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      font-size: 18px; transition: all 0.2s ease;
      backdrop-filter: blur(8px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    #theme-toggle:hover {
      transform: scale(1.05);
    }
    :root.light-mode #theme-toggle {
      background: rgba(0, 0, 0, 0.05);
      border-color: rgba(0, 0, 0, 0.1);
      color: #1a1f3a;
    }

    /* ── Card ── */
    .card {
      position: relative; z-index: 1;
      width: 100%; max-width: 420px;
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 24px;
      padding: 44px 40px;
      backdrop-filter: blur(20px);
      box-shadow: 0 32px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(124,58,237,0.15);
      transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    :root.light-mode .card {
      box-shadow: 0 32px 80px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(124, 58, 237, 0.08);
    }

    /* ── Logo ── */
    .logo { text-align: center; margin-bottom: 32px; }
    .logo-icon {
      width: 68px; height: 68px; border-radius: 20px;
      background: linear-gradient(135deg, #7c3aed, #4f8ef7);
      display: flex; align-items: center; justify-content: center;
      font-size: 32px; margin: 0 auto 14px;
      box-shadow: 0 12px 40px rgba(124,58,237,.4);
    }
    .logo h1 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 24px; font-weight: 700; color: var(--text-primary);
      letter-spacing: -.3px;
      transition: color 0.3s ease;
    }
    .logo h1 span { color: var(--accent-2); }
    .logo p { font-size: 13px; color: var(--text-muted); margin-top: 4px; transition: color 0.3s ease; }

    /* ── Error alert ── */
    .alert-error {
      background: rgba(239,68,68,.12);
      border: 1px solid rgba(239,68,68,.3);
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 13px;
      color: #fca5a5;
      margin-bottom: 20px;
      display: flex; align-items: flex-start; gap: 8px;
    }
    :root.light-mode .alert-error {
      background: #fef2f2;
      border-color: rgba(239,68,68,0.2);
      color: #b91c1c;
    }

    /* ── Form ── */
    .form-group { margin-bottom: 18px; }
    .form-label {
      display: block; font-size: 11px; font-weight: 700;
      color: var(--text-muted); margin-bottom: 7px; letter-spacing: .5px; text-transform: uppercase;
      transition: color 0.3s ease;
    }
    .input-wrap { position: relative; }
    .input-icon {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      font-size: 17px; pointer-events: none;
    }
    .form-input {
      width: 100%; padding: 13px 14px 13px 44px;
      background: var(--input-bg);
      border: 1.5px solid var(--border);
      border-radius: 12px; color: var(--input-text); font-size: 14px;
      font-family: 'Inter', sans-serif;
      outline: none; transition: border-color .2s, background .2s, color 0.3s;
    }
    .form-input::placeholder { color: #a0afc0; opacity: 0.6; }
    :root.light-mode .form-input::placeholder { color: #a0afc0; }
    .form-input:focus {
      border-color: var(--accent);
      background: rgba(124,58,237,.08);
    }
    :root.light-mode .form-input:focus {
      background: rgba(124,58,237,.04);
    }
    .form-input.is-error { border-color: var(--danger); }

    /* ── Remember ── */
    .remember-row {
      display: flex; align-items: center; gap: 8px;
      margin-bottom: 24px;
    }
    .remember-row input[type=checkbox] {
      width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer;
    }
    .remember-row label { font-size: 13px; color: var(--text-muted); cursor: pointer; transition: color 0.3s ease; }

    /* ── Submit ── */
    .btn-submit {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      color: #fff; border: none; border-radius: 12px;
      font-size: 15px; font-weight: 700; cursor: pointer;
      font-family: 'Inter', sans-serif;
      box-shadow: 0 8px 30px rgba(124,58,237,.4);
      transition: transform .15s, box-shadow .15s;
      letter-spacing: .2px;
    }
    .btn-submit:hover  { transform: translateY(-1px); box-shadow: 0 12px 40px rgba(124,58,237,.5); }
    .btn-submit:active { transform: translateY(0); }

    @media (max-width: 440px) {
      .card { padding: 36px 24px; border-radius: 20px; }
    }
  </style>
</head>
<body>

<div class="bg-orbs">
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>
</div>

<button id="theme-toggle" title="Ubah Tema Mode Terang/Gelap">
  <span id="theme-icon">🌙</span>
</button>

<div class="card">
  <div class="logo">
    <div class="logo-icon">🌐</div>
    <h1>Latenia <span>GIS</span></h1>
    <p>Sistem Informasi Geospasial Kota Pontianak</p>
  </div>

  @if ($errors->any())
  <div class="alert-error">
    <span>⚠️</span>
    <span>{{ $errors->first() }}</span>
  </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label class="form-label">Email</label>
      <div class="input-wrap">
        <span class="input-icon">📧</span>
        <input type="email" name="email" id="email"
               class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
               placeholder="nama@latenia.gis"
               value="{{ old('email') }}" autocomplete="email" required/>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Password</label>
      <div class="input-wrap">
        <span class="input-icon">🔒</span>
        <input type="password" name="password" id="password"
               class="form-input" placeholder="••••••••"
               autocomplete="current-password" required/>
      </div>
    </div>

    <div class="remember-row">
      <input type="checkbox" name="remember" id="remember"/>
      <label for="remember">Ingat saya</label>
    </div>

    <button type="submit" class="btn-submit">🚀 Masuk ke Sistem</button>
  </form>
</div>

<script>
  const htmlElement = document.documentElement;
  const themeToggle = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');

  function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isDarkMode = savedTheme ? savedTheme === 'dark' : prefersDark;
    
    if (!isDarkMode) {
      htmlElement.classList.add('light-mode');
      themeIcon.textContent = '☀️';
    } else {
      htmlElement.classList.remove('light-mode');
      themeIcon.textContent = '🌙';
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
