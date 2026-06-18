@php
    use App\Models\PageSeo;
    $seo = PageSeo::for($seoPage ?? 'homepage');
    $title = $seo->title ?: trim($__env->yieldContent('title', 'VoiceReach — Voice Broadcasting for Bangladesh'));
    $description = $seo->meta_description ?: trim($__env->yieldContent('description', ''));
    $ogTitle = $seo->og_title ?: $title;
    $ogImage = $seo->og_image
        ? (\Illuminate\Support\Str::startsWith($seo->og_image, ['http://', 'https://']) ? $seo->og_image : \Illuminate\Support\Facades\Storage::disk('public')->url($seo->og_image))
        : null;
@endphp
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}" />
@if($seo->canonical_url)<link rel="canonical" href="{{ $seo->canonical_url }}">@endif

{{-- Open Graph / social --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ url()->current() }}">
@if($ogImage)<meta property="og:image" content="{{ $ogImage }}">@endif
<meta name="twitter:card" content="{{ $ogImage ? 'summary_large_image' : 'summary' }}">

<link rel="icon" href="{{ asset('favicon.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Hind+Siliguri:wght@500;700&display=swap" rel="stylesheet">
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
  .bn{font-family:'Hind Siliguri',sans-serif}
  .container{max-width:1240px;margin:0 auto;padding:0 32px}

  /* NAV */
  .navbar{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.85);backdrop-filter:blur(20px);border-bottom:1px solid var(--line)}
  .nav-inner{display:flex;align-items:center;justify-content:space-between;padding:16px 32px;max-width:1240px;margin:0 auto}
  .logo{display:flex;align-items:center;gap:8px;font-weight:800;letter-spacing:-.5px;font-size:18px}
  .logo-dot{width:11px;height:11px;background:linear-gradient(135deg,var(--sky),var(--gold));border-radius:50%;box-shadow:0 0 0 3px rgba(0,156,222,.15)}
  .nav-links{display:flex;gap:28px;font-size:14px;color:var(--slate);font-weight:500}
  .nav-links a{transition:color .2s}
  .nav-links a:hover{color:var(--blue)}
  .nav-cta{display:flex;gap:10px;align-items:center}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:10px;font-weight:600;font-size:13px;transition:all .2s}
  .btn-ghost{color:var(--slate)}
  .btn-ghost:hover{color:var(--blue)}
  .btn-primary{background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;box-shadow:0 8px 20px -8px rgba(0,48,135,.5)}
  .btn-primary:hover{transform:translateY(-1px);box-shadow:0 12px 28px -8px rgba(0,48,135,.6)}
  .btn-outline{background:#fff;color:var(--navy);border:1.5px solid #d4dae8}
  .btn-outline:hover{border-color:var(--blue);color:var(--blue)}
  .btn-gold{background:linear-gradient(135deg,#FFC439,#f59e0b);color:var(--ink)}

  /* HERO */
  .hero{background:linear-gradient(180deg,#fff7e6 0%,#fff 25%,#f0f4ff 65%,#e8eef9 100%);position:relative;overflow:hidden}
  .hero-grid{display:grid;grid-template-columns:1fr 1.18fr;gap:48px;padding:56px 0 48px;align-items:center}
  .hero-h1{font-size:60px;font-weight:800;letter-spacing:-2px;line-height:1.02;color:var(--ink)}
  .hero-h1 .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .hero-sub{font-size:16px;color:#4a5675;line-height:1.65;max-width:500px;margin-top:20px}
  .hero-sub strong{color:var(--ink)}
  .status-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(34,197,94,.1);color:#15803d;padding:8px 14px;border-radius:999px;font-size:11px;font-weight:700;letter-spacing:.5px;border:1px solid rgba(34,197,94,.25);margin-bottom:18px;text-transform:uppercase}
  .live-dot{display:inline-block;width:6px;height:6px;border-radius:50%;background:var(--green);box-shadow:0 0 8px var(--green);animation:pulse 1.6s infinite}
  @keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.3);opacity:.6}}

  .call-stream{margin-top:26px;display:flex;flex-direction:column;gap:8px;max-width:400px}
  .call-card{background:#fff;border:1px solid var(--line);border-radius:12px;padding:11px 14px;display:flex;align-items:center;gap:11px;box-shadow:0 4px 14px rgba(0,48,135,.06);font-size:12px;animation:cardSlide .7s ease-out backwards}
  .call-card:nth-child(1){animation-delay:.2s}
  .call-card:nth-child(2){animation-delay:1s}
  .call-card:nth-child(3){animation-delay:1.8s}
  @keyframes cardSlide{from{transform:translateX(-16px);opacity:0}to{transform:translateX(0);opacity:1}}
  .cc-icon{width:32px;height:32px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
  .cc-meta{font-size:10px;color:var(--muted);margin-top:1px;font-family:'JetBrains Mono',monospace}
  .cc-status{font-weight:700;font-size:10px;letter-spacing:.5px;margin-left:auto}

  .cta-row{display:flex;gap:10px;margin-top:26px;align-items:center;flex-wrap:wrap}
  .btn-lg{padding:14px 24px;font-size:14px}
  .trust-strip{display:flex;align-items:center;gap:12px;margin-top:22px;color:var(--muted);font-size:11px;font-weight:500}
  .stars{color:var(--gold);letter-spacing:1.5px}

  .hero-right{position:relative;height:640px}
  .bd-map-full{width:100%;height:100%;display:block}

  /* Real BD district SVG (64 districts, brand-tinted) */
  .bd-map-frame{position:relative;width:100%;height:100%;display:flex;align-items:center;justify-content:center}
  .bd-map-glow{position:absolute;width:78%;height:78%;left:11%;top:11%;border-radius:50%;background:radial-gradient(circle at 50% 50%,rgba(255,196,57,.32) 0%,rgba(0,112,186,.18) 45%,transparent 75%);filter:blur(36px);z-index:0;pointer-events:none}
  .bd-svg-real{position:relative;width:auto;height:100%;max-width:100%;display:block;z-index:1;filter:drop-shadow(0 18px 36px rgba(0,48,135,.18))}
  .bd-svg-real path{transition:fill .35s ease,opacity .35s ease}
  .bd-svg-real path:hover{filter:brightness(1.12);cursor:pointer}
  .bd-map-overlay{position:absolute;top:0;left:50%;transform:translateX(-50%);height:100%;width:auto;aspect-ratio:1530/2138;z-index:2;pointer-events:none}

  .bd-stat{position:absolute;background:rgba(255,255,255,.94);backdrop-filter:blur(20px);border:1px solid rgba(0,48,135,.08);border-radius:14px;padding:11px 14px;box-shadow:0 16px 32px -10px rgba(0,48,135,.18);min-width:150px;animation:floatY 4s ease-in-out infinite}
  @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
  .bd-stat.s1{top:4%;left:-2%}
  .bd-stat.s2{top:38%;right:-3%;animation-delay:1.3s}
  .bd-stat.s3{bottom:24%;left:6%;animation-delay:2.6s}
  .bd-stat-eyebrow{font-size:9px;letter-spacing:1.5px;color:var(--navy);font-weight:800;text-transform:uppercase}
  .bd-stat-num{font-family:'JetBrains Mono',monospace;font-size:22px;font-weight:800;color:var(--ink)}

  .country-badge{position:absolute;bottom:8px;right:6px;background:linear-gradient(135deg,var(--gold),#f59e0b);color:var(--ink);padding:14px 18px;border-radius:14px;text-align:center;box-shadow:0 16px 32px -10px rgba(245,158,11,.45)}
  .country-badge .big{font-size:30px;font-family:'JetBrains Mono',monospace;letter-spacing:-1px;font-weight:800;line-height:1;margin:4px 0}
  .country-badge .lbl{font-size:9px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(10,18,48,.7);font-weight:800}

  /* Carrier strip */
  .carrier-strip-wrap{background:var(--ink);color:#fff;padding:24px 0;margin-top:32px}
  .carrier-strip{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-bottom:14px}
  .carrier-name{font-size:12px;font-weight:700}
  .carrier-bar{height:4px;background:rgba(255,255,255,.08);border-radius:2px;overflow:hidden;margin-top:6px}
  .carrier-fill{height:100%;background:linear-gradient(90deg,var(--sky),var(--gold));border-radius:2px}
  .marquee-wrap{padding:10px 14px;border:1px dashed rgba(255,196,57,.3);border-radius:8px;overflow:hidden}
  .marquee{font-size:11px;color:rgba(255,255,255,.7);display:flex;gap:24px;white-space:nowrap;animation:scrollM 32s linear infinite;font-weight:600;letter-spacing:.5px}
  @keyframes scrollM{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
  .marquee span::before{content:"●  ";color:var(--gold);font-size:8px}

  /* SECTION DEFAULTS */
  section{padding:96px 0}
  .section-head{text-align:center;max-width:720px;margin:0 auto 56px}
  .eyebrow{display:inline-block;font-size:11px;letter-spacing:2.5px;text-transform:uppercase;font-weight:800;color:var(--blue);margin-bottom:14px}
  h2.section-title{font-size:42px;font-weight:800;letter-spacing:-1.5px;line-height:1.1;color:var(--ink)}
  h2.section-title .accent{background:linear-gradient(90deg,var(--navy),var(--blue));-webkit-background-clip:text;background-clip:text;color:transparent}
  .section-sub{font-size:17px;color:#4a5675;margin-top:14px;line-height:1.6}

  /* STATS BANNER */
  .stats-banner{padding:48px 0;background:linear-gradient(135deg,var(--navy),var(--blue));color:#fff;position:relative;overflow:hidden}
  .stats-banner::before{content:"";position:absolute;inset:0;background:radial-gradient(800px 300px at 80% 50%,rgba(255,196,57,.15),transparent),radial-gradient(600px 300px at 10% 50%,rgba(0,156,222,.2),transparent)}
  .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:32px;position:relative;z-index:1}
  .stat-item{text-align:center;border-right:1px solid rgba(255,255,255,.1);padding:0 20px}
  .stat-item:last-child{border-right:none}
  .stat-num-big{font-family:'JetBrains Mono',monospace;font-size:48px;font-weight:800;letter-spacing:-2px;line-height:1;background:linear-gradient(180deg,#fff,#FFC439);-webkit-background-clip:text;background-clip:text;color:transparent}
  .stat-lbl{font-size:12px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.6);margin-top:10px;font-weight:700}

  /* SERVICES */
  .services{background:#fff}
  .service-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  .service-card{padding:36px;border-radius:24px;border:1px solid var(--line);background:#fff;transition:all .3s;position:relative;overflow:hidden}
  .service-card:hover{transform:translateY(-4px);box-shadow:0 30px 60px -20px rgba(0,48,135,.18);border-color:transparent}
  .service-card::before{content:"";position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--sky),var(--gold));transform:scaleX(0);transform-origin:left;transition:transform .3s}
  .service-card:hover::before{transform:scaleX(1)}
  .service-icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:20px}
  .service-icon.otp{background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:var(--navy)}
  .service-icon.survey{background:linear-gradient(135deg,#fef3c7,#fde68a);color:#a16207}
  .service-icon.broadcast{background:linear-gradient(135deg,#dcfce7,#bbf7d0);color:#15803d}
  .service-card h3{font-size:22px;font-weight:800;letter-spacing:-.5px;margin-bottom:10px}
  .service-card p{color:var(--muted);font-size:14px;line-height:1.6;margin-bottom:18px}
  .service-features{list-style:none;display:flex;flex-direction:column;gap:8px;margin-bottom:20px}
  .service-features li{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--slate)}
  .service-features li::before{content:"✓";color:var(--green);font-weight:800;flex-shrink:0}
  .service-link{display:inline-flex;align-items:center;gap:6px;color:var(--blue);font-weight:700;font-size:13px;border-bottom:1.5px solid transparent;transition:border-color .2s}
  .service-link:hover{border-color:var(--blue)}

  /* HOW IT WORKS */
  .how{background:#f8fafc}
  .steps-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;position:relative}
  .steps-grid::before{content:"";position:absolute;top:32px;left:8%;right:8%;height:2px;background:repeating-linear-gradient(90deg,var(--blue) 0,var(--blue) 6px,transparent 6px,transparent 12px);z-index:0}
  .step{position:relative;text-align:center;padding:0 12px;z-index:1}
  .step-num{width:64px;height:64px;border-radius:50%;background:#fff;border:3px solid var(--blue);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:800;color:var(--blue);margin:0 auto 18px;font-family:'JetBrains Mono',monospace;box-shadow:0 8px 24px -8px rgba(0,112,186,.4)}
  .step h4{font-size:17px;font-weight:800;margin-bottom:8px;letter-spacing:-.3px}
  .step p{font-size:13px;color:var(--muted);line-height:1.55}

  /* USE CASES */
  .use-cases{background:#fff}
  .industries{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
  .industry{padding:28px;border-radius:18px;border:1px solid var(--line);transition:all .3s;background:#fff;position:relative}
  .industry:hover{transform:translateY(-3px);border-color:var(--blue);box-shadow:0 20px 40px -16px rgba(0,48,135,.15)}
  .ind-icon{font-size:28px;margin-bottom:14px}
  .industry h4{font-size:17px;font-weight:800;margin-bottom:8px;letter-spacing:-.3px}
  .industry p{font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:14px}
  .ind-tag{display:inline-block;background:rgba(0,112,186,.08);color:var(--navy);padding:4px 10px;border-radius:6px;font-size:10px;font-weight:700;letter-spacing:.5px}

  /* TESTIMONIALS */
  .testimonials{background:linear-gradient(180deg,#f8fafc 0%,#fff 100%)}
  .logos-strip{display:flex;justify-content:center;align-items:center;gap:48px;flex-wrap:wrap;margin-bottom:64px;opacity:.65}
  .logos-strip span{font-weight:800;font-size:18px;color:var(--slate);letter-spacing:-.5px}
  .testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
  .testi-card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:28px;position:relative}
  .testi-quote{font-size:14px;color:var(--ink);line-height:1.7;font-weight:500;margin-bottom:24px}
  .testi-author{display:flex;align-items:center;gap:12px}
  .testi-avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--sky));display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:14px;flex-shrink:0}
  .testi-name{font-weight:800;font-size:13px}
  .testi-role{font-size:11px;color:var(--muted);margin-top:1px}
  .testi-mark{font-size:48px;color:var(--gold);line-height:.5;margin-bottom:8px;font-family:Georgia,serif;font-weight:700}

  /* PRICING PREVIEW */
  .pricing-preview{background:#fff}
  .pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:1080px;margin:0 auto}
  .price-card{background:#fff;border:1.5px solid var(--line);border-radius:22px;padding:36px 28px;position:relative;transition:all .3s}
  .price-card.featured{background:linear-gradient(180deg,var(--ink),#1a2350);color:#fff;border-color:var(--gold);transform:scale(1.04);box-shadow:0 30px 60px -20px rgba(10,18,48,.4)}
  .price-card.featured .price-name{color:#FFC439}
  .price-card.featured .price-feat{color:rgba(255,255,255,.85)}
  .price-card.featured .price-feat::before{color:var(--gold)}
  .price-badge{position:absolute;top:-14px;left:50%;transform:translateX(-50%);background:var(--gold);color:var(--ink);padding:6px 14px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:1px;text-transform:uppercase}
  .price-name{font-size:14px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;color:var(--blue);margin-bottom:14px}
  .price-amount{display:flex;align-items:baseline;gap:6px;margin-bottom:6px}
  .price-tk{font-family:'JetBrains Mono',monospace;font-size:44px;font-weight:800;letter-spacing:-2px;line-height:1}
  .price-suffix{font-size:14px;color:var(--muted);font-weight:500}
  .price-card.featured .price-suffix{color:rgba(255,255,255,.6)}
  .price-desc{font-size:13px;color:var(--muted);margin-bottom:24px;line-height:1.5}
  .price-card.featured .price-desc{color:rgba(255,255,255,.7)}
  .price-features{list-style:none;display:flex;flex-direction:column;gap:10px;margin-bottom:28px}
  .price-feat{font-size:13px;color:var(--slate);display:flex;align-items:flex-start;gap:8px}
  .price-feat::before{content:"✓";color:var(--green);font-weight:800;flex-shrink:0}

  /* INTEGRATIONS */
  .integrations{background:linear-gradient(180deg,#f8fafc,#fff)}
  .int-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:48px;align-items:center}
  .code-block{background:var(--ink);color:#e0f2fe;padding:28px;border-radius:18px;font-family:'JetBrains Mono',monospace;font-size:13px;line-height:1.7;overflow-x:auto;border:1px solid #1a2350;position:relative}
  .code-tag{position:absolute;top:14px;right:14px;background:rgba(255,255,255,.06);padding:4px 10px;border-radius:6px;font-size:10px;font-weight:700;color:var(--gold);letter-spacing:1px}
  .code-block .k{color:#FFC439}
  .code-block .s{color:#7eb8e0}
  .code-block .c{color:#64748b;font-style:italic}
  .integ-logos{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:24px}
  .integ-logo{padding:14px;border:1px solid var(--line);border-radius:12px;text-align:center;font-weight:700;font-size:13px;color:var(--slate);background:#fff;transition:all .2s}
  .integ-logo:hover{border-color:var(--blue);color:var(--blue);transform:translateY(-2px)}

  /* FAQ */
  .faq{background:#fff}
  .faq-grid{max-width:820px;margin:0 auto}
  .faq-item{border-bottom:1px solid var(--line);padding:20px 0}
  .faq-q{display:flex;justify-content:space-between;align-items:center;cursor:pointer;font-weight:700;font-size:16px;letter-spacing:-.2px;list-style:none}
  .faq-q::-webkit-details-marker{display:none}
  .faq-q::after{content:"+";font-size:24px;font-weight:300;color:var(--blue);transition:transform .2s;flex-shrink:0;margin-left:16px}
  .faq-item[open] .faq-q::after{content:"−"}
  .faq-a{color:var(--muted);font-size:14px;line-height:1.7;margin-top:12px;max-width:680px}

  /* FINAL CTA */
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
    .hero-h1{font-size:42px}
    .hero-right{height:480px}
    .stats-grid{grid-template-columns:repeat(2,1fr);gap:24px}
    .stat-item{border-right:none}
    .service-grid,.steps-grid,.industries,.testi-grid,.pricing-grid{grid-template-columns:1fr}
    .price-card.featured{transform:none}
    .int-grid{grid-template-columns:1fr}
    .footer-grid{grid-template-columns:repeat(2,1fr)}
    .final-cta h2{font-size:32px}
    h2.section-title{font-size:30px}
    .stat-num-big{font-size:36px}
    .steps-grid::before{display:none}
    section{padding:64px 0}
  }

  /* SCROLL REVEAL */
  .reveal{opacity:0;transform:translateY(20px);transition:opacity .8s ease-out,transform .8s ease-out}
  .reveal.in{opacity:1;transform:translateY(0)}
</style>
@stack('styles')
</head>
<body>

<!-- NAV -->
<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ url('/') }}" class="logo"><span class="logo-dot"></span> {{ block('global.brand.name', 'VoiceReach') }}</a>
    <div class="nav-links">
      <a href="{{ url('/voice-otp') }}">Voice OTP</a>
      <a href="{{ url('/voice-survey') }}">Surveys</a>
      <a href="{{ url('/voice-broadcast') }}">Broadcast</a>
      <a href="{{ url('/pricing') }}">Pricing</a>
      <a href="{{ url('/api-docs') }}">API Docs</a>
      <a href="{{ url('/blog') }}">Blog</a>
      <a href="{{ url('/about') }}">About</a>
    </div>
    <div class="nav-cta">
      <a class="btn btn-ghost" href="{{ block('global.cta.signin_url', url('/admin')) }}">Sign in</a>
      <a class="btn btn-primary" href="{{ block('global.cta.signup_url', url('/contact')) }}">Start free →</a>
    </div>
  </div>
</nav>

@yield('content')

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand"><span class="logo-dot"></span> {{ block('global.brand.name', 'VoiceReach') }}</div>
        <p class="footer-tagline">{!! block('global.footer.about', "Bangladesh's most reliable voice broadcasting platform. Reaching every district, every upazila, every customer.") !!}</p>
        <div class="footer-social">
          <a href="#" aria-label="Facebook">f</a>
          <a href="#" aria-label="LinkedIn">in</a>
          <a href="#" aria-label="Twitter">𝕏</a>
          <a href="#" aria-label="YouTube">▶</a>
        </div>
      </div>
      <div class="footer-col">
        <h5>Products</h5>
        <ul>
          <li><a href="{{ url('/voice-otp') }}">Voice OTP</a></li>
          <li><a href="{{ url('/voice-survey') }}">Voice Survey</a></li>
          <li><a href="{{ url('/voice-broadcast') }}">Voice Broadcast</a></li>
          <li><a href="{{ url('/api-docs') }}">Developer API</a></li>
          <li><a href="#">SDKs</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Solutions</h5>
        <ul>
          <li><a href="#">Banking &amp; MFS</a></li>
          <li><a href="#">E-commerce</a></li>
          <li><a href="#">Healthcare</a></li>
          <li><a href="#">Education</a></li>
          <li><a href="#">Government &amp; NGO</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Company</h5>
        <ul>
          <li><a href="{{ url('/about') }}">About us</a></li>
          <li><a href="{{ url('/blog') }}">Blog</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="{{ url('/contact') }}">Contact</a></li>
          <li><a href="#">Press kit</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Resources</h5>
        <ul>
          <li><a href="{{ url('/api-docs') }}">API Reference</a></li>
          <li><a href="{{ url('/pricing') }}">Pricing</a></li>
          <li><a href="#">Status page</a></li>
          <li><a href="#">Compliance</a></li>
          <li><a href="{{ url('/user-guide') }}">Help center</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bot">
      <div>© {{ date('Y') }} Protiddhoni Ltd. · Built with ❤️ in Dhaka, Bangladesh</div>
      <div class="footer-bot-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Security</a>
        <a href="#">Cookies</a>
      </div>
    </div>
  </div>
</footer>

<script>
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

{{-- CMS client: hydrates [data-cms*] elements from the DB-backed API and wires contact/newsletter forms. --}}
<script>window.PROTIDDHONI_CMS_BASE = "{{ url('/api') }}";</script>
<script src="{{ asset('assets/js/cms-client.js') }}"></script>
<script>CMS.init({ base: window.PROTIDDHONI_CMS_BASE, page: @json($cmsPage ?? null) });</script>

@stack('scripts')
</body>
</html>
