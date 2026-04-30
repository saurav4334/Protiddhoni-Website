<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'VoiceReach — Voice Broadcasting Platform for Bangladesh')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      tailwind.config = { theme: { extend: {
        fontFamily: { sans: ['Plus Jakarta Sans','sans-serif'], mono: ['JetBrains Mono','monospace'] },
        colors: {
          paypal: { navy:'#003087', blue:'#0070BA', sky:'#009CDE', gold:'#FFC439', cream:'#FFF9E6' },
          ink: { 900:'#0a1f44', 700:'#2c2e2f', 500:'#687173', 300:'#c3cad9' },
          surface: { 0:'#ffffff', 50:'#f7f9fc', 100:'#eef3f9', 200:'#e1e8f0' }
        }
      }}}
    </script>
    <style>
      body { font-family:'Plus Jakarta Sans', sans-serif; background:#ffffff; color:#2c2e2f; }
      .hero-gradient { background: radial-gradient(1200px 600px at 10% -10%, rgba(0,156,222,.25), transparent 60%), radial-gradient(900px 500px at 90% 10%, rgba(255,196,57,.25), transparent 60%), linear-gradient(180deg, #ffffff 0%, #f7f9fc 100%); }
      .mesh-blue { background: linear-gradient(135deg, #003087 0%, #0070BA 55%, #009CDE 100%); }
      .btn-primary { background:#0070BA; color:#fff; padding:.85rem 1.6rem; border-radius:999px; font-weight:700; display:inline-flex; align-items:center; gap:.5rem; transition:.2s; box-shadow: 0 10px 24px -10px rgba(0,112,186,.6); }
      .btn-primary:hover { background:#003087; transform:translateY(-1px); }
      .btn-gold { background:#FFC439; color:#0a1f44; padding:.85rem 1.6rem; border-radius:999px; font-weight:700; display:inline-flex; align-items:center; gap:.5rem; transition:.2s; box-shadow: 0 10px 24px -10px rgba(255,196,57,.6); }
      .btn-gold:hover { background:#ffb300; transform:translateY(-1px); }
      .btn-outline { border:1.5px solid #003087; color:#003087; padding:.8rem 1.5rem; border-radius:999px; font-weight:700; display:inline-flex; align-items:center; gap:.5rem; transition:.2s; background:#fff; }
      .btn-outline:hover { background:#003087; color:#fff; }
      .card { background:#fff; border:1px solid #e1e8f0; border-radius:20px; transition:.25s; }
      .card:hover { border-color:#009CDE; box-shadow: 0 20px 50px -20px rgba(0,112,186,.2); transform:translateY(-2px); }
      .chip { display:inline-flex; align-items:center; gap:.4rem; padding:.3rem .8rem; border-radius:999px; background:#eef3f9; color:#003087; font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; }
      .chip-gold { background:#FFF9E6; color:#8b6b00; }
      .chip-sky { background:#E0F4FB; color:#0070BA; }
      .nav-link { color:#2c2e2f; font-size:.9rem; font-weight:600; padding:.4rem .8rem; border-radius:10px; transition:.2s; }
      .nav-link:hover { background:#eef3f9; color:#003087; }
      .nav-link.active { color:#0070BA; background:#eef3f9; }
      .text-gradient { background: linear-gradient(135deg, #003087 0%, #0070BA 50%, #009CDE 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
      .stat-big { font-size:3rem; font-weight:800; color:#003087; line-height:1; }
      .float-1 { animation: float 6s ease-in-out infinite; }
      .float-2 { animation: float 7s ease-in-out infinite 1s; }
      @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
      .glow-ring { box-shadow: 0 0 0 0 rgba(0,156,222,.6); animation: glow 2.5s infinite; }
      @keyframes glow { 0%{box-shadow:0 0 0 0 rgba(0,156,222,.5)} 70%{box-shadow:0 0 0 18px rgba(0,156,222,0)} 100%{box-shadow:0 0 0 0 rgba(0,156,222,0)} }
      .marquee { display:flex; gap:4rem; animation: scroll 30s linear infinite; }
      @keyframes scroll { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
      .feature-icon { width:48px; height:48px; border-radius:14px; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#eef3f9,#E0F4FB); color:#0070BA; }
      .dot-grid { background-image: radial-gradient(#c3cad9 1px, transparent 1px); background-size:20px 20px; }
      details > summary { list-style:none; cursor:pointer; }
      details > summary::-webkit-details-marker { display:none; }
      .ring-gold { box-shadow: 0 0 0 4px #FFF9E6, 0 0 0 5px #FFC439; }
    </style>
    @stack('styles')
</head>
<body class="antialiased">

<!-- NAV -->
<header class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-xl border-b border-surface-200">
  <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-3">
    <a href="{{ url('/') }}" class="flex items-center gap-2">
      <div class="w-9 h-9 rounded-xl mesh-blue flex items-center justify-center ring-gold">
        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a3 3 0 00-3 3v7a3 3 0 006 0V5a3 3 0 00-3-3zM5 10a1 1 0 112 0 5 5 0 0010 0 1 1 0 112 0 7 7 0 01-6 6.92V20h3a1 1 0 110 2H8a1 1 0 110-2h3v-3.08A7 7 0 015 10z"/></svg>
      </div>
      <div>
        <p class="font-extrabold text-paypal-navy leading-none text-lg">VoiceReach</p>
        <p class="text-[10px] text-ink-500 font-semibold">by Protiddhoni</p>
      </div>
    </a>
    <div class="hidden lg:flex items-center gap-1">
      <a href="{{ url('/voice-broadcast') }}" class="nav-link {{ request()->is('voice-broadcast') ? 'active' : '' }}">Broadcast</a>
      <a href="{{ url('/voice-otp') }}" class="nav-link {{ request()->is('voice-otp') ? 'active' : '' }}">Voice OTP</a>
      <a href="{{ url('/voice-survey') }}" class="nav-link {{ request()->is('voice-survey') ? 'active' : '' }}">Voice Survey</a>
      <a href="{{ url('/pricing') }}" class="nav-link {{ request()->is('pricing') ? 'active' : '' }}">Pricing</a>
      <a href="{{ url('/api-docs') }}" class="nav-link {{ request()->is('api-docs') ? 'active' : '' }}">API Docs</a>
      <a href="{{ url('/blog') }}" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">Blog</a>
      <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ url('/admin') }}" class="hidden md:inline-flex nav-link">Sign in</a>
      <a href="{{ url('/admin/register') }}" class="btn-primary !py-2 !px-4 !text-sm">Get Started →</a>
    </div>
  </nav>
</header>

@yield('content')

<!-- FOOTER -->
<footer class="bg-ink-900 text-white pt-16 pb-10">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 lg:grid-cols-5 gap-10">
    <div class="lg:col-span-2">
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        <div class="w-9 h-9 rounded-xl mesh-blue flex items-center justify-center ring-gold">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a3 3 0 00-3 3v7a3 3 0 006 0V5a3 3 0 00-3-3z"/></svg>
        </div>
        <p class="font-extrabold text-lg">VoiceReach</p>
      </a>
      <p class="mt-4 text-ink-300 text-sm max-w-xs">Voice broadcasting made effortless for modern Bangladeshi businesses. Reach thousands in seconds.</p>
      <div class="mt-6 flex gap-3">
        <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-paypal-gold hover:text-paypal-navy flex items-center justify-center">f</a>
        <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-paypal-gold hover:text-paypal-navy flex items-center justify-center">𝕏</a>
        <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-paypal-gold hover:text-paypal-navy flex items-center justify-center">in</a>
      </div>
    </div>
    <div>
      <p class="font-bold mb-4">Product</p>
      <ul class="space-y-2 text-sm text-ink-300">
        <li><a href="{{ url('/voice-broadcast') }}" class="hover:text-paypal-gold">Voice Broadcast</a></li>
        <li><a href="{{ url('/voice-otp') }}" class="hover:text-paypal-gold">Voice OTP</a></li>
        <li><a href="{{ url('/voice-survey') }}" class="hover:text-paypal-gold">Voice Survey</a></li>
        <li><a href="{{ url('/pricing') }}" class="hover:text-paypal-gold">Pricing</a></li>
        <li><a href="{{ url('/api-docs') }}" class="hover:text-paypal-gold">API Docs</a></li>
      </ul>
    </div>
    <div>
      <p class="font-bold mb-4">Company</p>
      <ul class="space-y-2 text-sm text-ink-300">
        <li><a href="{{ url('/about') }}" class="hover:text-paypal-gold">About</a></li>
        <li><a href="#" class="hover:text-paypal-gold">Careers</a></li>
        <li><a href="{{ url('/blog') }}" class="hover:text-paypal-gold">Blog</a></li>
        <li><a href="{{ url('/contact') }}" class="hover:text-paypal-gold">Contact</a></li>
      </ul>
    </div>
    <div>
      <p class="font-bold mb-4">Support</p>
      <ul class="space-y-2 text-sm text-ink-300">
        <li><a href="{{ url('/user-guide') }}" class="hover:text-paypal-gold">Help Center</a></li>
        <li><a href="{{ url('/api-docs') }}" class="hover:text-paypal-gold">Documentation</a></li>
        <li><a href="#" class="hover:text-paypal-gold">Status</a></li>
        <li><a href="{{ url('/admin') }}" class="hover:text-paypal-gold">Admin</a></li>
      </ul>
    </div>
  </div>
  <div class="mt-12 pt-6 border-t border-white/10 max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-ink-300">
    <p>© {{ date('Y') }} VoiceReach · Powered by Protiddhoni · All rights reserved.</p>
    <div class="flex gap-4">
      <a href="#" class="hover:text-paypal-gold">Privacy</a>
      <a href="#" class="hover:text-paypal-gold">Terms</a>
      <a href="#" class="hover:text-paypal-gold">Cookies</a>
    </div>
  </div>
</footer>

  <script>window.PROTIDDHONI_CMS_BASE = "{{ url('/api') }}";</script>
  <script src="{{ asset('assets/js/cms-client.js') }}"></script>
  <script>
    (function(){
      var els = document.querySelectorAll('.reveal');
      var io = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
          if(e.isIntersecting) {
            e.target.classList.add('in');
            io.unobserve(e.target);
          }
        });
      }, { threshold: 0, rootMargin: "0px 0px -10% 0px" });
      els.forEach(function(el){ io.observe(el); });
    })();
  </script>
  @stack('scripts')

</body>
</html>
