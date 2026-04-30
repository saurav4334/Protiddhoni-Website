@extends('layouts.frontend')

@section('title', 'Voice Broadcast — Reach lakhs across Bangladesh in minutes | VoiceReach')

@push('styles')
<style>
  :root{
    --navy:#003087;--blue:#0070BA;--sky:#009CDE;--gold:#FFC439;--cream:#FFF9E6;
    --ink:#0a1230;--ink2:#3a4566;--mute:#6b7593;--line:#e5e9f2;--bg:#f7f9fc;--white:#fff;
  }
  .hero{padding:60px 0 64px;position:relative;overflow:hidden;background:
    radial-gradient(900px 500px at 0% 0%,rgba(0,156,222,.12),transparent),
    radial-gradient(700px 400px at 100% 0%,rgba(255,196,57,.10),transparent),
    linear-gradient(180deg,#fff 0%,var(--bg) 100%)}
  .hero-grid{display:grid;grid-template-columns:1.05fr 1fr;gap:54px;align-items:center}
  @media(max-width:980px){
    .hero-grid{grid-template-columns:1fr;text-align:center}
    .hero-grid .max-w-xl{margin-left:auto;margin-right:auto}
    .hero-grid .flex-wrap{justify-content:center}
  }
  .broadcast-vis{position:relative;background:linear-gradient(135deg,var(--navy),var(--blue));border-radius:24px;padding:32px;color:#fff;box-shadow:0 24px 64px rgba(0,48,135,.18);overflow:hidden;min-height:520px}
  .bv-row{display:grid;grid-template-columns:auto 1fr auto;gap:12px;align-items:center;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);border-radius:12px;padding:11px 14px;backdrop-filter:blur(8px);font-size:12.5px;font-weight:600;margin-bottom:10px}
  .bv-flag{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--gold),#fff);color:var(--navy);display:grid;place-items:center;font-size:13px;font-weight:800;flex-shrink:0}
  .bv-bar{height:6px;background:rgba(255,255,255,.15);border-radius:3px;overflow:hidden}
  .bv-bar i{display:block;height:100%;background:linear-gradient(90deg,var(--gold),#fff);border-radius:3px;}
  .bv-pct{font-family:'JetBrains Mono',monospace;color:var(--gold);font-weight:800;font-size:13px;min-width:46px;text-align:right}
  .comp-mock{background:#fff;border-radius:20px;box-shadow:0 24px 64px rgba(0,48,135,.18);overflow:hidden;border:1px solid var(--line)}
  .comp-bar{background:#06112d;color:#fff;padding:14px 18px;display:flex;align-items:center;gap:10px;font-size:13px;font-weight:700}
  .comp-body{padding:24px}
  .comp-pill{display:inline-flex;align-items:center;gap:6px;padding:5px 10px;border-radius:999px;background:rgba(0,156,222,.12);color:var(--navy);font-size:11.5px;font-weight:700;margin-right:6px;margin-bottom:6px}
  .comp-script{background:#f7f9fc;border:1.5px dashed var(--blue);border-radius:10px;padding:14px;font-size:13.5px;color:var(--ink);line-height:1.65;position:relative}
  .comp-input{width:100%;padding:11px 14px;border:1.5px solid var(--line);border-radius:10px;font-size:13.5px;color:var(--ink);background:#f7f9fc}
  .dash-mock{background:#fff;border-radius:20px;box-shadow:0 24px 64px rgba(0,48,135,.18);border:1px solid var(--line);overflow:hidden;margin-top:30px}
  .dash-bar{background:#06112d;color:#fff;padding:16px 22px;display:flex;align-items:center;justify-content:space-between}
  .kpi{background:#f7f9fc;border:1px solid var(--line);border-radius:14px;padding:18px}
  .comp-rule{background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);border-radius:14px;padding:18px 20px;backdrop-filter:blur(6px);display:flex;gap:14px;align-items:center;margin-bottom:12px;}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero pt-32">
  <div class="max-w-7xl mx-auto px-6 hero-grid">
    <div class="reveal">
      <span class="chip mb-4"><span class="w-2 h-2 rounded-full bg-paypal-sky animate-pulse inline-block mr-2"></span> {{ \App\Models\PageBlock::value('voice-broadcast.hero.pill', 'Live now · 12,400 broadcasts running across BD') }}</span>
      <h1 class="text-5xl font-extrabold text-ink-900 leading-tight">
        {!! \App\Models\PageBlock::value('voice-broadcast.hero.headline', 'Reach lakhs of customers <span class="text-gradient">in one announcement.</span>') !!}
      </h1>
      <p class="mt-6 text-lg text-ink-500 max-w-xl leading-relaxed">
        {!! \App\Models\PageBlock::value('voice-broadcast.hero.subhead', 'Voice broadcasts that ring on every BD carrier — Bangla or English — with smart pacing and live analytics.') !!}
      </p>
      <div class="mt-8 flex flex-wrap gap-3">
        <a class="btn-primary" href="{{ url('/admin/register') }}">Start a broadcast →</a>
        <a class="btn-outline" href="{{ url('/pricing') }}">See pricing</a>
      </div>
      <div class="mt-10 flex flex-wrap gap-8 text-sm font-bold text-ink-500">
        <span>📡 4 BD carriers</span>
        <span>🇧🇩 64 districts</span>
        <span>🛡 BTRC compliant</span>
      </div>
    </div>

    <!-- Broadcast visual -->
    <div class="relative reveal">
      <div class="broadcast-vis">
        <div class="flex justify-between items-center mb-6">
          <div class="text-sm font-bold opacity-80">📢 Eid sale broadcast · running</div>
          <span class="chip-sky chip"><span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> LIVE</span>
        </div>

        <!-- Live delivery rows -->
        <div class="space-y-3">
          <div class="bv-row">
            <div class="bv-flag">GP</div>
            <div class="flex-1 px-4">
              <div class="text-[10px] opacity-70 mb-1">Grameenphone · Dhaka, Chattogram</div>
              <div class="bv-bar"><i style="width:88%"></i></div>
            </div>
            <div class="bv-pct">88%</div>
          </div>
          <div class="bv-row">
            <div class="bv-flag" style="background:linear-gradient(135deg,#ff3a3a,#fff)">RB</div>
            <div class="flex-1 px-4">
              <div class="text-[10px] opacity-70 mb-1">Robi · 22 districts active</div>
              <div class="bv-bar"><i style="width:74%"></i></div>
            </div>
            <div class="bv-pct">74%</div>
          </div>
          <div class="bv-row">
            <div class="bv-flag" style="background:linear-gradient(135deg,#ffc439,#fff)">BL</div>
            <div class="flex-1 px-4">
              <div class="text-[10px] opacity-70 mb-1">Banglalink · Pacing 1,200/sec</div>
              <div class="bv-bar"><i style="width:62%"></i></div>
            </div>
            <div class="bv-pct">62%</div>
          </div>
        </div>
      </div>

      <div class="absolute -top-6 -right-6 card px-4 py-3 shadow-xl float-1">
        <div class="text-xl font-extrabold text-paypal-navy">2,84,621</div>
        <div class="text-[10px] text-ink-500 font-bold uppercase">Calls placed</div>
      </div>
    </div>
  </div>
</section>

<!-- COMPOSER MOCKUP -->
<section class="py-24 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
    <div class="reveal">
      <span class="chip mb-4">Visual composer</span>
      <h2 class="text-4xl font-extrabold text-ink-900 leading-tight mb-6">{{ \App\Models\PageBlock::value('voice-broadcast.composer.headline', 'A composer that writes like you talk — in Bangla.') }}</h2>
      <p class="text-ink-500 mb-8 leading-relaxed">{{ \App\Models\PageBlock::value('voice-broadcast.composer.subhead', 'Drag a placeholder, hear the TTS, set the carrier mix. The composer is in Bangla and English side by side — no awkward translation, no clipped pronunciation.') }}</p>
      <ul class="space-y-4">
        <li class="flex items-center gap-3 text-sm font-semibold text-ink-700">
          <span class="w-6 h-6 rounded-full bg-paypal-blue/10 text-paypal-blue flex items-center justify-center text-xs">✓</span>
          12 native Bangla voices (male/female)
        </li>
        <li class="flex items-center gap-3 text-sm font-semibold text-ink-700">
          <span class="w-6 h-6 rounded-full bg-paypal-blue/10 text-paypal-blue flex items-center justify-center text-xs">✓</span>
          Code-mixed Banglish with correct pronunciation
        </li>
      </ul>
    </div>

    <div class="comp-mock reveal">
      <div class="comp-bar">
        <div class="w-2 h-2 rounded-full bg-red-400"></div>
        <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
        <div class="w-2 h-2 rounded-full bg-green-400"></div>
        <span class="ml-4 opacity-80">VoiceReach Composer</span>
      </div>
      <div class="comp-body">
        <div class="flex gap-4 border-b border-surface-200 mb-6">
          <span class="text-xs font-bold text-paypal-blue border-b-2 border-paypal-blue pb-2">📝 Script</span>
          <span class="text-xs font-bold text-ink-300 pb-2">🎯 Audience</span>
          <span class="text-xs font-bold text-ink-300 pb-2">⏰ Schedule</span>
        </div>
        <div class="space-y-4">
          <div>
            <label class="text-[10px] font-bold text-ink-300 uppercase block mb-2">Voice</label>
            <span class="comp-pill">🎙 Tahmina · Bangla female</span>
          </div>
          <div>
            <label class="text-[10px] font-bold text-ink-300 uppercase block mb-2">Script (Bangla)</label>
            <div class="comp-script">
              Assalamu alaikum, <span class="bg-paypal-gold/30 px-1 rounded font-bold">@{{name}}</span>! Calling from VoiceReach. For Eid we have a special offer — <span class="bg-paypal-gold/30 px-1 rounded font-bold">@{{discount}}</span>% off.
            </div>
          </div>
        </div>
      </div>
      <div class="bg-surface-50 p-4 border-t border-surface-200 flex justify-between items-center">
        <div class="text-[10px] text-ink-500 font-bold">Estimated cost · <b class="text-ink-900 text-sm">৳ 2.84L</b></div>
        <button class="btn-gold !py-1.5 !px-4 !text-xs">Schedule →</button>
      </div>
    </div>
  </div>
</section>

<!-- COMPLIANCE -->
<section class="py-24 bg-ink-900 text-white relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
    <div class="reveal text-center lg:text-left">
      <span class="chip !bg-paypal-gold/20 !text-paypal-gold mb-4">BTRC compliant</span>
      <h2 class="text-4xl font-extrabold mb-6">Stay legal. <span class="text-paypal-gold">Don't think about it.</span></h2>
      <p class="text-ink-300 leading-relaxed mb-8">We bake every requirement directly into the platform so you can't accidentally break it. Audit logs, opt-out handling, and retention windows are all automatic.</p>
      <div class="space-y-4 max-w-lg mx-auto lg:mx-0">
        <div class="comp-rule">
          <div class="ic">⏰</div>
          <div class="text-left">
            <h5 class="font-bold">Quiet hours auto-enforced</h5>
            <p class="text-xs text-ink-300">No promotional calls 9pm–10am as per BTRC guidelines.</p>
          </div>
        </div>
        <div class="comp-rule">
          <div class="ic">🚫</div>
          <div class="text-left">
            <h5 class="font-bold">DNC & opt-out instant</h5>
            <p class="text-xs text-ink-300">Press 9 to opt out — number suppressed across all future campaigns.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="reveal flex justify-center">
      <div class="w-80 h-96 relative">
        <div class="absolute inset-0 bg-gradient-to-br from-paypal-gold to-orange-500 rounded-3xl opacity-20 blur-2xl"></div>
        <div class="relative bg-white/5 border border-white/10 rounded-3xl p-8 h-full flex flex-col items-center justify-center text-center">
          <div class="text-6xl mb-4">🛡️</div>
          <div class="text-2xl font-extrabold text-paypal-gold">BTRC</div>
          <div class="text-sm font-bold opacity-60">COMPLIANT PLATFORM</div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
