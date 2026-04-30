@extends('layouts.frontend')

@section('title', 'API Documentation — Protiddhoni Voice Broadcasting')

@push('styles')
<style>
  :root{
    --navy:#003087;--blue:#0070BA;--sky:#009CDE;--gold:#FFC439;--cream:#FFF9E6;
    --ink:#0a1230;--ink2:#3a4566;--mute:#6b7593;--line:#e5e9f2;--bg:#f7f9fc;--white:#fff;
    --code-bg:#0a1230;--code-bg2:#0e1840;--code-text:#e5e9f2;
  }
  .hero{padding:60px 0 48px;background:linear-gradient(180deg,#fff 0%,var(--bg) 100%);border-bottom:1px solid var(--line)}
  .hero-grid{display:grid;grid-template-columns:1.2fr 1fr;gap:54px;align-items:center}
  .hero-code{background:var(--code-bg);border-radius:18px;box-shadow:0 24px 64px rgba(0,48,135,.18);overflow:hidden;border:1px solid rgba(255,255,255,.06)}
  .code-bar{background:var(--code-bg2);padding:12px 18px;display:flex;align-items:center;gap:8px;border-bottom:1px solid rgba(255,255,255,.06)}
  .hero-code pre{padding:22px;margin:0;color:var(--code-text);font-size:13px;line-height:1.75;overflow-x:auto;font-family:'JetBrains Mono',monospace}
  .docs-grid{display:grid;grid-template-columns:280px 1fr;gap:40px;align-items:start}
  .docs-side{position:sticky;top:90px;background:#fff;border-radius:16px;border:1px solid var(--line);padding:22px;max-height:calc(100vh - 110px);overflow-y:auto}
  .ds-section a{display:flex;align-items:center;gap:8px;padding:7px 10px;border-radius:8px;font-size:13px;color:var(--ink2);font-weight:600;margin-bottom:2px}
  .ds-section a:hover,.ds-section a.active{background:#eef3fb;color:var(--navy)}
  .docs-content{background:#fff;border-radius:16px;border:1px solid var(--line);padding:46px;box-shadow:0 8px 24px rgba(0,48,135,.10)}
  .endpoint{background:#f7f9fc;border:1px solid var(--line);border-left:4px solid var(--blue);padding:16px 20px;border-radius:10px;margin:18px 0;display:flex;align-items:center;gap:14px;flex-wrap:wrap}
  .params{width:100%;border-collapse:collapse;margin:18px 0;background:#fff;border:1px solid var(--line);border-radius:10px;overflow:hidden}
  .params th{background:#f1f4fb;text-align:left;padding:12px 16px;font-size:10px;font-weight:800;color:var(--ink);text-transform:uppercase}
  .params td{padding:14px 16px;font-size:13px;color:var(--ink2);border-top:1px solid var(--line)}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero pt-32">
  <div class="max-w-7xl mx-auto px-6 hero-grid">
    <div class="reveal">
      <span class="chip mb-4"><span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse mr-2"></span> {{ \App\Models\PageBlock::value('api-docs.hero.pill', 'Protiddhoni API · v1.0 · Stable') }}</span>
      <h1 class="text-5xl font-extrabold text-navy-900 leading-tight">
        {!! \App\Models\PageBlock::value('api-docs.hero.headline', 'Voice broadcasting API <span class="text-gradient">for Bangladesh.</span>') !!}
      </h1>
      <p class="mt-6 text-lg text-ink-500 max-w-xl leading-relaxed">
        {!! \App\Models\PageBlock::value('api-docs.hero.subhead', 'Send Voice OTPs, run multi-number broadcasts, and pull results over a clean REST API.') !!}
      </p>
      <div class="mt-8 flex flex-wrap gap-3">
        <a class="btn-primary" href="#authentication">Quickstart →</a>
        <a class="btn-outline" href="{{ url('/contact') }}">Get API token</a>
      </div>
    </div>
    <div class="hero-code reveal">
      <div class="code-bar">
        <div class="flex gap-1.5"><i class="w-2.5 h-2.5 rounded-full bg-red-400"></i><i class="w-2.5 h-2.5 rounded-full bg-yellow-400"></i><i class="w-2.5 h-2.5 rounded-full bg-green-400"></i></div>
        <div class="ml-4 text-[10px] font-bold text-ink-300">send-otp.sh</div>
      </div>
<pre>curl -X POST https://api.protiddhoni.com/api/broadcasts/otp \
  -H "Authorization: Bearer $TOKEN" \
  -d '{
    "voice": "otp_voice_bn",
    "phone_number": "01712345678",
    "otp_code": "8429"
  }'</pre>
    </div>
  </div>
</section>

<!-- DOCS -->
<section class="py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="docs-grid">
      <aside class="docs-side reveal">
        <div class="ds-section mb-6">
          <h5 class="text-[10px] font-bold text-ink-300 uppercase tracking-widest mb-4">Getting started</h5>
          <a href="#overview" class="active">Overview</a>
          <a href="#authentication">Authentication</a>
        </div>
        <div class="ds-section mb-6">
          <h5 class="text-[10px] font-bold text-ink-300 uppercase tracking-widest mb-4">Broadcasts</h5>
          <a href="#otp-broadcast">OTP broadcast</a>
          <a href="#broadcast-multiple">Multi-number broadcast</a>
        </div>
      </aside>

      <article class="docs-content reveal">
        <h2 id="overview" class="text-3xl font-extrabold text-navy-900 mb-4">Overview</h2>
        <p class="text-ink-500 mb-8">The Protiddhoni API powers voice automation across Bangladesh. All requests are made over HTTPS to <code>api.protiddhoni.com/api</code>, authenticated via a Bearer token.</p>

        <h2 id="authentication" class="text-2xl font-extrabold text-navy-900 mt-12 mb-4">Authentication</h2>
        <p class="text-ink-500 mb-6">All API requests require a Bearer token in the <code>Authorization</code> header.</p>
        <div class="bg-yellow-50 border-l-4 border-paypal-gold p-4 rounded-r-xl mb-8">
          <p class="text-xs text-ink-700"><strong>⚠ Important:</strong> keep your API token secure and never share it publicly.</p>
        </div>

        <h2 id="otp-broadcast" class="text-2xl font-extrabold text-navy-900 mt-12 mb-4">Voice OTP broadcast</h2>
        <div class="endpoint">
          <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-bold">POST</span>
          <code class="text-xs font-bold">/api/broadcasts/otp</code>
        </div>
        <p class="text-ink-500 mb-6">Single-recipient OTP delivery.</p>

        <table class="params">
          <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
          <tbody>
            <tr><td><code>voice</code></td><td>string</td><td>Name of approved voice.</td></tr>
            <tr><td><code>phone_number</code></td><td>string</td><td>Recipient — <code>01XXXXXXXXX</code>.</td></tr>
            <tr><td><code>otp_code</code></td><td>string</td><td>The code to read out.</td></tr>
          </tbody>
        </table>
      </article>
    </div>
  </div>
</section>
@endsection
