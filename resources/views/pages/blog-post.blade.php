<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Article - Protiddhoni</title>
<meta name="description" content="Voice marketing, OTP, survey, and broadcast insights from Protiddhoni." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root{--navy:#003087;--blue:#0070BA;--sky:#009CDE;--gold:#FFC439;--ink:#0a1230;--ink2:#3a4566;--muted:#6b7593;--line:#e5e9f2;--bg:#f7f9fc;--white:#fff}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans','Hind Siliguri',system-ui,sans-serif;color:var(--ink);background:var(--bg);line-height:1.7;-webkit-font-smoothing:antialiased}
a{color:inherit;text-decoration:none}
.container{max-width:980px;margin:0 auto;padding:0 24px}
.nav{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.92);backdrop-filter:blur(20px);border-bottom:1px solid var(--line)}
.nav-inner{max-width:1240px;margin:0 auto;padding:16px 24px;display:flex;align-items:center;justify-content:space-between;gap:20px}
.logo{display:flex;align-items:center;gap:10px;font-weight:800;color:var(--navy);font-size:19px}
.logo-mark{width:36px;height:36px;border-radius:9px;background:linear-gradient(135deg,var(--navy),var(--blue));display:grid;place-items:center;color:#fff}
.nav-links{display:flex;gap:24px;align-items:center;font-size:14px;font-weight:700;color:var(--ink2)}
.nav-links a:hover,.nav-links a.active{color:var(--blue)}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:999px;font-weight:800;font-size:14px;border:1px solid var(--line)}
.btn-primary{background:var(--navy);color:#fff;border-color:var(--navy)}
.hero{padding:64px 0 34px;background:linear-gradient(180deg,#fff 0%,var(--bg) 100%)}
.pill{display:inline-flex;align-items:center;gap:8px;background:rgba(0,112,186,.10);border:1px solid rgba(0,112,186,.20);padding:7px 13px;border-radius:999px;font-size:12px;font-weight:800;color:var(--navy);letter-spacing:.04em;text-transform:uppercase}
h1{font-size:clamp(34px,6vw,58px);line-height:1.08;font-weight:800;color:var(--navy);margin-top:18px;letter-spacing:0}
.lede{font-size:18px;color:var(--ink2);margin-top:18px;max-width:760px}
.meta{display:flex;flex-wrap:wrap;gap:14px;margin-top:22px;color:var(--muted);font-size:13px;font-weight:700}
.cover{margin:36px 0 0;border-radius:18px;min-height:320px;background:linear-gradient(135deg,var(--navy),var(--blue),var(--sky));position:relative;overflow:hidden}
.cover:after{content:"";position:absolute;inset:0;background:radial-gradient(circle at 80% 20%,rgba(255,196,57,.28),transparent 42%),radial-gradient(circle at 20% 80%,rgba(255,255,255,.18),transparent 38%)}
.article{background:#fff;border-top:1px solid var(--line);padding:52px 0 84px}
.article-body{font-size:17px;color:var(--ink2)}
.article-body h2,.article-body h3{color:var(--navy);line-height:1.2;margin:32px 0 12px;font-weight:800;letter-spacing:0}
.article-body p{margin:0 0 18px}
.article-body ul,.article-body ol{margin:0 0 20px 22px}
.article-body a{color:var(--blue);font-weight:700}
.article-body img{max-width:100%;border-radius:12px}
.state{padding:80px 0;text-align:center;color:var(--muted);font-weight:700}
.footer{background:#06112d;color:#a8b1cf;padding:38px 0;font-size:13px}
.footer .container{display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap}
@media(max-width:820px){.nav-links{display:none}.cover{min-height:220px}.article{padding-top:36px}}

  .brand-logo-img{display:block;width:158px;height:auto;max-height:46px;object-fit:contain}
  .footer-brand .brand-logo-img,.footer .logo .brand-logo-img{width:172px;max-height:52px}
  @media(max-width:520px){.brand-logo-img{width:132px;max-height:40px}}</style>
</head>
<body>
<nav class="nav">
  <div class="nav-inner">
    <a class="logo" href="/"><img src="/assets/img/protiddhoni-logo.png" alt="Protiddhoni" class="brand-logo-img"></a>
    <div class="nav-links">
      <a href="/voice-otp">Voice OTP</a>
      <a href="/voice-survey">Surveys</a>
      <a href="/voice-broadcast">Broadcast</a>
      <a href="/pricing">Pricing</a>
      <a href="/api-docs">API Docs</a>
      <a href="/blog" class="active">Blog</a>
      <a href="/about">About</a>
    </div>
    <a class="btn btn-primary" href="/contact">Start free</a>
  </div>
</nav>

<main id="article-root">
  <section class="state">Loading article...</section>
</main>

<footer class="footer">
  <div class="container">
    <span>© 2026 Protiddhoni Ltd. All rights reserved.</span>
    <a href="/blog">Back to blog</a>
  </div>
</footer>

<script src="/assets/js/cms-client.js"></script>
<script>
(function () {
  const CMS_BASE = window.PROTIDDHONI_CMS_BASE || '/api';
  CMS.init({ base: CMS_BASE });

  const root = document.getElementById('article-root');
  const slug = new URLSearchParams(window.location.search).get('slug');

  function dateLabel(value) {
    if (!value) return '';
    return new Date(value).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
  }

  function render(post) {
    document.title = `${post.title} - Protiddhoni`;
    const category = post.category ? post.category.name : 'Article';
    const author = post.author ? post.author.name : 'Protiddhoni Team';
    const minutes = post.reading_minutes || 5;
    const coverStyle = post.featured_image_url
      ? `background-image:url('${post.featured_image_url}');background-size:cover;background-position:center`
      : 'background:linear-gradient(135deg,#003087,#0070BA,#009CDE)';

    root.innerHTML = `
      <section class="hero">
        <div class="container">
          <span class="pill">${category}</span>
          <h1>${post.title}</h1>
          <p class="lede">${post.excerpt || ''}</p>
          <div class="meta">
            <span>${dateLabel(post.published_at)}</span>
            <span>${minutes} min read</span>
            <span>${author}</span>
          </div>
          <div class="cover" style="${coverStyle}"></div>
        </div>
      </section>
      <section class="article">
        <div class="container article-body">${post.body || ''}</div>
      </section>
    `;
  }

  if (!slug) {
    root.innerHTML = '<section class="state">Article not found. <a href="/blog">Return to blog</a>.</section>';
    return;
  }

  CMS.fetchPost(slug)
    .then(({ data }) => render(data))
    .catch(() => {
      root.innerHTML = '<section class="state">Could not load this article. <a href="/blog">Return to blog</a>.</section>';
    });
})();
</script>
</body>
</html>


