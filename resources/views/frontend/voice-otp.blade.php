@extends('layouts.site')

@push('styles')
@verbatim
<style>
  :root{
    --navy:#003087; --blue:#0070BA; --sky:#009CDE; --gold:#FFC439; --cream:#FFF9E6;
    --ink:#0a1230; --paper:#fafbff; --line:#eef1f8; --muted:#6b7693; --slate:#3d4a72;
    --green:#22c55e; --amber:#f59e0b; --red:#ef4444;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  html{scroll-behavior:smooth}
  body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:#fff;color:var(--ink);line-height:1.55;-webkit-font-smoothing:antialiased}
  a{color:inherit;text-decoration:none}
  button{font-family:inherit;cursor:pointer;border:none}
  .bn{font-family:'Hind Siliguri',sans-serif}
  .container{max-width:1240px;margin:0 auto;padding:0 32px}

  /* NAV */
  .navbar{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.85);backdrop-filter:blur(20px);border-bottom:1px solid var(--line)}
  .nav-inner{display:flex;align-items:center;justify-content:space-between;padding:16px 32px;max-width:1240px;margin:0 auto}
  .logo{display:flex;align-items:center;gap:8px;font-weight:800;letter-spacing:-.5px;font-size:18px}
  .logo-dot{width:11px;height:11px;background:linear-gradient(135deg,var(--sky),var(--gold));border-radius:50%;box-shadow:0 0 0 3px rgba(0,156,222,.15)}
  .nav-links{display:flex;gap:28px;font-size:14px;color:var(--slate);font-weight:500}
  .nav-links a{transition:color .2s}
  .nav-links a:hover,.nav-links a.active{color:var(--blue)}
  .nav-links a.active{font-weight:700}
  .nav-cta{display:flex;gap:10px;align-items:center}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:10px;font-weight:600;font-size:13px;transition:all .2s}
  .btn-ghost{color:var(--slate)}
  .btn-ghost:hover{color:var(--blue)}
  .btn-primary{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;box-shadow:0 8px 20px -8px rgba(0,48,135,.5)}
  .btn-primary:hover{transform:translateY(-1px);box-shadow:0 12px 28px -8px rgba(0,48,135,.6)}
  .btn-outline{background:#fff;color:var(--navy);border:1.5px solid #d4dae8}
  .btn-outline:hover{border-color:var(--blue);color:var(--blue)}
  .btn-gold{background:linear-gradient(135deg,#FFC439,#f59e0b);color:var(--ink)}
  .btn-lg{padding:14px 24px;font-size:14px}

  /* HERO */
  .hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 25%,#f0f4ff 65%,#e8eef9 100%);position:relative;overflow:hidden;padding:64px 0 56px}
  .hero-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center}
  .hero-h1{font-size:56px;font-weight:800;letter-spacing:-2px;line-height:1.05;color:var(--ink)}
  .hero-h1 .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .hero-sub{font-size:16px;color:#4a5675;line-height:1.65;max-width:520px;margin-top:18px}
  .hero-sub strong{color:var(--ink)}
  .status-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(34,197,94,.1);color:#15803d;padding:8px 14px;border-radius:999px;font-size:11px;font-weight:700;letter-spacing:.5px;border:1px solid rgba(34,197,94,.25);margin-bottom:18px;text-transform:uppercase}
  .live-dot{display:inline-block;width:6px;height:6px;border-radius:50%;background:var(--green);box-shadow:0 0 8px var(--green);animation:pulse 1.6s infinite}
  @keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.3);opacity:.6}}
  .cta-row{display:flex;gap:10px;margin-top:26px;align-items:center;flex-wrap:wrap}
  .trust-strip{display:flex;align-items:center;gap:12px;margin-top:22px;color:var(--muted);font-size:11px;font-weight:500}
  .stars{color:var(--gold);letter-spacing:1.5px}

  /* OTP demo phone mockup */
  .phone-mock{position:relative;height:560px;display:flex;align-items:center;justify-content:center}
  .phone{width:300px;height:530px;background:linear-gradient(180deg,#1a2350,#0a1230);border-radius:42px;padding:14px;box-shadow:0 40px 80px -30px rgba(10,18,48,.5),0 0 0 1px rgba(255,255,255,.06);position:relative;animation:floatPhone 5s ease-in-out infinite}
  @keyframes floatPhone{0%,100%{transform:translateY(0) rotate(-2deg)}50%{transform:translateY(-10px) rotate(-2deg)}}
  .phone::before{content:"";position:absolute;top:18px;left:50%;transform:translateX(-50%);width:90px;height:24px;background:#0a0a14;border-radius:14px;z-index:2}
  .phone-screen{width:100%;height:100%;background:linear-gradient(180deg,#fafbff,#fff);border-radius:32px;overflow:hidden;position:relative;display:flex;flex-direction:column}
  .phone-status{padding:50px 18px 14px;display:flex;justify-content:space-between;align-items:center;font-size:11px;color:var(--ink);font-weight:700;font-family:'JetBrains Mono',monospace}
  .phone-content{flex:1;padding:0 22px;display:flex;flex-direction:column;justify-content:center;gap:20px}
  .otp-app{font-size:11px;color:var(--muted);text-align:center;letter-spacing:1px;text-transform:uppercase;font-weight:700}
  .otp-msg{text-align:center;color:var(--slate);font-size:13px;line-height:1.55}
  .otp-msg strong{color:var(--ink)}
  .otp-boxes{display:flex;gap:8px;justify-content:center;margin:14px 0}
  .otp-box{width:42px;height:50px;border:2px solid var(--line);border-radius:10px;display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:24px;font-weight:800;color:var(--ink);transition:all .3s;background:#fff}
  .otp-box.filled{border-color:var(--blue);background:rgba(0,112,186,.05);animation:fillBox .4s ease-out}
  @keyframes fillBox{0%{transform:scale(.8);opacity:0}100%{transform:scale(1);opacity:1}}
  .otp-box.filled:nth-child(1){animation-delay:.4s;animation-fill-mode:backwards}
  .otp-box.filled:nth-child(2){animation-delay:.6s;animation-fill-mode:backwards}
  .otp-box.filled:nth-child(3){animation-delay:.8s;animation-fill-mode:backwards}
  .otp-box.filled:nth-child(4){animation-delay:1s;animation-fill-mode:backwards}
  .otp-box.filled:nth-child(5){animation-delay:1.2s;animation-fill-mode:backwards}
  .otp-box.filled:nth-child(6){animation-delay:1.4s;animation-fill-mode:backwards}
  .verify-btn{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;padding:13px;border-radius:12px;font-weight:700;font-size:14px;text-align:center;box-shadow:0 8px 20px -6px rgba(0,48,135,.4)}
  .resend-link{font-size:11px;color:var(--muted);text-align:center}
  .resend-link span{color:var(--blue);font-weight:700}

  /* incoming call notification */
  .call-notif{position:absolute;top:60px;left:-30px;background:#fff;border-radius:14px;padding:12px 14px;box-shadow:0 20px 40px -10px rgba(0,48,135,.25);width:240px;display:flex;align-items:center;gap:10px;animation:slideIn 1s ease-out;animation-delay:.2s;animation-fill-mode:backwards;border:1px solid var(--line);z-index:10}
  .phone{z-index:1}
  @keyframes slideIn{from{opacity:0;transform:translateX(-30px)}to{opacity:1;transform:translateX(0)}}
  .ci-pulse{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--green),#16a34a);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;flex-shrink:0;animation:ringPulse 1.4s infinite}
  @keyframes ringPulse{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.4)}50%{box-shadow:0 0 0 10px rgba(34,197,94,0)}}
  .ci-meta{flex:1;min-width:0}
  .ci-name{font-weight:800;font-size:13px}
  .ci-num{font-size:10px;color:var(--muted);font-family:'JetBrains Mono',monospace;margin-top:1px}

  .stat-float{position:absolute;background:rgba(255,255,255,.94);backdrop-filter:blur(20px);border:1px solid rgba(0,48,135,.08);border-radius:14px;padding:11px 14px;box-shadow:0 16px 32px -10px rgba(0,48,135,.18);min-width:140px;animation:floatY 4s ease-in-out infinite}
  @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
  .stat-float.sf1{top:30%;right:-10px;animation-delay:1.5s}
  .stat-float.sf2{bottom:14%;right:0;animation-delay:2.6s}
  .sf-eyebrow{font-size:9px;letter-spacing:1.5px;color:var(--navy);font-weight:800;text-transform:uppercase}
  .sf-num{font-family:'JetBrains Mono',monospace;font-size:20px;font-weight:800;color:var(--ink)}
  .sf-sub{font-size:10px;color:var(--muted);margin-top:1px}

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

  /* WHY VOICE */
  .why{background:#fff}
  .why-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:60px;align-items:center}
  .vs-card{background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:0 30px 60px -30px rgba(0,48,135,.18)}
  .vs-row{display:grid;grid-template-columns:1fr 1fr;font-size:13.5px}
  .vs-row.head{background:linear-gradient(180deg,#f8fafc,#fff);font-weight:800;font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--ink)}
  .vs-cell{padding:18px 22px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:10px}
  .vs-cell:first-child{border-right:1px solid var(--line);background:#fafbff}
  .vs-row:last-child .vs-cell{border-bottom:none}
  .vs-cell.win{color:var(--ink);font-weight:600}
  .vs-cell.lose{color:var(--muted)}
  .vs-cell .ic{font-size:16px}
  .vs-tag{display:inline-block;font-size:10px;font-weight:800;letter-spacing:1px;text-transform:uppercase;padding:3px 8px;border-radius:6px;margin-left:auto}
  .vs-tag.good{background:rgba(34,197,94,.12);color:#15803d}
  .vs-tag.bad{background:rgba(239,68,68,.1);color:#b91c1c}
  .why-text h3{font-size:32px;font-weight:800;letter-spacing:-1px;line-height:1.15;margin-bottom:16px}
  .why-text p{font-size:15px;color:#4a5675;line-height:1.7;margin-bottom:14px}
  .why-list{list-style:none;display:flex;flex-direction:column;gap:14px;margin-top:24px}
  .why-list li{display:flex;align-items:flex-start;gap:14px;font-size:14.5px;color:var(--slate)}
  .why-list li .num{width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:var(--navy);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;flex-shrink:0;font-family:'JetBrains Mono',monospace}
  .why-list strong{color:var(--ink);font-weight:700}

  /* USE CASES */
  .uc{background:linear-gradient(180deg,#f8fafc,#fff)}
  .uc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
  .uc-card{background:#fff;border:1px solid var(--line);border-radius:18px;padding:28px;transition:all .3s;position:relative;overflow:hidden}
  .uc-card::before{content:"";position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--sky),var(--gold));transform:scaleX(0);transform-origin:left;transition:transform .3s}
  .uc-card:hover{transform:translateY(-3px);box-shadow:0 20px 40px -16px rgba(0,48,135,.15)}
  .uc-card:hover::before{transform:scaleX(1)}
  .uc-icon{width:52px;height:52px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:16px}
  .uc-card.bank .uc-icon{background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:var(--navy)}
  .uc-card.ecom .uc-icon{background:linear-gradient(135deg,#fef3c7,#fde68a);color:#a16207}
  .uc-card.gov .uc-icon{background:linear-gradient(135deg,#dcfce7,#bbf7d0);color:#15803d}
  .uc-card.edu .uc-icon{background:linear-gradient(135deg,#fae8ff,#e9d5ff);color:#7c3aed}
  .uc-card.health .uc-icon{background:linear-gradient(135deg,#ffe4e6,#fecdd3);color:#be123c}
  .uc-card.mfs .uc-icon{background:linear-gradient(135deg,#cffafe,#a5f3fc);color:#0e7490}
  .uc-card h4{font-size:18px;font-weight:800;letter-spacing:-.4px;margin-bottom:8px}
  .uc-card p{font-size:13.5px;color:var(--muted);line-height:1.6;margin-bottom:14px}
  .uc-tag{display:inline-block;background:rgba(0,112,186,.08);color:var(--navy);padding:4px 10px;border-radius:6px;font-size:10px;font-weight:700;letter-spacing:.5px}

  /* CODE / INTEGRATION */
  .integ{background:#fff}
  .integ-grid{display:grid;grid-template-columns:1fr 1.1fr;gap:48px;align-items:flex-start}
  .integ-text h3{font-size:32px;font-weight:800;letter-spacing:-1px;line-height:1.15;margin-bottom:14px}
  .integ-text p{color:var(--muted);font-size:15px;line-height:1.7;margin-bottom:24px}
  .lang-tabs{display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap}
  .lang-tab{padding:8px 16px;border:1px solid var(--line);border-radius:8px;font-size:12px;font-weight:700;color:var(--slate);background:#fff;cursor:pointer;font-family:'JetBrains Mono',monospace}
  .lang-tab.active{background:var(--ink);color:var(--gold);border-color:var(--ink)}
  .code-block{background:var(--ink);color:#e0f2fe;padding:28px;border-radius:18px;font-family:'JetBrains Mono',monospace;font-size:13px;line-height:1.7;overflow-x:auto;border:1px solid #1a2350;position:relative}
  .code-tag{position:absolute;top:14px;right:14px;background:rgba(255,255,255,.06);padding:4px 10px;border-radius:6px;font-size:10px;font-weight:700;color:var(--gold);letter-spacing:1px}
  .code-block .k{color:#FFC439}
  .code-block .s{color:#7eb8e0}
  .code-block .c{color:#64748b;font-style:italic}
  .code-block .n{color:#22c55e}
  .code-pane{display:none}
  .code-pane.active{display:block}

  .integ-feats{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:24px}
  .integ-feat{padding:14px 16px;background:#f8fafc;border-radius:12px;border:1px solid var(--line)}
  .integ-feat h5{font-size:13px;font-weight:800;color:var(--ink);margin-bottom:4px}
  .integ-feat p{font-size:12px;color:var(--muted);line-height:1.5;margin:0}

  /* HOW OTP FLOW */
  .flow{background:linear-gradient(180deg,#f8fafc,#fff)}
  .flow-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;position:relative;margin-top:48px}
  .flow-grid::before{content:"";position:absolute;top:32px;left:8%;right:8%;height:2px;background:repeating-linear-gradient(90deg,var(--blue) 0,var(--blue) 6px,transparent 6px,transparent 12px);z-index:0}
  .flow-step{position:relative;text-align:center;padding:0 12px;z-index:1}
  .flow-num{width:64px;height:64px;border-radius:50%;background:#fff;border:3px solid var(--blue);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:800;color:var(--blue);margin:0 auto 18px;font-family:'JetBrains Mono',monospace;box-shadow:0 8px 24px -8px rgba(0,112,186,.4)}
  .flow-step h4{font-size:16px;font-weight:800;margin-bottom:8px;letter-spacing:-.3px}
  .flow-step p{font-size:13px;color:var(--muted);line-height:1.55}
  .flow-step .ms{display:block;margin-top:6px;font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--gold);font-weight:700}

  /* SECURITY */
  .security{background:linear-gradient(135deg,var(--ink),#1a2350);color:#fff;position:relative;overflow:hidden}
  .security::before{content:"";position:absolute;inset:0;background:radial-gradient(800px 400px at 80% 50%,rgba(255,196,57,.15),transparent),radial-gradient(600px 400px at 10% 50%,rgba(0,156,222,.18),transparent)}
  .security .container{position:relative;z-index:1}
  .security-head{text-align:center;max-width:720px;margin:0 auto 56px}
  .security-head h2{font-size:38px;font-weight:800;letter-spacing:-1.2px;line-height:1.1;color:#fff}
  .security-head h2 .accent{background:linear-gradient(90deg,var(--gold),var(--sky));-webkit-background-clip:text;background-clip:text;color:transparent}
  .security-head .eyebrow{color:var(--gold)}
  .security-head p{color:rgba(255,255,255,.7);font-size:16px;line-height:1.65;margin-top:14px}
  .sec-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
  .sec-card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:28px;backdrop-filter:blur(20px);transition:all .3s}
  .sec-card:hover{border-color:rgba(255,196,57,.4);transform:translateY(-3px)}
  .sec-icon{font-size:28px;margin-bottom:16px}
  .sec-card h4{font-size:17px;font-weight:800;color:#fff;margin-bottom:8px}
  .sec-card p{font-size:13.5px;color:rgba(255,255,255,.7);line-height:1.65}

  /* TESTIMONIAL */
  .testimonial{background:#fff;text-align:center}
  .testi-quote{font-size:26px;font-weight:600;letter-spacing:-.5px;line-height:1.45;max-width:880px;margin:0 auto 32px;color:var(--ink)}
  .testi-quote::before{content:"\201C";font-family:Georgia,serif;font-size:80px;color:var(--gold);line-height:.5;display:block;margin-bottom:8px;font-weight:700}
  .testi-author{display:flex;align-items:center;justify-content:center;gap:14px}
  .testi-avatar{width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--sky));display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:14px}
  .testi-name{font-weight:800;font-size:14px;text-align:left}
  .testi-role{font-size:12px;color:var(--muted);margin-top:1px;text-align:left}

  /* FAQ */
  .faq{background:linear-gradient(180deg,#f8fafc,#fff)}
  .faq-grid{max-width:820px;margin:0 auto}
  .faq-item{border-bottom:1px solid var(--line);padding:20px 0}
  .faq-q{display:flex;justify-content:space-between;align-items:center;cursor:pointer;font-weight:700;font-size:16px;letter-spacing:-.2px;list-style:none}
  .faq-q::-webkit-details-marker{display:none}
  .faq-q::after{content:"+";font-size:24px;font-weight:300;color:var(--blue);transition:transform .2s;flex-shrink:0;margin-left:16px}
  .faq-item[open] .faq-q::after{content:"−"}
  .faq-a{color:var(--muted);font-size:14px;line-height:1.7;margin-top:12px;max-width:680px}

  /* CTA */
  .final-cta{background:var(--ink);color:#fff;text-align:center;position:relative;overflow:hidden}
  .final-cta::before{content:"";position:absolute;inset:0;background:radial-gradient(800px 400px at 50% 0%,rgba(255,196,57,.18),transparent),radial-gradient(600px 400px at 10% 100%,rgba(0,156,222,.15),transparent)}
  .final-cta-inner{position:relative;z-index:1;max-width:800px;margin:0 auto}
  .final-cta h2{font-size:48px;font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:18px}
  .final-cta h2 .accent{background:linear-gradient(90deg,var(--gold),var(--sky));-webkit-background-clip:text;background-clip:text;color:transparent}
  .final-cta p{font-size:16px;color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 36px;line-height:1.6}
  .final-cta .cta-row{justify-content:center}
  .final-cta .btn-outline{background:transparent;color:#fff;border-color:rgba(255,255,255,.3)}
  .final-cta .btn-outline:hover{background:rgba(255,255,255,.05);border-color:#fff}
  .perks{display:flex;justify-content:center;gap:32px;margin-top:32px;color:rgba(255,255,255,.6);font-size:12px;font-weight:600;flex-wrap:wrap}
  .perks span::before{content:"✓ ";color:var(--green);margin-right:4px}

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
    .hero-grid{grid-template-columns:1fr;gap:36px}
    .hero-h1{font-size:38px}
    .phone-mock{height:480px}
    .stats-grid{grid-template-columns:repeat(2,1fr);gap:24px}
    .stat-item{border-right:none}
    .why-grid,.integ-grid{grid-template-columns:1fr}
    .uc-grid,.sec-grid{grid-template-columns:1fr}
    .flow-grid{grid-template-columns:1fr;gap:32px}
    .flow-grid::before{display:none}
    .footer-grid{grid-template-columns:repeat(2,1fr)}
    .final-cta h2{font-size:30px}
    h2.section-title{font-size:28px}
    .stat-num-big{font-size:36px}
    .testi-quote{font-size:20px}
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
<!-- NAV -->


<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-grid">
      <div>
        <span class="status-pill"><span class="live-dot"></span><span data-cms="voice-otp.hero.pill">Voice OTP · 99.4% delivery in 2s</span></span>
        <h1 class="hero-h1" data-cms-html="voice-otp.hero.headline">SMS OTP busy?<br/>Network jam?<br/><span class="accent">Voice OTP works.</span></h1>
        <p class="hero-sub" data-cms-html="voice-otp.hero.subhead">When SMS gets throttled or filtered by carriers, Voice OTP still gets through. The call rings directly on the customer's phone and reads out the OTP in Bangla — <strong>3× more reliable than SMS, delivered in 2 seconds.</strong></p>

        <div class="cta-row">
          <a class="btn btn-primary btn-lg" href="#">Get free API key →</a>
          <a class="btn btn-outline btn-lg" href="#demo">▶ Hear sample</a>
        </div>

        <div class="trust-strip">
          <span class="stars">★★★★★</span>
          <span><strong style="color:var(--ink)">4.9/5</strong> · 280+ businesses · bKash · Daraz · Pathao · BRAC</span>
        </div>
      </div>

      <div class="phone-mock">
        <!-- Incoming call notification -->
        <div class="call-notif">
          <div class="ci-pulse">📞</div>
          <div class="ci-meta">
            <div class="ci-name">VoiceReach OTP</div>
            <div class="ci-num">+880 9610-114455</div>
          </div>
        </div>

        <!-- Phone -->
        <div class="phone">
          <div class="phone-screen">
            <div class="phone-status"><span>9:41</span><span>● ● ●</span></div>
            <div class="phone-content">
              <div class="otp-app">VoiceReach OTP</div>
              <div class="otp-msg">Listen to your 6-digit verification code and <strong>type it</strong> below</div>
              <div class="otp-boxes">
                <div class="otp-box filled">8</div>
                <div class="otp-box filled">2</div>
                <div class="otp-box filled">5</div>
                <div class="otp-box filled">9</div>
                <div class="otp-box filled">3</div>
                <div class="otp-box filled">7</div>
              </div>
              <div class="verify-btn">✓ Verified successfully</div>
              <div class="resend-link">Code shoneni? <span>Resend voice call</span></div>
            </div>
          </div>
        </div>

        <div class="stat-float sf1">
          <div class="sf-eyebrow">Avg latency</div>
          <div class="sf-num">1.6<span style="font-size:13px;color:var(--muted)">s</span></div>
          <div class="sf-sub">delivery time</div>
        </div>
        <div class="stat-float sf2">
          <div class="sf-eyebrow">Delivery rate</div>
          <div class="sf-num">99.4%</div>
          <div class="sf-sub">all 4 carriers</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats-banner">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num-big">99.4%</div><div class="stat-lbl">Delivery rate</div></div>
      <div class="stat-item"><div class="stat-num-big">1.6s</div><div class="stat-lbl">Avg latency</div></div>
      <div class="stat-item"><div class="stat-num-big">8.4M</div><div class="stat-lbl">OTPs / month</div></div>
      <div class="stat-item"><div class="stat-num-big">280+</div><div class="stat-lbl">BD businesses</div></div>
    </div>
  </div>
</section>

<!-- WHY VOICE -->
<section class="why">
  <div class="container">
    <div class="why-grid">
      <div class="why-text reveal">
        <span class="eyebrow">Voice vs SMS OTP</span>
        <h3>Once you understand SMS's problem, <br/>voice's power becomes obvious.</h3>
        <p>In Bangladesh, the average SMS OTP delivery rate is <strong>~78%</strong>. Thousands of OTPs go missing every minute due to carrier throttling, spam filters, and full inboxes.</p>
        <p>Voice OTP <strong>rings the phone directly</strong> and reads the OTP in Bangla. It doesn't depend on inboxes, doesn't get throttled, and is far friendlier for elderly and non-tech users.</p>

        <ul class="why-list">
          <li><span class="num">01</span><span><strong>3x higher delivery</strong> — voice goes through even when SMS is throttled</span></li>
          <li><span class="num">02</span><span><strong>Bangla pronunciation</strong> — natural female and male voices pronounce digits clearly</span></li>
          <li><span class="num">03</span><span><strong>No spam folder</strong> — phone bajbe, inbox e harabe na</span></li>
          <li><span class="num">04</span><span><strong>Accessible</strong> — perfect for old phones, low-literacy users, and vision-impaired customers</span></li>
        </ul>
      </div>

      <div class="vs-card reveal">
        <div class="vs-row head">
          <div class="vs-cell">Compare</div>
          <div class="vs-cell" style="background:linear-gradient(180deg,#FFF9E6,#fff);color:var(--navy)">VoiceReach OTP</div>
        </div>
        <div class="vs-row">
          <div class="vs-cell"><span class="ic">📨</span>SMS OTP</div>
          <div class="vs-cell win"><span class="ic">📞</span>Voice OTP <span class="vs-tag good">Better</span></div>
        </div>
        <div class="vs-row">
          <div class="vs-cell lose">~78% delivery</div>
          <div class="vs-cell win">99.4% delivery <span class="vs-tag good">+21%</span></div>
        </div>
        <div class="vs-row">
          <div class="vs-cell lose">3-15s latency</div>
          <div class="vs-cell win">1.6s avg <span class="vs-tag good">faster</span></div>
        </div>
        <div class="vs-row">
          <div class="vs-cell lose">Carrier filtered</div>
          <div class="vs-cell win">No filtering</div>
        </div>
        <div class="vs-row">
          <div class="vs-cell lose">English only mostly</div>
          <div class="vs-cell win">Bangla + English TTS</div>
        </div>
        <div class="vs-row">
          <div class="vs-cell lose">৳0.40 / SMS</div>
          <div class="vs-cell win">৳0.45 / OTP <span class="vs-tag bad">+5p</span></div>
        </div>
        <div class="vs-row">
          <div class="vs-cell lose">No accessibility</div>
          <div class="vs-cell win">Voice = accessible</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FLOW -->
<section class="flow">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">How it works</span>
      <h2 class="section-title">From signup to verified — <span class="accent">4 steps, 2 seconds.</span></h2>
    </div>

    <div class="flow-grid">
      <div class="flow-step reveal"><div class="flow-num">01</div><h4>API request</h4><p>Your app calls our `/otp/send` endpoint with phone number.<span class="ms">~50ms</span></p></div>
      <div class="flow-step reveal"><div class="flow-num">02</div><h4>Carrier route</h4><p>We pick the best route across GP / Robi / BL / Airtel automatically.<span class="ms">~200ms</span></p></div>
      <div class="flow-step reveal"><div class="flow-num">03</div><h4>Phone rings</h4><p>Voice call delivers OTP in Bangla or English clearly.<span class="ms">~1.2s</span></p></div>
      <div class="flow-step reveal"><div class="flow-num">04</div><h4>Webhook verify</h4><p>You verify the entered code via our `/otp/verify` endpoint.<span class="ms">~150ms</span></p></div>
    </div>
  </div>
</section>

<!-- USE CASES -->
<section class="uc">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Use cases</span>
      <h2 class="section-title">Where Voice OTP <span class="accent">actually shines</span></h2>
      <p class="section-sub">Specific scenarios where voice beats SMS by an order of magnitude.</p>
    </div>

    <div class="uc-grid">
      <div class="uc-card bank reveal">
        <div class="uc-icon">🏦</div>
        <h4>Banking transactions</h4>
        <p>When SMS gateways fail to deliver critical 2FA codes, Voice OTP keeps the transaction from aborting.</p>
        <span class="uc-tag">DBBL · BRAC · IBBL · Mutual Trust</span>
      </div>
      <div class="uc-card mfs reveal">
        <div class="uc-icon">💸</div>
        <h4>MFS cash-in/out</h4>
        <p>bKash / Nagad agent transactions e high-value verification needs guaranteed delivery.</p>
        <span class="uc-tag">bKash · Nagad · Rocket · Upay</span>
      </div>
      <div class="uc-card ecom reveal">
        <div class="uc-icon">🛒</div>
        <h4>E-commerce checkout</h4>
        <p>COD verification, account-login OTP — cuts drop-off rate by 30%+, saves abandoned carts.</p>
        <span class="uc-tag">Daraz · Chaldal · Pickaboo · Othoba</span>
      </div>
      <div class="uc-card edu reveal">
        <div class="uc-icon">🎓</div>
        <h4>Edu & exam systems</h4>
        <p>Admit-card verification, online-exam access — voice is perfect for non-tech-savvy students.</p>
        <span class="uc-tag">Univ admission · NU · BRAC Univ</span>
      </div>
      <div class="uc-card health reveal">
        <div class="uc-icon">🏥</div>
        <h4>Healthcare apps</h4>
        <p>Telemedicine login, prescription pickup, vaccination booking — reach elderly users effortlessly.</p>
        <span class="uc-tag">Praava · Olwel · Doctorola · DGHS</span>
      </div>
      <div class="uc-card gov reveal">
        <div class="uc-icon">🏛</div>
        <h4>Government & utilities</h4>
        <p>NID portal, BTRC services, electricity bill payment — citizen verification at national scale.</p>
        <span class="uc-tag">a2i · DESCO · NESCO · Election Comm</span>
      </div>
    </div>
  </div>
</section>

<!-- INTEGRATION / CODE -->
<section class="integ" id="integration">
  <div class="container">
    <div class="integ-grid">
      <div class="integ-text reveal">
        <span class="eyebrow">Developer-first</span>
        <h3>5-minute integration. Your favorite stack.</h3>
        <p>One REST endpoint, official SDKs in Node, Python, PHP, Java, Go, .NET. Webhooks for delivery status. Idempotent retries.</p>

        <div class="integ-feats">
          <div class="integ-feat"><h5>🔁 Idempotent</h5><p>Safe to retry — same request_id won't double-charge.</p></div>
          <div class="integ-feat"><h5>🪝 Webhooks</h5><p>Real-time delivery status pushed to your endpoint.</p></div>
          <div class="integ-feat"><h5>🌐 Region-locked</h5><p>BD-only by default. Lock per-IP or per-key.</p></div>
          <div class="integ-feat"><h5>📈 Rate limits</h5><p>1,000 req/sec on Business. Burst-friendly.</p></div>
        </div>

        <div style="margin-top:28px"><a class="btn btn-primary btn-lg" href="/api-docs">Read full API docs →</a></div>
      </div>

      <div class="reveal">
        <div class="lang-tabs">
          <button class="lang-tab active" data-lang="node">Node.js</button>
          <button class="lang-tab" data-lang="py">Python</button>
          <button class="lang-tab" data-lang="php">PHP</button>
          <button class="lang-tab" data-lang="curl">cURL</button>
        </div>

        <div class="code-pane active" data-lang="node">
          <div class="code-block"><span class="code-tag">NODE.JS</span><pre><span class="c">// Send Voice OTP — 5 lines, 1.6s delivery</span>
<span class="k">const</span> voice = <span class="k">require</span>(<span class="s">'@protiddhoni/voicereach'</span>);
<span class="k">const</span> client = <span class="k">new</span> voice.<span class="n">Client</span>(<span class="s">'sk_live_xxx'</span>);

<span class="k">const</span> otp = <span class="k">await</span> client.<span class="n">otp</span>.<span class="n">send</span>({
  to: <span class="s">'+8801712345678'</span>,
  language: <span class="s">'bn'</span>,
  voice: <span class="s">'female-natural'</span>,
  expiry: <span class="n">300</span>
});

<span class="c">// → otp.id, otp.status: 'queued'</span></pre></div>
        </div>

        <div class="code-pane" data-lang="py">
          <div class="code-block"><span class="code-tag">PYTHON</span><pre><span class="c"># Send Voice OTP via Python SDK</span>
<span class="k">from</span> voicereach <span class="k">import</span> Client

client = Client(<span class="s">'sk_live_xxx'</span>)

otp = client.otp.send(
    to=<span class="s">'+8801712345678'</span>,
    language=<span class="s">'bn'</span>,
    voice=<span class="s">'female-natural'</span>,
    expiry=<span class="n">300</span>,
)
<span class="k">print</span>(otp.id, otp.status)</pre></div>
        </div>

        <div class="code-pane" data-lang="php">
          <div class="code-block"><span class="code-tag">PHP</span><pre><span class="c">// Send Voice OTP via PHP SDK</span>
<span class="k">use</span> Protiddhoni\VoiceReach\Client;

$client = <span class="k">new</span> Client(<span class="s">'sk_live_xxx'</span>);

$otp = $client->otp->send([
    <span class="s">'to'</span> => <span class="s">'+8801712345678'</span>,
    <span class="s">'language'</span> => <span class="s">'bn'</span>,
    <span class="s">'voice'</span> => <span class="s">'female-natural'</span>,
    <span class="s">'expiry'</span> => <span class="n">300</span>,
]);</pre></div>
        </div>

        <div class="code-pane" data-lang="curl">
          <div class="code-block"><span class="code-tag">cURL</span><pre><span class="c"># Send Voice OTP — direct REST</span>
curl -X POST https://api.voicereach.bd/v1/otp/send \
  -H <span class="s">"Authorization: Bearer sk_live_xxx"</span> \
  -H <span class="s">"Content-Type: application/json"</span> \
  -d <span class="s">'{
    "to": "+8801712345678",
    "language": "bn",
    "voice": "female-natural",
    "expiry": 300
  }'</span></pre></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECURITY -->
<section class="security">
  <div class="container">
    <div class="security-head reveal">
      <span class="eyebrow">Security & Compliance</span>
      <h2>Bank-grade security, <span class="accent">BD-grade compliance.</span></h2>
      <p>Bangladesh Bank guidelines and BTRC norms — built into the protocol, not added on top.</p>
    </div>

    <div class="sec-grid">
      <div class="sec-card reveal"><div class="sec-icon">🔐</div><h4>End-to-end encrypted</h4><p>TLS 1.3 in transit. AES-256 at rest. OTPs hashed with SHA-256, never stored plaintext.</p></div>
      <div class="sec-card reveal"><div class="sec-icon">🛡</div><h4>BTRC compliant</h4><p>Licensed VAS provider. All voice routes through Bangladesh-licensed carriers. No grey routing.</p></div>
      <div class="sec-card reveal"><div class="sec-icon">🌍</div><h4>Data residency in BD</h4><p>All call logs and customer PII stored in Bangladesh-located data centers. No cross-border transfer.</p></div>
      <div class="sec-card reveal"><div class="sec-icon">⏱</div><h4>OTP expiry control</h4><p>Default 5-minute window. Configurable per request. Auto-revoke on verify or expire.</p></div>
      <div class="sec-card reveal"><div class="sec-icon">🚫</div><h4>Rate limiting</h4><p>Per-phone, per-IP, per-API-key throttling. Stops brute force, prevents abuse, configurable.</p></div>
      <div class="sec-card reveal"><div class="sec-icon">📜</div><h4>Full audit trail</h4><p>Every call logged with timestamp, route, latency, status. Exportable for compliance audits.</p></div>
    </div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section class="testimonial">
  <div class="container">
    <div class="reveal">
      <div class="testi-quote">
        After migrating to VoiceReach's Voice OTP, our transaction completion rate climbed from <strong style="color:var(--blue)">63% to 89%</strong>. In the past 6 months not a single failed delivery has slipped past our monitoring.
      </div>
      <div class="testi-author">
        <div class="testi-avatar">RA</div>
        <div>
          <div class="testi-name">Rashedul Alam</div>
          <div class="testi-role">CTO · NimbusFin (digital banking startup, Dhaka)</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="faq">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Voice OTP FAQ</span>
      <h2 class="section-title">Common <span class="accent">questions</span></h2>
    </div>

    <div class="faq-grid">
      <details class="faq-item" open>
        <summary class="faq-q">How is Voice OTP different from SMS OTP?</summary>
        <p class="faq-a">Voice OTP places a call to the customer and reads out the OTP in Bangla or English. Unlike SMS, it doesn't go to an inbox, so it can't get lost in filters or spam folders. The carrier-level delivery rate is far higher (99.4% vs ~78%) and it's much more accessible for elderly and low-literacy users.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">Is Bangla voice quality natural?</summary>
        <p class="faq-a">Yes — we use neural TTS so that Bangla pronunciation, intonation, and number reading sound natural. You can choose from 4 voice options (2 female, 2 male) or commission a custom voice clone.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">Which Bangladeshi carriers are supported?</summary>
        <p class="faq-a">All four — Grameenphone (GP), Robi/Airtel, Banglalink. We do automatic routing that picks the route with the highest delivery rate per carrier. You can also set a manual carrier preference.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">What if the user doesn't pick up?</summary>
        <p class="faq-a">Configurable retry policy — by default 2 retries (10s gap), then auto-fallback to SMS if you have it enabled. You only pay for connected calls; failed calls are free.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">Can I customize the OTP message?</summary>
        <p class="faq-a">Definitely — full message-template control. You can customise the intro, OTP digits, outro, and expiry mention. A/B testing tools are built in so you can see which variant converts best.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">How fast can I integrate?</summary>
        <p class="faq-a">5 minutes for the SDK install + sandbox testing. 30 minutes for production go-live with webhooks. We have ready-to-paste snippets for Node, Python, PHP, Java, Go, .NET — copy-paste and you're done.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">Do you support international numbers?</summary>
        <p class="faq-a">Yes — 250+ countries available on Business+ plans. International voice OTP routes through tier-1 global carriers. Pricing varies per country; full rate card on request.</p>
      </details>
      <details class="faq-item">
        <summary class="faq-q">What's the price per OTP?</summary>
        <p class="faq-a">From ৳0.45 per successful OTP on the Business plan, dropping to ৳0.38 at enterprise volume. <a href="/pricing" style="color:var(--blue);font-weight:700">See full pricing →</a></p>
      </details>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="final-cta">
  <div class="container">
    <div class="final-cta-inner">
      <span class="eyebrow" style="color:var(--gold)">Get Started</span>
      <h2>Stop losing customers to <span class="accent">undelivered SMS.</span></h2>
      <p>Drop voice OTP into your stack today. Free trial includes 200 verifications — enough to A/B test against your current SMS provider.</p>
      <div class="cta-row">
        <a class="btn btn-gold btn-lg" href="#">Get free API key →</a>
        <a class="btn btn-outline btn-lg" href="/api-docs">View documentation</a>
      </div>
      <div class="perks">
        <span>200 free OTPs</span>
        <span>No card required</span>
        <span>5-min setup</span>
        <span>Cancel anytime</span>
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
// Language tabs
(function(){
  var tabs = document.querySelectorAll('.lang-tab');
  var panes = document.querySelectorAll('.code-pane');
  tabs.forEach(function(t){
    t.addEventListener('click', function(){
      tabs.forEach(function(x){ x.classList.remove('active'); });
      panes.forEach(function(p){ p.classList.remove('active'); });
      t.classList.add('active');
      var lang = t.getAttribute('data-lang');
      document.querySelector('.code-pane[data-lang="'+lang+'"]').classList.add('active');
    });
  });
})();

// Scroll reveal
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
