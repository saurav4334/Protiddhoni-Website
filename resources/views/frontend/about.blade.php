@extends('layouts.site')

@push('styles')
@verbatim
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --paper:#fafbff; --line:#eef1f8; --muted:#6b7693; --slate:#3d4a72;
    --green:#22c55e; --amber:#f59e0b;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  html{scroll-behavior:smooth}
  body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:#fff;color:var(--ink);line-height:1.55;-webkit-font-smoothing:antialiased}
  a{color:inherit;text-decoration:none}
  button{font-family:inherit;cursor:pointer;border:none}
  .container{max-width:1240px;margin:0 auto;padding:0 32px}

  /* NAV */
  .navbar{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.85);backdrop-filter:blur(20px);border-bottom:1px solid var(--line)}
  .nav-inner{display:flex;align-items:center;justify-content:space-between;padding:16px 32px;max-width:1240px;margin:0 auto}
  .logo{display:flex;align-items:center;gap:8px;font-weight:800;letter-spacing:-.5px;font-size:18px}
  .logo-dot{width:11px;height:11px;background:linear-gradient(135deg,var(--sky),var(--gold));border-radius:50%;box-shadow:0 0 0 3px rgba(0,156,222,.15)}
  .nav-links{display:flex;gap:28px;font-size:14px;color:var(--slate);font-weight:500}
  .nav-links a:hover{color:var(--blue)}
  .nav-cta{display:flex;gap:10px;align-items:center}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:10px;font-weight:600;font-size:13px;transition:all .2s}
  .btn-ghost{color:var(--slate)}
  .btn-ghost:hover{color:var(--blue)}
  .btn-primary{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;box-shadow:0 8px 20px -8px rgba(0,48,135,.5)}
  .btn-primary:hover{transform:translateY(-1px)}
  .btn-outline{background:#fff;color:var(--navy);border:1.5px solid #d4dae8}
  .btn-outline:hover{border-color:var(--blue);color:var(--blue)}
  .btn-gold{background:linear-gradient(135deg,#FFC439,#f59e0b);color:var(--ink)}
  .btn-lg{padding:14px 24px;font-size:14px}

  /* PAGE HERO */
  .page-hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 35%,#f0f4ff 100%);position:relative;overflow:hidden;padding:96px 0 80px;text-align:center}
  .page-hero::before{content:"";position:absolute;top:-100px;right:-100px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(255,196,57,.2),transparent 70%)}
  .page-hero::after{content:"";position:absolute;bottom:-150px;left:-100px;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(0,156,222,.15),transparent 70%)}
  .ph-eyebrow{display:inline-flex;align-items:center;gap:8px;background:rgba(0,112,186,.08);color:var(--navy);padding:8px 16px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:18px;position:relative;z-index:1}
  .ph-h1{font-size:64px;font-weight:800;letter-spacing:-2.5px;line-height:1.02;color:var(--ink);position:relative;z-index:1;max-width:920px;margin:0 auto}
  .ph-h1 .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .ph-sub{font-size:18px;color:#4a5675;line-height:1.65;max-width:680px;margin:22px auto 0;position:relative;z-index:1}

  /* SECTION */
  section{padding:96px 0}
  .section-head{text-align:center;max-width:720px;margin:0 auto 56px}
  .eyebrow{display:inline-block;font-size:11px;letter-spacing:2.5px;text-transform:uppercase;font-weight:800;color:var(--blue);margin-bottom:14px}
  h2.section-title{font-size:42px;font-weight:800;letter-spacing:-1.5px;line-height:1.1;color:var(--ink)}
  h2.section-title .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .section-sub{font-size:17px;color:#4a5675;margin-top:14px;line-height:1.6}

  /* STATS */
  .stats-banner{padding:48px 0;background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;position:relative;overflow:hidden}
  .stats-banner::before{content:"";position:absolute;inset:0;background:radial-gradient(800px 300px at 80% 50%,rgba(255,196,57,.15),transparent),radial-gradient(600px 300px at 10% 50%,rgba(0,156,222,.2),transparent)}
  .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:32px;position:relative;z-index:1}
  .stat-item{text-align:center;border-right:1px solid rgba(255,255,255,.1);padding:0 20px}
  .stat-item:last-child{border-right:none}
  .stat-num-big{font-family:'JetBrains Mono',monospace;font-size:48px;font-weight:800;letter-spacing:-2px;line-height:1;background:linear-gradient(180deg,#fff,#FFC439);-webkit-background-clip:text;background-clip:text;color:transparent}
  .stat-lbl{font-size:12px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.6);margin-top:10px;font-weight:700}

  /* STORY */
  .story{background:#fff}
  .story-grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;max-width:1180px;margin:0 auto}
  .story-text h2{font-size:36px;font-weight:800;letter-spacing:-1px;line-height:1.15;margin-bottom:20px}
  .story-text p{font-size:15.5px;color:#4a5675;line-height:1.75;margin-bottom:18px}
  .story-text strong{color:var(--ink);font-weight:700}
  .story-visual{position:relative;height:480px;background:linear-gradient(180deg,#fff7e6 0%,#fff 35%,#f0f4ff 100%);border-radius:28px;overflow:hidden;border:1px solid var(--line)}
  .sv-card{position:absolute;background:rgba(255,255,255,.95);backdrop-filter:blur(20px);border:1px solid var(--line);border-radius:14px;padding:14px 16px;box-shadow:0 16px 32px -10px rgba(0,48,135,.18);max-width:240px;animation:floatY 5s ease-in-out infinite}
  @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
  .sv-card.c1{top:30px;left:24px;animation-delay:0s}
  .sv-card.c2{top:160px;right:24px;animation-delay:1.6s}
  .sv-card.c3{bottom:40px;left:40px;animation-delay:3.2s}
  .sv-eyebrow{font-size:9px;letter-spacing:1.5px;color:var(--navy);font-weight:800;text-transform:uppercase;margin-bottom:4px}
  .sv-card h5{font-size:14px;font-weight:800;letter-spacing:-.3px;margin-bottom:4px}
  .sv-card p{font-size:11px;color:var(--muted);line-height:1.5;margin:0}
  .sv-card .num{font-family:'JetBrains Mono',monospace;font-size:24px;font-weight:800;color:var(--blue);letter-spacing:-1px;line-height:1}
  .sv-spark{position:absolute;width:60px;height:30px;display:flex;align-items:flex-end;gap:3px;margin-top:6px}
  .sv-spark div{flex:1;background:linear-gradient(180deg,var(--blue),var(--sky));border-radius:2px}

  /* MISSION */
  .mission{background:linear-gradient(180deg,#f8fafc,#fff)}
  .mission-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  .mission-card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:36px 28px;transition:all .3s;position:relative;overflow:hidden}
  .mission-card:hover{transform:translateY(-4px);border-color:transparent;box-shadow:0 30px 60px -25px rgba(0,48,135,.18)}
  .mission-card::before{content:"";position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--sky),var(--gold));transform:scaleX(0);transform-origin:left;transition:transform .3s}
  .mission-card:hover::before{transform:scaleX(1)}
  .mission-icon{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:20px}
  .mission-card.m1 .mission-icon{background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:var(--navy)}
  .mission-card.m2 .mission-icon{background:linear-gradient(135deg,#fef3c7,#fde68a);color:#a16207}
  .mission-card.m3 .mission-icon{background:linear-gradient(135deg,#dcfce7,#bbf7d0);color:#15803d}
  .mission-card h3{font-size:20px;font-weight:800;letter-spacing:-.4px;margin-bottom:10px}
  .mission-card p{color:var(--muted);font-size:14px;line-height:1.7}

  /* TIMELINE */
  .timeline{background:#fff}
  .timeline-grid{max-width:920px;margin:0 auto;position:relative;padding-left:60px}
  .timeline-grid::before{content:"";position:absolute;top:0;bottom:0;left:24px;width:2px;background:linear-gradient(180deg,var(--blue),var(--sky))}
  .tl-item{position:relative;padding-bottom:48px}
  .tl-item:last-child{padding-bottom:0}
  .tl-dot{position:absolute;left:-46px;top:0;width:48px;height:48px;border-radius:50%;background:#fff;border:3px solid var(--blue);display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:13px;font-weight:800;color:var(--blue);box-shadow:0 8px 20px -8px rgba(0,112,186,.4)}
  .tl-year{font-size:11px;color:var(--muted);font-weight:800;letter-spacing:1.5px;text-transform:uppercase;font-family:'JetBrains Mono',monospace;margin-bottom:6px}
  .tl-item h4{font-size:20px;font-weight:800;letter-spacing:-.4px;margin-bottom:8px}
  .tl-item p{color:var(--muted);font-size:14px;line-height:1.7}
  .tl-item.featured .tl-dot{background:linear-gradient(135deg,var(--gold),#f59e0b);border-color:var(--gold);color:var(--ink)}

  /* TEAM */
  .team{background:linear-gradient(180deg,#f8fafc,#fff)}
  .team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
  .team-card{background:#fff;border:1px solid var(--line);border-radius:18px;padding:24px;text-align:center;transition:all .3s}
  .team-card:hover{transform:translateY(-3px);border-color:var(--blue);box-shadow:0 20px 40px -16px rgba(0,48,135,.15)}
  .team-avatar{width:80px;height:80px;border-radius:50%;margin:0 auto 14px;display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:24px;font-weight:800;color:#fff;letter-spacing:-1px}
  .team-card.t1 .team-avatar{background:linear-gradient(135deg,var(--navy),var(--blue))}
  .team-card.t2 .team-avatar{background:linear-gradient(135deg,#a16207,var(--gold))}
  .team-card.t3 .team-avatar{background:linear-gradient(135deg,#15803d,var(--green))}
  .team-card.t4 .team-avatar{background:linear-gradient(135deg,#7c3aed,#a78bfa)}
  .team-card.t5 .team-avatar{background:linear-gradient(135deg,#be123c,#f43f5e)}
  .team-card.t6 .team-avatar{background:linear-gradient(135deg,#0e7490,#0891b2)}
  .team-card.t7 .team-avatar{background:linear-gradient(135deg,#1d4ed8,#3b82f6)}
  .team-card.t8 .team-avatar{background:linear-gradient(135deg,#4d7c0f,#84cc16)}
  .team-card h4{font-size:15px;font-weight:800;margin-bottom:4px;letter-spacing:-.3px}
  .team-card .role{font-size:11px;color:var(--blue);font-weight:700;letter-spacing:.5px;text-transform:uppercase;margin-bottom:8px}
  .team-card p{font-size:12px;color:var(--muted);line-height:1.55}
  .team-card .socials{margin-top:12px;display:flex;gap:8px;justify-content:center;font-size:13px;color:var(--muted)}
  .team-card .socials a:hover{color:var(--blue)}

  /* INVESTORS */
  .investors{background:#fff;text-align:center}
  .invest-wall{display:flex;justify-content:center;align-items:center;gap:40px;flex-wrap:wrap;margin-top:40px;opacity:.7}
  .invest-wall span{font-weight:800;font-size:18px;color:var(--slate);letter-spacing:-.5px;padding:12px 22px;border:1px solid var(--line);border-radius:12px;background:#fafbff}

  /* VALUES */
  .values{background:linear-gradient(135deg,var(--ink),#1a2350);color:#fff;position:relative;overflow:hidden}
  .values::before{content:"";position:absolute;inset:0;background:radial-gradient(800px 400px at 80% 50%,rgba(255,196,57,.15),transparent),radial-gradient(600px 400px at 10% 50%,rgba(0,156,222,.18),transparent)}
  .values .container{position:relative;z-index:1}
  .values .section-head h2{color:#fff}
  .values .section-head h2 .accent{background:linear-gradient(90deg,var(--gold),var(--sky));-webkit-background-clip:text;background-clip:text;color:transparent}
  .values .section-head .eyebrow{color:var(--gold)}
  .values .section-head p{color:rgba(255,255,255,.7)}
  .values-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
  .value-card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:28px;backdrop-filter:blur(20px);transition:all .3s}
  .value-card:hover{border-color:rgba(255,196,57,.4);transform:translateY(-3px)}
  .value-num{font-family:'JetBrains Mono',monospace;font-size:36px;font-weight:800;color:var(--gold);letter-spacing:-2px;margin-bottom:14px;line-height:1}
  .value-card h4{font-size:17px;font-weight:800;color:#fff;margin-bottom:10px;letter-spacing:-.3px}
  .value-card p{font-size:13px;color:rgba(255,255,255,.7);line-height:1.65}

  /* FINAL CTA */
  .final-cta{background:var(--ink);color:#fff;text-align:center;position:relative;overflow:hidden}
  .final-cta::before{content:"";position:absolute;inset:0;background:radial-gradient(800px 400px at 50% 0%,rgba(255,196,57,.18),transparent),radial-gradient(600px 400px at 10% 100%,rgba(0,156,222,.15),transparent)}
  .final-cta-inner{position:relative;z-index:1;max-width:800px;margin:0 auto}
  .final-cta h2{font-size:48px;font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:18px}
  .final-cta h2 .accent{background:linear-gradient(90deg,var(--gold),var(--sky));-webkit-background-clip:text;background-clip:text;color:transparent}
  .final-cta p{font-size:16px;color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 36px;line-height:1.6}
  .cta-row{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
  .final-cta .btn-outline{background:transparent;color:#fff;border-color:rgba(255,255,255,.3)}
  .final-cta .btn-outline:hover{background:rgba(255,255,255,.05);border-color:#fff}

  /* FOOTER */
  .footer{background:#070c1f;color:rgba(255,255,255,.65);padding:64px 0 28px;font-size:13px}
  .footer-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr 1fr;gap:32px;padding-bottom:48px;border-bottom:1px solid rgba(255,255,255,.08)}
  .footer-brand{font-weight:800;font-size:18px;color:#fff;display:flex;align-items:center;gap:8px;margin-bottom:14px}
  .footer-tagline{line-height:1.6;margin-bottom:18px;font-size:13px}
  .footer-social{display:flex;gap:10px}
  .footer-social a{width:34px;height:34px;border-radius:8px;background:rgba(255,255,255,.05);display:flex;align-items:center;justify-content:center;font-size:14px;transition:background .2s}
  .footer-social a:hover{background:var(--blue);color:#fff}
  .footer-col h5{color:#fff;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:14px}
  .footer-col ul{list-style:none;display:flex;flex-direction:column;gap:10px}
  .footer-col a{transition:color .2s;font-size:13px}
  .footer-col a:hover{color:#fff}
  .footer-bot{display:flex;justify-content:space-between;align-items:center;padding-top:24px;flex-wrap:wrap;gap:16px;font-size:12px;color:rgba(255,255,255,.45)}
  .footer-bot-links{display:flex;gap:20px}

  /* RESPONSIVE */
  @media(max-width:980px){
    .nav-links{display:none}
    .ph-h1{font-size:38px}
    .story-grid{grid-template-columns:1fr;gap:36px}
    .story-visual{height:340px}
    .stats-grid{grid-template-columns:repeat(2,1fr)}
    .stat-item{border-right:none}
    .mission-grid,.team-grid,.values-grid{grid-template-columns:1fr 1fr;gap:16px}
    .timeline-grid{padding-left:40px}
    .tl-dot{left:-32px;width:36px;height:36px;font-size:11px}
    .footer-grid{grid-template-columns:repeat(2,1fr)}
    .final-cta h2{font-size:30px}
    h2.section-title{font-size:28px}
    .stat-num-big{font-size:36px}
    section{padding:64px 0}
  }

  /* Reveal */
  .reveal{opacity:0;transform:translateY(20px);transition:opacity .8s ease-out,transform .8s ease-out}
  .reveal.in{opacity:1;transform:translateY(0)}
</style>
@endverbatim
@endpush

@section('content')
@verbatim
<!-- HERO -->
<section class="page-hero">
  <div class="container">
    <span class="ph-eyebrow" data-cms="about.hero.pill">About Protiddhoni</span>
    <h1 class="ph-h1" data-cms-html="about.hero.headline">Building voice infrastructure<br/>for <span class="accent">Bangladesh's next decade.</span></h1>
    <p class="ph-sub" data-cms-html="about.hero.subhead">Started in Dhaka, 2018. Today: 280+ businesses, 2.4M calls a day, 64 of 64 districts. We hold one simple promise: <strong>your voice will reach every corner of Bangladesh.</strong></p>
  </div>
</section>

<!-- STATS -->
<section class="stats-banner">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num-big">8</div><div class="stat-lbl">Years building</div></div>
      <div class="stat-item"><div class="stat-num-big">280+</div><div class="stat-lbl">BD businesses</div></div>
      <div class="stat-item"><div class="stat-num-big">2.4M</div><div class="stat-lbl">Calls / day</div></div>
      <div class="stat-item"><div class="stat-num-big">38</div><div class="stat-lbl">Team members</div></div>
    </div>
  </div>
</section>

<!-- STORY -->
<section class="story">
  <div class="container">
    <div class="story-grid">
      <div class="story-text reveal">
        <span class="eyebrow">Our story</span>
        <h2>It all started because of one failed OTP.</h2>
        <p>In 2017, our founder <strong>Tareq Hossain</strong> was building a small fintech app. One day an important transaction OTP never reached the customer — the SMS gateway had blocked it. He lost the customer that day, and went home with one question: <em>"Why don't Bangladesh's businesses have access to carrier-grade voice infrastructure?"</em></p>
        <p>Protiddhoni launched in 2018 — initial team of 4 engineers, one small office in Banani. The mission was singular: every business in our country should be able to <strong>reach any customer at any time, reliably</strong> — whether it's voice OTP, surveys, or broadcasts.</p>
        <p>Today we're a team of 38, with offices in Dhaka, Chattogram, and Sylhet, handling 2.4M+ calls a day. But the philosophy hasn't changed — <strong>when SMS fails, voice succeeds.</strong></p>
      </div>

      <div class="story-visual reveal">
        <div class="sv-card c1">
          <div class="sv-eyebrow">2018 · Day 1</div>
          <h5>4 founders, 1 server</h5>
          <p>A one-room office in Banani, routing through AWS Mumbai.</p>
        </div>
        <div class="sv-card c2">
          <div class="sv-eyebrow">2026 · Today</div>
          <div class="num">2.4M</div>
          <p>Calls processed every 24 hours, all 4 BD carriers.</p>
          <div class="sv-spark"><div style="height:30%"></div><div style="height:50%"></div><div style="height:40%"></div><div style="height:65%"></div><div style="height:80%"></div><div style="height:70%"></div><div style="height:95%"></div><div style="height:88%"></div><div style="height:100%"></div></div>
        </div>
        <div class="sv-card c3">
          <div class="sv-eyebrow">Vision · 2030</div>
          <h5>Voice for South Asia</h5>
          <p>Regional expansion from our BD foundation — Nepal, Bhutan, North-East India.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MISSION -->
<section class="mission">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Mission · Vision · Promise</span>
      <h2 class="section-title">Three sentences that <span class="accent">guide every decision</span></h2>
    </div>

    <div class="mission-grid">
      <div class="mission-card m1 reveal">
        <div class="mission-icon">🎯</div>
        <h3>Mission</h3>
        <p>Give every business in Bangladesh a voice channel that <strong style="color:var(--ink)">never fails</strong> — independent of geography, independent of carrier, independent of language.</p>
      </div>
      <div class="mission-card m2 reveal">
        <div class="mission-icon">🌅</div>
        <h3>Vision</h3>
        <p>By 2030, become South Asia's <strong style="color:var(--ink)">most trusted voice infrastructure</strong>. Starting in BD, expanding to Nepal, Bhutan, and North-East India. Voice = our region's communication standard.</p>
      </div>
      <div class="mission-card m3 reveal">
        <div class="mission-icon">🤝</div>
        <h3>Promise</h3>
        <p>Your customer's phone will ring — every time, on the first ring, in crystal-clear audio. <strong style="color:var(--ink)">99.4% delivery</strong> or your money back. SLA-backed, in writing.</p>
      </div>
    </div>
  </div>
</section>

<!-- TIMELINE -->
<section class="timeline">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Milestones</span>
      <h2 class="section-title">8 years, <span class="accent">measured by lives connected</span></h2>
    </div>

    <div class="timeline-grid">
      <div class="tl-item reveal"><div class="tl-dot">2018</div><div class="tl-year">May 2018 · Founded</div><h4>Protiddhoni born in Banani, Dhaka</h4><p>Tareq Hossain + 3 co-founders launch with seed funding from BD angel investors. First product: voice broadcasting MVP.</p></div>
      <div class="tl-item reveal"><div class="tl-dot">2019</div><div class="tl-year">August 2019</div><h4>First 10 enterprise customers</h4><p>BRAC Bank, Robi Marketing, Daraz, and 7 others sign on. Crossed 100K calls/month milestone.</p></div>
      <div class="tl-item reveal"><div class="tl-dot">2020</div><div class="tl-year">March 2020 · COVID</div><h4>Scaled 8x for vaccination outreach</h4><p>Partnered with DGHS for vaccination awareness across 64 districts. Served 14M+ outbound calls in 6 months.</p></div>
      <div class="tl-item reveal featured"><div class="tl-dot">★</div><div class="tl-year">January 2021 · Pivot</div><h4>Voice OTP product launches</h4><p>Banking customer demand drives Voice OTP launch. Becomes flagship product within 6 months. 99.4% delivery rate achieved.</p></div>
      <div class="tl-item reveal"><div class="tl-dot">2022</div><div class="tl-year">November 2022</div><h4>Series A raised</h4><p>$3.2M Series A led by IDLC Ventures. Used to build out IVR/Survey product and Chattogram engineering office.</p></div>
      <div class="tl-item reveal"><div class="tl-dot">2024</div><div class="tl-year">June 2024</div><h4>Crossed 1M calls/day</h4><p>BTRC compliance certification renewed. ISO 27001 + SOC 2 Type II audits completed. Sylhet office opens.</p></div>
      <div class="tl-item reveal featured"><div class="tl-dot">★</div><div class="tl-year">February 2026 · Today</div><h4>2.4M calls/day, 280+ businesses</h4><p>Election Commission contract. National-scale survey work begins. Team grows to 38. Building toward regional expansion.</p></div>
    </div>
  </div>
</section>

<!-- TEAM -->
<section class="team">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Leadership</span>
      <h2 class="section-title">The folks behind <span class="accent">every connected call</span></h2>
      <p class="section-sub">38 in total, headquartered in Dhaka. Engineers, ops, sales, support — and counting.</p>
    </div>

    <div class="team-grid">
      <div class="team-card t1 reveal"><div class="team-avatar">TH</div><h4>Tareq Hossain</h4><div class="role">CEO · Founder</div><p>10y telecom & fintech. Ex-Robi, ex-bKash. Built our carrier relationships from scratch.</p></div>
      <div class="team-card t2 reveal"><div class="team-avatar">RA</div><h4>Rashedul Amin</h4><div class="role">CTO · Co-founder</div><p>Architected the voice platform. Ex-Twilio engineering. Carrier-grade SIP wizard.</p></div>
      <div class="team-card t3 reveal"><div class="team-avatar">SK</div><h4>Sumaiya Khan</h4><div class="role">VP Product</div><p>Product-led growth. Previously built CRM tools at Pathao. Visual IVR builder is her brainchild.</p></div>
      <div class="team-card t4 reveal"><div class="team-avatar">AH</div><h4>Arif Hassan</h4><div class="role">VP Engineering</div><p>Scales the platform. Distributed systems specialist. Ex-Grab Singapore.</p></div>
      <div class="team-card t5 reveal"><div class="team-avatar">FA</div><h4>Farhana Akter</h4><div class="role">VP Sales</div><p>Owns enterprise relationships. Built the bKash, Daraz, Election Commission accounts.</p></div>
      <div class="team-card t6 reveal"><div class="team-avatar">MH</div><h4>Mahmudul Hasan</h4><div class="role">Head of Carrier Ops</div><p>Manages relationships with GP, Robi, Banglalink, Airtel. 99.4% delivery is his mandate.</p></div>
      <div class="team-card t7 reveal"><div class="team-avatar">NJ</div><h4>Nabila Jahan</h4><div class="role">Head of Customer Success</div><p>15min response time SLA. Ensures customers stay successful past day 1.</p></div>
      <div class="team-card t8 reveal"><div class="team-avatar">SC</div><h4>Saif Chowdhury</h4><div class="role">Head of Voice AI</div><p>Bangla TTS quality, voice cloning, conversational engine. PhD candidate, BUET.</p></div>
    </div>
  </div>
</section>

<!-- VALUES -->
<section class="values">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Our values</span>
      <h2 class="section-title">Four principles, <span class="accent">repeated daily.</span></h2>
      <p class="section-sub">These hang on the wall in every office. They show up in every code review, every customer call, every roadmap meeting.</p>
    </div>

    <div class="values-grid">
      <div class="value-card reveal">
        <div class="value-num">01</div>
        <h4>Reliability over flash</h4>
        <p>Customer phone bajbe — eta our singular obsession. Fancy features only ship if reliability stays at 99.4%+.</p>
      </div>
      <div class="value-card reveal">
        <div class="value-num">02</div>
        <h4>Bangladesh first</h4>
        <p>Pricing in Taka. Bangla TTS quality > English. BTRC compliance built-in. Local team, local support hours.</p>
      </div>
      <div class="value-card reveal">
        <div class="value-num">03</div>
        <h4>Talk straight</h4>
        <p>No "ask for a quote" pricing. No 50-page contracts. Status page is public. Outage post-mortems get published.</p>
      </div>
      <div class="value-card reveal">
        <div class="value-num">04</div>
        <h4>Build for the next district</h4>
        <p>Bandarban, Tetulia, Saint Martin — if a remote upazila customer can't be reached, the system isn't done.</p>
      </div>
    </div>
  </div>
</section>

<!-- INVESTORS -->
<section class="investors">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Backed by</span>
      <h2 class="section-title">Investors who <span class="accent">believe in BD</span></h2>
    </div>
    <div class="invest-wall reveal">
      <span>IDLC Ventures</span>
      <span>SBK Foundation</span>
      <span>Anchorless Bangladesh</span>
      <span>BD Ventures</span>
      <span>Pioneer Asia</span>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="final-cta">
  <div class="container">
    <div class="final-cta-inner">
      <span class="eyebrow" style="color:var(--gold)">Join us</span>
      <h2>Want to <span class="accent">build the next chapter</span> with us?</h2>
      <p>We're hiring engineers, ops, sales, and customer success folks who care deeply about Bangladesh's digital infrastructure.</p>
      <div class="cta-row">
        <a class="btn btn-gold btn-lg" href="#">View open roles →</a>
        <a class="btn btn-outline btn-lg" href="/contact">Say hi</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
@endverbatim
@endsection

@push('scripts')
@verbatim
<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        e.target.classList.add('in');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0, rootMargin: "0px 0px -10% 0px" });
  els.forEach(function(el){ io.observe(el); });
})();
</script>
@endverbatim
@endpush
